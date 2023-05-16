<?php

declare(strict_types=1);

namespace App\Model;


/**
 * @property int $id
 * @property int $goods_id
 * @property string $url
 * @property string $price
 * @property string $market_price
 * @property string $cost_price
 * @property int $stock
 * @property string $product_id
 * @property int $status
 * @property \Carbon\Carbon $create_time
 * @property \Carbon\Carbon $update_time
 * @property int $delete_time
 */
class GoodsSku extends Model
{
    /**
     * The table associated with the model.
     */
    protected ?string $table = 'goods_sku';

    /**
     * The attributes that are mass assignable.
     */
    protected array $fillable = [];

    /**
     * The attributes that should be cast to native types.
     */
    protected array $casts = ['id' => 'integer', 'goods_id' => 'integer', 'stock' => 'integer', 'status' => 'integer', 'create_time' => 'datetime', 'update_time' => 'datetime', 'delete_time' => 'integer'];
}
