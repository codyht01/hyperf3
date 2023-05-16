<?php
/**
 * Created by PhpStorm.
 * User: 小蛮哼哼哼
 * Email: 243194993@qq.com
 * Date: 2023/2/13
 * Time: 11:51
 * motto: 现在的努力是为了小时候吹过的牛逼！
 */

declare(strict_types=1);


namespace App\Common\Lib\reflection\sms;

use Hyperf\Cache\Cache;
use Hyperf\Contract\ConfigInterface;
use Hyperf\Utils\ApplicationContext;

class SmsBase implements SmsInterface
{
    /**
     * @param string $mobile
     * @param string $code
     * @return bool
     */
    public function send_code(string $mobile = "", string $code = ""): bool
    {
        return true;
    }

    /**
     * @param string $mobile
     * @param string $code
     * @return bool
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    public function check(string $mobile = "", string $code = ""): bool
    {
        $key = "sms_code" . $mobile;
        $client = ApplicationContext::getContainer()->get(Cache::class);
        $cache = $client->has($key);
        if (!$cache) {
            return false;
        }
        $res = $client->get($key);
        if ($res != $code) {
            return false;
        }
        $client->delete($key);
        return true;
    }
}