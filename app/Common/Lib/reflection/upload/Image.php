<?php
/**
 * Created by PhpStorm.
 * User: 小蛮哼哼哼
 * Email: 243194993@qq.com
 * Date: 2023/3/7
 * Time: 16:10
 * motto: 现在的努力是为了小时候吹过的牛逼！
 */

declare(strict_types=1);


namespace App\Common\Lib\reflection\upload;

class Image extends UploadBase
{
    /**
     * 类型
     * @var string
     */
    protected string $type = 'image';
    /**
     * 文件大小
     * @var int|float
     */
    protected int $size = 2;
    /**
     * 后缀
     * @var array|string[]
     */
    protected array $ext = ['image/jpg', 'image/jpeg', 'image/gif', 'image/png'];
}