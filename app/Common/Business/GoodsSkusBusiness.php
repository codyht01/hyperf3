<?php
/**
 * Created by PhpStorm.
 * User: 小蛮哼哼哼
 * Email: 243194993@qq.com
 * Date: 2023/3/29
 * Time: 16:47
 * motto: 现在的努力是为了小时候吹过的牛逼！
 */

declare(strict_types=1);


namespace App\Common\Business;

use App\Exception\FooException;
use App\Model\GoodsSku;
use Hyperf\DbConnection\Db;

class GoodsSkusBusiness extends BusBase
{
    protected $obj_model;

    public function __construct()
    {
        $this->obj_model = new GoodsSku();
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function insertGetId(array $data = []): mixed
    {
        if (empty($data)) {
            throw new FooException("数据为空");
        }
        try {
            $res = $this->obj_model->insert($data);
        } catch (\Exception $e) {
            throw new FooException("操作失败");
        }
        if (!$res) {
            throw new FooException("操作失败");
        }
        try {
            $id = $this->obj_model->max('id');
        } catch (\Exception $e) {
            throw new FooException("查询失败");
        }

        return $id;
    }

    /**
     * @param array $data
     * @param int $goods_id
     * @return mixed
     */
    public function updateData(array $data = [], int $goods_id = 0): mixed
    {
        if (empty($data)) {
            throw new FooException("数据为空");
        }
        try {
            $res = $this->obj_model->where('goods_id', $goods_id)->update($data);
        } catch (\Exception $e) {
            throw new FooException("操作失败");
        }
        if (!$res) {
            throw new FooException("操作失败");
        }
        try {
            $id = $this->obj_model->max('id');
        } catch (\Exception $e) {
            throw new FooException("查询失败");
        }
        return $id;
    }

    /**
     * @param int $goods_id
     * @return true
     */
    public function delByData(int $goods_id = 0): bool
    {
        if ($goods_id == 0) {
            throw new FooException("发生异常");
        }
        try {
            $res = $this->obj_model->where('goods_id', $goods_id)->delete();
        } catch (\Exception $e) {
            throw new FooException("操作失败");
        }
        if (!$res) {
            throw new FooException("操作失败");
        }
        return true;
    }

    public function updateDataBySkuData(array $data = [], int $id = 0)
    {
        try {
            $res = $this->obj_model->where('id', $id)->update($data);
        } catch (\Exception $e) {
            throw new FooException("操作失败");
        }
        if (!$res) {
            throw new FooException("操作失败");
        }
        return true;
    }
}