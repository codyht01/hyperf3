<?php
/**
 * Created by PhpStorm.
 * User: 小蛮哼哼哼
 * Email: 243194993@qq.com
 * Date: 2023/3/16
 * Time: 17:34
 * motto: 现在的努力是为了小时候吹过的牛逼！
 */

declare(strict_types=1);


namespace App\Common\Business;

use App\Common\Lib\Log\Log;
use App\Common\Lib\Show;
use App\Exception\FooException;
use App\Model\Role;

class RoleBusiness extends BusBase
{
    protected $obj_model = "";

    public function __construct()
    {
        $this->obj_model = new Role();
    }

    /**
     * @param array $data
     * @return bool
     */
    public function add(array $data = []): bool
    {
        $insert_data = [
            "roleName" => $data['roleName'],
            "roleSign" => $data['roleSign'],
            "sort" => $data['sort'],
            "status" => $data['status'],
            "description" => $data['description'],
            "menuProps" => Show::json_encode($data['menuProps']),
            "update_time" => time()
        ];
        try {
            if (empty($data['id']) && $data['id'] == 0) {
                //添加
                $insert_data['create_time'] = time();
                $result = $this->obj_model->insert($insert_data);
            } else {
                $result = $this->obj_model->where('id', $data['id'])->save($insert_data);
            }
        } catch (\Exception $e) {
            Log::get('role-add', 'error')->error($e->getMessage());
            throw new FooException("操作失败");
        }
        if (!$result) {
            throw new FooException('添加失败');
        } else {
            return true;
        }

    }
}