<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'gender', 'height'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static $genders = [
            0 => '不明',
            1 => '男性',
            2 => '女性',
            ];

    public static function getGenderLabel($gender_code) {
        $ret = null;

        if (!empty(self::$genders[$gender_code])) {
            $ret = self::$genders[$gender_code];
        }

        return $ret;

    }
    
}
