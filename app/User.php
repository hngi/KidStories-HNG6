<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
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

    public function story()
    {
        return $this->hasMany('App\Story');
    }

    public function reaction()
    {
        return $this->hasMany('App\Reaction');
    }

    public function comment()
    {
        return $this->hasMany('App\Comment');
    }

    public function bookmark()
    {
        return $this->hasMany('App\Bookmark');
    }

    public function category()
    {
        return $this->hasMany('App\Category');
    }

    public function payment()
    {
        return $this->hasMany('App\Payment');
    }
}
