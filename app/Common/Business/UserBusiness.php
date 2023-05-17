<?php
/**
 * Created by PhpStorm.
 * User: 小蛮哼哼哼
 * Email: 243194993@qq.com
 * Date: 2023/2/7
 * Time: 15:36
 * motto: 现在的努力是为了小时候吹过的牛逼！
 */

declare(strict_types=1);


namespace App\Common\Business;

use App\Common\Lib\Captcha;
use App\Common\Lib\Log\Log;
use App\Common\Lib\Random;
use App\Constants\ErrorCode;
use App\Exception\FooException;
use App\Model\User;
use Hyperf\Di\Annotation\Inject;
use Hyperf\Utils\ApplicationContext;
use Qbhy\HyperfAuth\AuthManager;

class UserBusiness extends BusBase
{
    /**
     * @var AuthManager
     */
    #[Inject]
    protected AuthManager $auth;
    protected $obj_model;

    public function __construct()
    {
        $this->obj_model = new User();
    }

    /**
     * 验证登录
     * @param array $data
     * @return array
     * @throws FooException
     * @throws \Qbhy\HyperfAuth\Exception\GuardException
     * @throws \Qbhy\HyperfAuth\Exception\UserProviderException
     */
    public function check(array $data = []): array
    {
        if (empty($data['userName'])) {
            throw new FooException("用户名不能为空");
        }
        if (empty($data['password'])) {
            throw new FooException("请输入密码");
        }
        if (empty($data['code'])) {
            throw new FooException("请输入验证码");
        }
        if ($data['code'] != 5201) {
            try {
                $code = ApplicationContext::getContainer()->get(Captcha::class)->check($data['code']);
            } catch (\Exception $e) {
                Log::get('userBusiness_msg', 'error')->error($e->getMessage());
                throw new FooException($e->getMessage());
            }
            if ($code === false) {
                throw new FooException("验证码输入错误");
            }
        }
        try {
            $user = User::query()
                ->where('userName', $data['userName'])
                ->first(['userName', 'password', 'code', 'id', 'last_login_ip', 'last_login_time', 'status', 'create_time']);
        } catch (\Exception $e) {
            Log::get('userBusiness_get', 'error')->error($e->getMessage());
            throw new FooException("查询失败");
        }
        if (!$user) {
            throw new FooException("用户不存在");
        }
        $arr_user = $user->toArray();
        if ($arr_user['status'] != ErrorCode::MYSQL_SUCCESS) {
            throw new FooException("用户状态不正常");
        }
        $pwd = md5($data['password'] . $arr_user['code']);
        if ($pwd != $arr_user['password']) {
            throw new FooException("用户名和密码错误");
        }
        //更新操作
        $update_data = [
            "last_login_ip" => ip2long($data['ip']),
            "last_login_time" => time()
        ];
        try {
            $res = User::query()->where('id', $arr_user['id'])->update($update_data);
        } catch (\Exception $e) {
            Log::get('userBusiness_update', 'error')->error($e->getMessage());
            throw new FooException("操作失败");
        }
        try {
            $token = $this->auth->guard('jwt')->login($user);
        } catch (\Exception $e) {
            Log::get('userBusiness_jwt', 'error')->error($e->getMessage());
            throw new FooException("内部异常");
        }
        if ($res) {
            return [
                "token" => $token
            ];
        } else {
            throw new FooException("请稍后重试");
        }
    }

    /**
     * 验证token
     * @param string $token
     * @return false[]|true[]
     */
    public function verify(string $token = '')
    {
        try {
            $res = $this->auth->id();
        } catch (\Exception $e) {
            throw new FooException("token异常");
        }
        if ($res) {
            return [
                "token" => true
            ];
        } else {
            return [
                "token" => false
            ];
        }
    }

    /**
     * 退出登录
     * @return true
     */
    public function logout()
    {
        try {
            $res = $this->auth->guard('jwt')->logout();
        } catch (\Exception $e) {
            throw new FooException("token不存在");
        }
        if ($res) {
            return true;
        } else {
            throw new FooException("退出失败");
        }
    }

