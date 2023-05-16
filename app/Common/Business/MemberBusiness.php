<?php
/**
 * Created by PhpStorm.
 * User: 小蛮哼哼哼
 * Email: 243194993@qq.com
 * Date: 2023/4/19
 * Time: 17:14
 * motto: 现在的努力是为了小时候吹过的牛逼！
 */

declare(strict_types=1);


namespace App\Common\Business;

use App\Common\Lib\Log\Log;
use App\Common\Lib\Show;
use App\Exception\FooException;
use App\Kernel\Wechat\WechatFactory;
use App\Model\Member;
use Hyperf\Context\ApplicationContext;
use Hyperf\DbConnection\Db;
use Hyperf\Di\Annotation\Inject;
use Qbhy\HyperfAuth\AuthManager;

class MemberBusiness
{
    protected Member $obj_model;
    /**
     * @var AuthManager
     */
    #[Inject]
    protected AuthManager $auth;

    public function __construct()
    {
        $this->obj_model = new Member();
    }

    /**
     * @param array $data
     * @return array
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function UserCheck(array $data = []): array
    {
        $container = ApplicationContext::getContainer();
        if (empty($data)) {
            throw new FooException("数据为空");
        }
        if ($data['type'] == 'wx') {
            if (empty($data['code'])) {
                throw new FooException("内部异常");
            }
            try {
                $wx_session = $container->get(WechatFactory::class)->session($data['code']);
            } catch (\Exception $e) {
                Log::get('bus-member-wx', 'error')->error($e->getMessage());
                throw new FooException("内部异常");
            }
            if (!empty($wx_session['openid'])) {
                try {
                    $res = Db::table("member_token")->updateOrInsert(['openid' => $wx_session['openid']], ['session_key' => $wx_session['session_key'], 'update_time' => time()]);
                } catch (\Exception $e) {
                    Log::get('bus-member_uInsert', 'error')->error($e->getMessage());
                    throw new FooException("操作失败");
                }
                if ($res) {
                    //插入表
                    try {
                        $result = $this->obj_model->firstOrCreate(['openid' => $wx_session['openid']], ['create_time' => time(), 'update_time' => time()]);
                    } catch (\Exception $e) {
                        Log::get('bus-member_insert', 'error')->error($e->getMessage());
                        throw new FooException("登录失败" . $e->getMessage());
                    }
                    return [
                        'token' => $this->auth->guard('jwt')->login($result)
                    ];
                } else {
                    throw new FooException("登录失败");
                }
            } else {
                Log::get('bus-member-wx-err', 'error')->error(Show::json_encode($wx_session));
                throw new FooException("登录失败");
            }
        } else {
            return [];
        }
    }
}