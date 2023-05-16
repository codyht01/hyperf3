<?php
/**
 * Created by PhpStorm.
 * User: 小蛮哼哼哼
 * Email: 243194993@qq.com
 * Date: 2023/3/22
 * Time: 17:01
 * motto: 现在的努力是为了小时候吹过的牛逼！
 */

declare(strict_types=1);


namespace App\Common\Business;

use App\Common\Lib\Log\Log;
use App\Constants\ErrorCode;
use App\Exception\FooException;
use App\Model\GoodsCategory;

class GoodsCategoryBusiness extends BusBase
{
    protected $obj_model;

    public function __construct()
    {
        $this->obj_model = new GoodsCategory();
    }

    /**
     * @param array $data
     * @return true
     */
    public function add(array $data = []): bool
    {
        $insert_data = [
            "title" => $data['title'],
            "sort" => $data['sort'],
            "logo" => $data['logo']
        ];
        try {
            if (empty($data['id']) || $data['id'] == 0) {
                $data['create_time'] = time();
                $data['update_time'] = time();
                $result = $this->obj_model
                    ->insert($data);
            } else {
                $result = $this->obj_model->where('id', $data['id'])
                    ->update($insert_data);
            }

        } catch (\Exception $e) {
            Log::get('get' . $this->obj_model . "index", 'error')->error($e->getMessage());
            throw new FooException("查询失败" . $e->getMessage());
        }
        if (!$result) {
            throw new FooException("操作失败");
        }
        return true;
    }

    /**
     * @return mixed[]
     */
    public function getGoodsCategoryByList(): array
    {
        try {
            $result = $this->obj_model->where('status', ErrorCode::MYSQL_SUCCESS)
                ->orderBy('sort', "desc")
                ->orderBy('id', 'desc')
                ->get(["id", "logo", "title"])->toArray();
        } catch (\Exception $e) {
            throw new FooException("查询失败" . $e->getMessage());
        }
        return $result;
    }
}