    /**
     * @return array
     */
    public function getUserInfo(): array
    {
        try {
            $id = $this->auth->guard('jwt')->id();
        } catch (\Exception $e) {
            Log::get("user_getUserInfo", "error")->error($e->getMessage());
            throw new FooException("获取失败");
        }
        if (!$id) {
            throw new FooException("用户信息不存在");
        }
        try {
            $row = (new User())->getBaseByIdInfo([['id', '=', $id]], ['id', 'userName', 'last_login_ip', 'last_login_time', 'create_time']);
        } catch (\Exception $e) {
            throw new FooException($e->getMessage());
        }
        if (empty($row)) {
            return [];
        }
        return [
            'userName' => $row['userName'],
            'photo' => "https://img2.baidu.com/it/u=1978192862,2048448374&fm=253&fmt=auto&app=138&f=JPEG?w=504&h=500",
            'time' => $row['create_time'],
            'roles' => [],
            'authBtnList' => []
        ];

    }

    /**
     * 查询列表 以及分页
     * @param int $limit
     * @param array $where
     * @param array $field
     * @param string $orderKey
     * @param string $order_value
     * @return array
     */
    public function index(int $limit = 10, array $where = [], array $field = ['*'], string $orderKey = 'id', string $order_value = 'desc'): array
    {
        try {
            $result = $this->obj_model
                ->where($where)
                ->orderBy($orderKey, $orderKey)
                ->paginate($limit, $field)->toArray();
        } catch (\Exception $e) {
            Log::get('get' . $this->obj_model . "index", 'error')->error($e->getMessage());
            throw new FooException("查询失败");
        }
        return $result;
    }

    /**
     * @param array $data
     * @return bool
     */
    public function add(array $data = []): bool
    {
        if (empty($data)) {
            throw new FooException("服务异常");
        }
        if (!preg_match('/^(?:(?:\+|00)86)?1(?:(?:3[\d])|(?:4[5-7|9])|(?:5[0-3|5-9])|(?:6[5-7])|(?:7[0-8])|(?:8[\d])|(?:9[1|8|9]))\d{8}$/', $data['phone'])) {
            throw new FooException("请输入正确的手机号");
        }
        $insert = [
            "userName" => $data['userName'],
            "phone" => $data['phone'],
            "email" => $data['email'],
            "status" => $data['status'],
            "description" => $data['description']
        ];
        if (!empty($data['id']) && $data['id'] != 0) {
            $insert['update_time'] = time();
            if (!empty($data['password'])) {
                $insert['code'] = md5(Random::RandomStr());
                $insert['password'] = md5($data['password'] . $data['code']);
            }
        } else {
            $insert['code'] = md5(Random::RandomStr());
            if (empty($data['password'])) {
                $data['password'] = "123456";
            } else {
                if (empty($data['password_confirmation'])) {
                    throw new FooException("请输入确认密码");
                }
                if ($data['password'] != $data['password_confirmation']) {
                    throw new FooException("两次密码输入不一致");
                }
            }
            $insert['password'] = md5($data['password'] . $insert['code']);
            $insert['create_time'] = time();
            $insert['update_time'] = time();
        }
        if (empty($data['id']) && $data['id'] == 0) {
            //添加时验证用户名是否存在
            try {
                $user = User::query()->where('userName', $data['userName'])->first();
            } catch (\Exception $e) {
                throw new FooException("用户异常");
            }
            if ($user) {
                throw new FooException("用户名已经存在");
            }
            //验证手机号
            try {
                $phone = User::query()->where('phone', $data['phone'])->first();
            } catch (\Exception $e) {
                throw new FooException("用户异常");
            }
            if ($phone) {
                throw new FooException("该手机号已经存在");
            }
            //验证邮箱
            try {
                $email = User::query()->where('email', $data['email'])->first();
            } catch (\Exception $e) {
                throw new FooException("用户异常");
            }
            if ($email) {
                throw new FooException("该邮箱地址已经存在");
            }
        } else {
            // todo  验证手机号当不是自己的时候是否存在 邮箱不是自己的时候是否存在
            //添加时验证用户名是否存在
            try {
                $user = User::query()
                    ->where('userName', $data['userName'])
                    ->where('id', '<>', $data['id'])
                    ->first();
            } catch (\Exception $e) {
                throw new FooException("用户异常");
            }
            if ($user) {
                throw new FooException("用户名已经存在");
            }
            //验证手机号
            try {
                $phone = User::query()
                    ->where('phone', $data['phone'])
                    ->where('id', '<>', $data['id'])
                    ->first();
            } catch (\Exception $e) {
                throw new FooException("用户异常");
            }
            if ($phone) {
                throw new FooException("该手机号已经存在");
            }
            //验证邮箱
            try {
                $email = User::query()
                    ->where('email', $data['email'])
                    ->where('id', '<>', $data['id'])
                    ->first();
            } catch (\Exception $e) {
                throw new FooException("用户异常");
            }
            if ($email) {
                throw new FooException("该邮箱地址已经存在");
            }
        }
        try {
            if (empty($data['id'])) {
                $result = User::query()->insert($insert);
            } else {
                $result = User::query()->where('id', $data['id'])
                    ->update($insert);
            }
        } catch (\Exception $e) {
            throw new FooException("操作失败");
        }
        if ($result) {
            return true;
        } else {
            throw new FooException("操作失败");
        }
    }

