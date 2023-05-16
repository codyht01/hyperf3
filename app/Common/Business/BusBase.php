<?php
/**
 * Created by PhpStorm.
 * User: 小蛮哼哼哼
 * Email: 243194993@qq.com
 * Date: 2023/2/7
 * Time: 15:36
 * motto: 现在的努力是为了小时候吹过的牛逼！
 */

declare(strict_types=1);


namespace App\Common\Business;

use App\Common\Lib\Log\Log;
use App\Constants\ErrorCode;
use App\Exception\FooException;
use Hyperf\Di\Annotation\Inject;
use Qbhy\HyperfAuth\AuthManager;
use function PHPStan\dumpType;

class BusBase
{
    /**
     * 公共参数
     * @var null
     */
    protected $obj_model = null;

    /***
     * @param int|string $id
     * @return bool
     */
    public function del(int|string $id = 0): bool
    {
        if ($id == 0) {
            throw new FooException("用户信息不存在");
        }
        try {
            $res = $this->obj_model->whereIn('id', explode(',', $id))->delete();
        } catch (\Exception $e) {
            throw new FooException("删除异常");
        }
        if (!$res) {
            throw new FooException("删除失败");
        }
        return true;
    }

    /**
     * 查询列表 以及分页
     * @param int $limit
     * @param array $where
     * @param array $field
     * @param string $orderKey
     * @param string $order_value
     * @return array
     */
    public function index(int $limit = 10, array $where = [], array $field = ['*'], string $orderKey = 'id', string $order_value = 'desc'): array
    {
        try {
            $result = $this->obj_model
                ->where($where)
                ->orderBy($orderKey, $order_value)
                ->paginate($limit, $field)->toArray();
        } catch (\Exception $e) {
            Log::get('get' . $this->obj_model . "index", 'error')->error($e->getMessage());
            throw new FooException("查询失败" . $e->getMessage());
        }
        return $result;
    }

    /**
     * @param array $data
     * @return true
     */
    public function add(array $data = []): bool
    {
        if (empty($data)) {
            throw new FooException("内容为空");
        }
        try {
            if (!empty($data['id'])) {
                //更新
                $row = $this->getBaseById($data['id']);
                if (!$row) {
                    throw new FooException("信息不存在");
                }
                $result = $this->obj_model->where('id', $data['id'])
                    ->update($data);
            } else {
                //新增
                $data['create_time'] = time();
                $data['update_time'] = time();
                $result = $this->obj_model->insert($data);
            }
        } catch (\Exception $e) {
            throw new FooException("操作失败");
        }
        if ($result) {
            return true;
        } else {
            throw new FooException("操作失败");
        }
    }

    /**
     * 根据id查询数据
     * @param int $id
     * @return array
     */
    public function getBaseById(int $id = 0): array
    {
        try {
            $row = $this->obj_model
                ->where('id', '=', $id)
                ->first();
        } catch (\Exception $e) {
            throw new FooException("查询失败");
        }
        if (!$row) {
            return [];
        } else {
            return $row->toArray();
        }
    }

    /**
     * @param array $where
     * @param string $orderBy
     * @return array
     */
    public function getBaseByListInfo(array $where = [], string $orderBy = 'id'): array
    {
        $order = explode(',', $orderBy);
        $orderByFields = [];
        foreach ($order as $v) {
            $orderByFields[] = sprintf('%s %s', $v, "desc");
        }
        if (!empty($orderByFields)) {
            $orderBy = implode(',', $orderByFields);
        }
        try {
            $result = $this->obj_model
                ->where($where)
                ->orderByRaw($orderBy)
                ->get()
                ->toArray();
        } catch (\Exception $e) {
            throw new FooException("查询异常" . $e->getMessage());
        }
        return $result;
    }

    /**
     * @param array $data
     * @return true
     */
    public function insertAll(array $data = []): bool
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
        return true;
    }
}