<?php

declare(strict_types=1);

namespace App\Model;


use Qbhy\HyperfAuth\AuthAbility;
use Qbhy\HyperfAuth\Authenticatable;

/**
 * @property int $id
 * @property string $userName
 * @property string $password
 * @property string $code
 * @property string $token
 * @property string $last_login
 * @property int $last_login_time
 * @property int $status
 * @property string $autograph
 * @property int $sex
 * @property int $create_time
 * @property int $update_time
 * @property int $delete_time
 */
class User extends Model implements Authenticatable
{
    use AuthAbility;

    /**
     * The table associated with the model.
     */
    protected ?string $table = 'user';

    /**
     * The attributes that are mass assignable.
     */
    protected array $fillable = [];

    /**
     * The attributes that should be cast to native types.
     */
    protected array $casts = ['id' => 'integer', 'last_login_time' => 'integer', 'status' => 'integer', 'create_time' => 'integer', 'update_time' => 'integer', 'delete_time' => 'integer'];

    /**
     * @param $value
     * @return false|string
     */
    public function getLastLoginIpAttribute($value): bool|string
    {
        return long2ip($value);
    }
}
