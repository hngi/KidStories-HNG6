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
        'first_name', 'email', 'password','last_name','phone','location','postal_code','is_admin'
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

    //Relationship start

    /*
     * A User has  many stories
     */
    public function story()
    {
        return $this->hasMany(Story::class);
    }

    /*
     * A User has  many comments
     */
    public function comment()
    {
        return $this->hasMany(Comment::class);
    }

    /*
     * A User has  many bookmarks
     */
    public function bookmarks()
    {
        return $this->hasMany(Bookmark::class);
    }

    /*
     * A User has  many reactions
     */
    public function reaction()
    {
        return $this->hasMany(Reaction::class);
    }
    /**
     * users has many subscription
     */
    public function subscriptions()
    {
        return $this->hasMany(Subscribed::class);
    }

    //Relationship end
}
