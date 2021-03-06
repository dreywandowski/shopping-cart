<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
//use Laravel\Passport\HasApiTokens;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Sanctum\NewAccessToken;

class User extends Authenticatable
{
    use HasFactory,  HasApiTokens, Notifiable;
    const ADMIN_USER = 'admin';
    const NORMAL_USER = 'user';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'username',
        'address1',
        'address2',
        'state',
        'country',
        'email',
        'phone'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function isAdmin(){
        return $this->admin == User::ADMIN_USER;
    }

    public static function search($query)
    {
        return empty($query) ? static::query()->where('user_type', 'user')
            : static::where('user_type', 'user')
                ->where(function($q) use ($query) {
                    $q
                        ->where('name', 'LIKE', '%'. $query . '%')
                        ->orWhere('email', 'LIKE', '%' . $query . '%')
                        ->orWhere('address1', 'LIKE ', '%' . $query . '%');
                });
    }
}
