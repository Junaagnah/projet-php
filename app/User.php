<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Model;
use Laravel\Lumen\Auth\Authorizable;

class User extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'profilePicturePath', 'UserRole', 'password', 'bearer_token'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'bearer_token'
    ];

    /**
     * @return array
     */
    public function getGuarded(): array
    {
        return $this->guarded;
    }

    /**
     * @param array $guarded
     */
    public function setGuarded(array $guarded): void
    {
        $this->guarded = $guarded;
    }

    /**
     * @return bool
     */
    public static function isUnguarded(): bool
    {
        return self::$unguarded;
    }

    /**
     * @param bool $unguarded
     */
    public static function setUnguarded(bool $unguarded): void
    {
        self::$unguarded = $unguarded;
    }

    /**
     * @return array
     */
    public static function getGuardableColumns(): array
    {
        return self::$guardableColumns;
    }

    /**
     * @param array $guardableColumns
     */
    public static function setGuardableColumns(array $guardableColumns): void
    {
        self::$guardableColumns = $guardableColumns;
    }


}
