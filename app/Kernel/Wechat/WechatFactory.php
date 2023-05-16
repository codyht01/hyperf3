<?php
/**
 * Created by PhpStorm.
 * User: 小蛮哼哼哼
 * Email: 243194993@qq.com
 * Date: 2023/4/19
 * Time: 16:40
 * motto: 现在的努力是为了小时候吹过的牛逼！
 */

declare(strict_types=1);


namespace App\Kernel\Wechat;

use EasyWeChat\Factory;
use Hyperf\Contract\ConfigInterface;
use Hyperf\Contract\ContainerInterface;

class WechatFactory
{
    /**
     * @var ContainerInterface
     */
    protected ContainerInterface $container;
    protected $wechat_app;
    private mixed $config;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
        $this->config = $container->get(ConfigInterface::class)->get('wechat.mini_program.default');
        $this->wechat_app = Factory::miniProgram($this->config);
    }

    /**
     * 登录
     * @param string $code
     * @return array|\EasyWeChat\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidConfigException
     */
    public function session(string $code)
    {
        return $this->wechat_app->auth->session($code);
    }

    /**
     * @param string $name
     * @param array $arguments
     * @return mixed
     */
    public function __call(string $name, array $arguments)
    {
        return call_user_func_array(array($this->wechat_app, $name), $arguments);
    }
}