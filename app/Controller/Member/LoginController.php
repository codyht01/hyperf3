<?php
/**
 * Created by PhpStorm.
 * User: 小蛮哼哼哼
 * Email: 243194993@qq.com
 * Date: 2023/4/19
 * Time: 15:43
 * motto: 现在的努力是为了小时候吹过的牛逼！
 */

declare(strict_types=1);


namespace App\Controller\Member;

use App\Common\Business\MemberBusiness;
use App\Common\Lib\Show;
use App\Kernel\Wechat\WechatFactory;
use Hyperf\Context\ApplicationContext;

class LoginController extends MemberBaseController
{
    protected MemberBusiness $obj_bus;

    public function __construct()
    {
        $this->obj_bus = new MemberBusiness();
    }

    /**
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function check(): \Psr\Http\Message\ResponseInterface
    {
        $type = $this->request->input('type', 'wx');
        $code = $this->request->input('code');
        if (empty($type)) {
            return Show::error("内部异常");
        }
        $data = [
            'type' => $type,
            'code' => $code
        ];
        $result = $this->obj_bus->UserCheck($data);
        return Show::success('登录成功', $result);

    }
}