<?php

declare(strict_types=1);

namespace App\Model;


/**
 * @property int $id
 * @property string $title
 * @property int $type
 * @property int $sku_id
 * @property int $category_id
 * @property string $unit
 * @property int $is_video
 * @property int $video_type
 * @property string $video_url
 * @property int $status
 * @property int $specification
 * @property string $price
 * @property string $market_price
 * @property string $cost_price
 * @property int $stock
 * @property string $product_id
 * @property string $weight
 * @property int $volume
 * @property string $description
 * @property string $logistics_type
 * @property string $url
 * @property string $banner
 * @property int $logistics_cate
 * @property string $logistics_price
 * @property int $logistics_formwork
 * @property int $number
 * @property int $integral
 * @property int $is_purchase
 * @property int $purchase_type
 * @property int $purchase_number
 * @property int $is_booking
 * @property int $booking_time_start
 * @property int $booking_time_end
 * @property int $booking_send_time
 * @property string $recommend
 * @property string $title_keywords
 * @property string $title_description
 * @property int $delete_time
 * @property int $sort
 * @property \Carbon\Carbon $create_time
 * @property \Carbon\Carbon $update_time
 */
class Good extends Model
{
    /**
     * The table associated with the model.
     */
    protected ?string $table = 'goods';

    /**
     * The attributes that are mass assignable.
     */
    protected array $fillable = [];

    /**
     * The attributes that should be cast to native types.
     */
    protected array $casts = [
        'id' => 'integer',
        'title' => 'string',
        'sku_id' => 'string',
        'unit' => 'string',
        'type' => 'integer',
        'category_id' => 'integer',
        'is_video' => 'integer',
        'video_type' => 'integer',
        'video_url' => 'string',
        'status' => 'integer',
        'specification' => 'integer',
        'stock' => 'integer',
        'volume' => 'integer',
        'price' => 'string',
        'market_price' => 'string',
        'cost_price' => 'string',
        'product_id' => 'string',
        'weight' => 'string',
        'description' => 'string',
        'status_novel_pay' => 'string',
        'logistics_cate' => 'integer',
        'logistics_price' => 'string',
        'logistics_formwork' => 'integer',
        'number' => 'integer',
        'integral' => 'integer',
        'is_purchase' => 'integer',
        'purchase_type' => 'integer',
        'purchase_number' => 'integer',
        'is_booking' => 'integer',
        'booking_time_start' => 'integer',
        'booking_time_end' => 'integer',
        'booking_send_time' => 'integer',
        'recommend' => 'json',
        'title_keywords' => 'string',
        'title_description' => 'string',
        'delete_time' => 'integer',
        'create_time' => 'integer',
        'update_time' => 'integer',
        'banner' => 'string',
        'url' => 'string',
        'logistics_type' => 'json',
        'sort' => 'integer'
    ];
}
