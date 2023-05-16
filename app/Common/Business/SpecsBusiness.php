<?php
/**
 * Created by PhpStorm.
 * User: 小蛮哼哼哼
 * Email: 243194993@qq.com
 * Date: 2023/3/24
 * Time: 15:59
 * motto: 现在的努力是为了小时候吹过的牛逼！
 */

declare(strict_types=1);


namespace App\Common\Business;

use App\Constants\ErrorCode;
use App\Exception\FooException;
use App\Model\Spec;

class SpecsBusiness extends BusBase
{
    protected $obj_model;

    public function __construct()
    {
        $this->obj_model = new Spec();
    }


}