<?php
/**
 * Created by PhpStorm.
 * User: 小蛮哼哼哼
 * Email: 243194993@qq.com
 * Date: 2023/2/13
 * Time: 11:33
 * motto: 现在的努力是为了小时候吹过的牛逼！
 */

declare(strict_types=1);


namespace App\Common\Lib\reflection;

use App\Common\Lib\reflection\sms\Ali;
use App\Common\Lib\reflection\upload\File;
use App\Common\Lib\reflection\upload\Image;
use App\Common\Lib\reflection\upload\Video;

class ArrClass
{
    public function smsAttr(): array
    {
        return [
            "ali" => Ali::class
        ];
    }

    /**
     * @return string[]
     */
    public function uploadAttr(): array
    {
        return [
            "image" => Image::class,
            "video" => Video::class,
            "file" => File::class
        ];
    }

    /**
     * 利用反射机制执行
     * @param string $key
     * @param array $arr
     * @param array $param
     * @param bool $needInstance
     * @return mixed|object|null
     * @throws \ReflectionException
     */
    public function initClass(string $key = '', array $arr = [], array $param = [], bool $needInstance = false)
    {
        if (!array_key_exists($key, $arr)) {
            throw new \Exception("{$key}不存在");
        }
        $className = $arr[$key];
        return $needInstance ? (new \ReflectionClass($className))->newInstanceArgs($param) : $className;
    }
}