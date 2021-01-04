<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
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
        'username', 'email', 'profilePicturePath', 'userRole', 'password', "isBanned", 'title', 'lastName', 'firstName', 'private'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password'
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

    /**
     * @param string $email
     * @return User|null
     */
    public static function getOneUserByEmail(string $email) {
        $user = DB::table('users')->where('email', $email)->first();

        if (!empty($user))
            return new User(get_object_vars($user));

        return null;
    }

    /**
     * @param string $username
     * @return array | null
     */
    public static function getOneUserByUsername(string $username) {
        $user = DB::table('users')->where('username', $username)->first();

        if (empty($user))
            return null;

        return get_object_vars($user);
    }

    /**
     * @param array $attributes
     * @param array $options
     * @return bool
     */
    public function update(array $attributes = [], array $options = []): bool
    {
        return parent::update($attributes, $options);
    }


}
