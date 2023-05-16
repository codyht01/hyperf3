<?php
/**
 * Created by PhpStorm.
 * User: 小蛮哼哼哼
 * Email: 243194993@qq.com
 * Date: 2023/2/13
 * Time: 11:35
 * motto: 现在的努力是为了小时候吹过的牛逼！
 */

declare(strict_types=1);


namespace App\Common\Lib\reflection\sms;

interface SmsInterface
{
    /**
     * @param string $mobile
     * @param string $code
     * @return bool
     */
    public function send_code(string $mobile = "", string $code = ""): bool;

    /**
     * @param string $mobile
     * @param string $code
     * @return bool
     */
    public function check(string $mobile = "",string $code = ""):bool;
}