<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://hyperf.wiki
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */

namespace App\Model;

use App\Common\Lib\Log\Log;
use App\Exception\FooException;
use Hyperf\Database\Model\SoftDeletes;
use Hyperf\DbConnection\Model\Model as BaseModel;
use Hyperf\ModelCache\Cacheable;
use Hyperf\ModelCache\CacheableInterface;

abstract class Model extends BaseModel implements CacheableInterface
{
    /**
     * 软删除
     */
    use SoftDeletes;

    /**
     * 缓存器
     */
    use Cacheable;

    const CREATED_AT = 'create_time';
    const UPDATED_AT = 'update_time';
    const DELETED_AT = 'delete_time';
    protected ?string $dateFormat = 'U';

    /**
     * 公共按条件查询一条数据
     * @param array $where
     * @param array $field
     * @return array
     */
    public function getBaseByIdInfo(array $where = [], array $field = ['*']): array
    {
        try {
            $row = $this->where($where)
                ->first($field);
        } catch (\Exception $e) {
            Log::get('getBase', 'error')->error($e->getMessage());
            throw new FooException("查询失败");
        }
        if (!$row) {
            return [];
        } else {
            return $row->toArray();
        }
    }
}
