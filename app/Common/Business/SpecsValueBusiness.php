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

use App\Exception\FooException;
use App\Model\SpecsValue;

class SpecsValueBusiness extends BusBase
{
    protected $obj_model;

    public function __construct()
    {
        $this->obj_model = new SpecsValue();
    }

    public function getSpecsBySpecsName(array $specs_id = [])
    {
        $arr = $this->getSpecsByInfo($specs_id);
        $result = [];
        if (!empty($arr)) {
            //var_dump(json_encode($arr, JSON_UNESCAPED_UNICODE));
            foreach ($arr as $v) {
                $result[$v['id']] = $v['specs']['title'];
            }
            //$result = array_column($specs, 'title', 'id');
        }
        //var_dump(json_encode($result));
        return $result;
    }

    /**
     * @param array $specs_id
     * @return array
     */
    public function getSpecsByInfo(array $specs_id = []): array
    {
        if (empty($specs_id)) {
            return [];
        }
        try {
            $result = $this->obj_model->whereIn('id', $specs_id)->with('specs')
                ->get()->toArray();
        } catch (\Exception $e) {
            throw new FooException("查询失败" . $e->getMessage());
        }
        return $result;
    }
}