<?php

declare(strict_types=1);

namespace App\Model;



/**
 * @property int $id 
 * @property string $fileName 
 * @property string $url 
 * @property string $type 
 * @property string $ext 
 * @property string $md5 
 * @property int $status 
 * @property \Carbon\Carbon $create_time 
 * @property \Carbon\Carbon $update_time 
 * @property int $delete_time 
 */
class Uploader extends Model
{
    /**
     * The table associated with the model.
     */
    protected ?string $table = 'uploader';

    /**
     * The attributes that are mass assignable.
     */
    protected array $fillable = [];

    /**
     * The attributes that should be cast to native types.
     */
    protected array $casts = ['id' => 'integer', 'status' => 'integer', 'create_time' => 'datetime', 'update_time' => 'datetime', 'delete_time' => 'integer'];
}
