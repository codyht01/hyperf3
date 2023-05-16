<?php
/**
 * Created by PhpStorm.
 * User: 小蛮哼哼哼
 * Email: 243194993@qq.com
 * Date: 2023/2/7
 * Time: 15:31
 * motto: 现在的努力是为了小时候吹过的牛逼！
 */

declare(strict_types=1);


namespace App\Controller\Api;

use App\Common\Business\SendSmsBusiness;
use App\Common\Business\UserBusiness;
use App\Common\Lib\Show;
use App\Exception\FooException;

class LoginController extends ApiBaseController
{
    protected ?UserBusiness $obj_bus = null;

    public function __construct()
    {
        $this->obj_bus = new UserBusiness();
    }

    /**
     * 账号和密码登录
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function doLogin(): \Psr\Http\Message\ResponseInterface
    {
        $data = [
            "userName" => $this->request->input('userName', ''),
            "password" => $this->request->input('password', ''),
            "code" => $this->request->input('code', ''),
            "ip" => $this->__ip()
        ];
        try {
            $res = $this->obj_bus->check($data);
        } catch (\Exception $e) {
            return Show::error($e->getMessage());
        }
        return Show::success("登录成功", $res);
    }

    /**
     * 获取请求的ip
     * @return mixed
     */
    protected function __ip()
    {
        $res = $this->request->getServerParams();
        if (isset($res['http_client_ip'])) {
            return $res['http_client_ip'];
        } elseif (isset($res['http_x_real_ip'])) {
            return $res['http_x_real_ip'];
        } elseif (isset($res['http_x_forwarded_for'])) {
            //部分CDN会获取多层代理IP，所以转成数组取第一个值
            $arr = explode(',', $res['http_x_forwarded_for']);
            return $arr[0];
        } else {
            return $res['remote_addr'];
        }
    }

    /**
     * 发送验证码
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function sendCode(): \Psr\Http\Message\ResponseInterface
    {
        $mobile = $this->request->input('mobile', '');
        try {
            $res = (new SendSmsBusiness())->sendCode($mobile);
        } catch (\Exception $e) {
            return Show::error($e->getMessage());
        }
        return Show::success("发送成功");
    }

    /**
     * 退出登录
     * @return \Psr\Http\Message\ResponseInterface
     * @throws FooException
     */
    public function logout(): \Psr\Http\Message\ResponseInterface
    {
        try {
            $res = $this->obj_bus->logout();
        } catch (\Exception $e) {
            return Show::error($e->getMessage());
        }
        return Show::success("退出成功");
    }

    /**
     * 验证token
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function verify(): \Psr\Http\Message\ResponseInterface
    {
        try {
            $res = $this->obj_bus->verify();
        } catch (\Exception $e) {
            return Show::error($e->getMessage());
        }
        return Show::success("验证成功", $res);
    }
}