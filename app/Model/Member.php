<?php

declare(strict_types=1);

namespace App\Model;


use Qbhy\HyperfAuth\AuthAbility;
use Qbhy\HyperfAuth\Authenticatable;

/**
 * @property int $id
 * @property string $nickName
 * @property string $openid
 * @property string $mobile
 * @property string $userName
 * @property string $header_img
 * @property string $realName
 * @property int $status
 * @property \Carbon\Carbon $create_time
 * @property \Carbon\Carbon $update_time
 * @property int $delete_time
 */
class Member extends Model implements Authenticatable
{
    /**
     * The table associated with the model.
     */
    protected ?string $table = 'member';

    /**
     * The attributes that are mass assignable.
     */
    protected array $fillable = ['openid'];

    /**
     * The attributes that should be cast to native types.
     */
    protected array $casts = ['id' => 'integer', 'status' => 'integer', 'create_time' => 'datetime', 'update_time' => 'datetime', 'delete_time' => 'integer', 'openid' => 'string'];

    use AuthAbility;
}