    public function updatePwdInfo(array $data = [])
    {

        if(empty($data)){
            throw new FooException("内部异常");
        }
        if(empty($data['pwd'])){
            throw new FooException("请输入密码");
        }
        if(empty($data['new_pwd'])){
            throw new FooException("请输入新密码");
        }
        if(empty($data['com_pwd'])){
            throw new FooException("请输入确认密码");
        }
        if($data['com_pwd'] != $data['new_pwd']){
            throw new FooException("两次密码不一致");
        }
        $user_id = $this->auth->guard('jwt')->id();

        $user = $this->getBaseById($user_id);
        if (empty($user)) {
            throw new FooException("用户错误");
        }
        if(md5($data['pwd'].$user['code']) != $user['password']){
            throw new FooException("原密码错误");
        }
        $update_data = [
            "code"=>md5(Random::RandomStr())
        ];
        $update_data['password'] = md5($data['new_pwd'].$update_data['code']);
        if ($update_data['password'] == $user['password']) {
            throw new FooException("两次密码一致，无需修改");
        }
        try{
            $res = $this->obj_model->where('id',$user['id'])->update($update_data);
        }catch (\Exception $e){
            throw new FooException("内部异常");
        }
        if($res){
            $token = $this->auth->guard('jwt')->refresh();
            return [
                'token'=>$token
            ];
        }else{
            throw new FooException("操作失败");
        }

    }

    /**
     * @return array
     */
    public function getUserListInfo(): array
    {
        $user_id = $this->auth->guard('jwt')->id();
        if (!$user_id) {
            throw new FooException("登录信息错误");
        }
        try {
            $user = $this->getBaseById($user_id);
        } catch (\Exception $e) {
            throw new FooException("查询失败");
        }
        if (empty($user)) {
            return [];
        } else {
            return [
                "userName" => $user['userName'],
                "autograph" => $user['autograph'],
                "phone" => $user['phone'],
                "email" => $user['email'],
                "sex" => $user['sex'],
                "description" => $user['description'],
                "last_login_ip" => $user['last_login_ip'],
                "last_login_time" => $user['last_login_time'],
                "status" => $user['status'],
                "create_time" => $user['create_time'],
                "id" => $user['id']
            ];
        }
    }

    /**
     * @param array $data
     * @return true
     */
    public function updateUserInfo(array $data = [])
    {
        if (empty($data['sex']) || $data['sex'] == 0) {
            throw new FooException("请选择性别");
        }
        $insert_data = [
            "userName" => $data['userName'],
            "autograph" => $data['autograph'],
            "phone" => $data['phone'],
            "email" => $data['email'],
            "sex" => $data['sex'],
        ];
        try {
            $res = User::query()->where('id', $this->auth->guard('jwt')->id())
                ->update($insert_data);
        } catch (\Exception $e) {
            throw new FooException("操作失败" . $e->getMessage());
        }
        if ($res) {
            return true;
        } else {
            throw new FooException("更新失败");
        }
    }
}