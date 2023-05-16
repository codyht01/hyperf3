<?php

declare(strict_types=1);

namespace App\Model;


/**
 * @property int $id
 * @property string $title
 * @property string $path
 * @property string $name
 * @property string $component
 * @property string $redirect
 * @property string $isLink
 * @property int $isHide
 * @property int $isKeepAlive
 * @property int $isAffix
 * @property int $isIframe
 * @property string $icon
 * @property int $status
 * @property int $create_time
 * @property \Carbon\Carbon $update_time
 * @property int $delete_time
 */
class Menu extends Model
{
    /**
     * The table associated with the model.
     */
    protected ?string $table = 'menu';

    /**
     * The attributes that are mass assignable.
     */
    protected array $fillable = [];

    /**
     * The attributes that should be cast to native types.
     */
    protected array $casts = [];

    /**
     * @param array $where
     * @param array $field
     * @param string $orderBy
     * @return \Hyperf\Database\Model\Builder[]|\Hyperf\Database\Model\Collection
     */
    public function getBaseByListAll(array $where = [], array $field = ['*'], string $orderBy = 'id desc')
    {
        return $this->where($where)
            ->orderBy('id', 'desc')
            ->get($field);
    }
}
