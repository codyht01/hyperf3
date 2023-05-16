<?php
/**
 * Created by PhpStorm.
 * User: 小蛮哼哼哼
 * Email: 243194993@qq.com
 * Date: 2023/2/13
 * Time: 14:05
 * motto: 现在的努力是为了小时候吹过的牛逼！
 */

declare(strict_types=1);


namespace App\Common\Business;

use App\Common\Lib\reflection\ArrClass;
use App\Exception\FooException;
use Hyperf\Utils\ApplicationContext;
use Hyperf\Utils\Str;

class SendSmsBusiness extends BusBase
{
    public function sendCode(string $mobile = "", string $type = 'ali')
    {
        if (empty($mobile)) {
            throw new FooException("请输入手机号");
        }
        if (!preg_match('/^(?:(?:\+|00)86)?1(?:(?:3[\d])|(?:4[5-7|9])|(?:5[0-3|5-9])|(?:6[5-7])|(?:7[0-8])|(?:8[\d])|(?:9[1|8|9]))\d{8}$/', $mobile)) {
            throw new FooException("请输入正确的手机号");
        }
        $code = rand(1000, 9999);
        try {
            $container = ApplicationContext::getContainer()->get(ArrClass::class);
            $obj = $container->initClass('ali', $container->smsAttr(), [], true);
            $res = $obj->send_code($mobile, strval($code));
        } catch (\Exception $e) {
            throw new FooException($e->getMessage());
        }
        return true;

    }
}