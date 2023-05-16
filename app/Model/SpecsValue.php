<?php

declare(strict_types=1);

namespace App\Model;


/**
 * @property int $id
 * @property int $specs_id
 * @property string $title
 * @property int $status
 * @property \Carbon\Carbon $create_time
 * @property \Carbon\Carbon $update_time
 * @property int $delete_time
 */
class SpecsValue extends Model
{
    /**
     * The table associated with the model.
     */
    protected ?string $table = 'specs_value';

    /**
     * The attributes that are mass assignable.
     */
    protected array $fillable = [];

    /**
     * The attributes that should be cast to native types.
     */
    protected array $casts = ['id' => 'integer', 'specs_id' => 'integer', 'status' => 'integer', 'create_time' => 'datetime', 'update_time' => 'datetime', 'delete_time' => 'integer'];

    public function specs()
    {
        return $this->hasOne(Spec::class, 'id', 'specs_id');
    }

}
