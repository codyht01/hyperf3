<?php
/**
 * Created by PhpStorm.
 * User: 小蛮哼哼哼
 * Email: 243194993@qq.com
 * Date: 2023/1/30
 * Time: 9:36
 * motto: 现在的努力是为了小时候吹过的牛逼！
 */

declare(strict_types=1);


namespace App\Controller;

use App\Common\Lib\Captcha;
use Hyperf\Utils\ApplicationContext;

class CaptchaController extends AbstractController
{
    /**
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function index()
    {
        $container = ApplicationContext::getContainer();
        return $container->get(Captcha::class)->create("login");
    }

    /**
     * @return bool
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function verify()
    {
        $code = $this->request->input('code');
        $container = ApplicationContext::getContainer();
        return $container->get(Captcha::class)->check($code);
    }
}