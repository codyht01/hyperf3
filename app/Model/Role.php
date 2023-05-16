<?php

declare(strict_types=1);

namespace App\Model;



/**
 * @property int $id 
 * @property string $roleName 
 * @property string $roleSign 
 * @property int $sort 
 * @property int $status 
 * @property string $description 
 * @property string $menuProps 
 * @property \Carbon\Carbon $create_time 
 * @property \Carbon\Carbon $update_time 
 * @property int $delete_time 
 */
class Role extends Model
{
    /**
     * The table associated with the model.
     */
    protected ?string $table = 'role';

    /**
     * The attributes that are mass assignable.
     */
    protected array $fillable = [];

    /**
     * The attributes that should be cast to native types.
     */
    protected array $casts = ['id' => 'integer', 'sort' => 'integer', 'status' => 'integer', 'create_time' => 'datetime', 'update_time' => 'datetime', 'delete_time' => 'integer'];
}
