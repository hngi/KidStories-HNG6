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
        'first_name', 'email', 'password','last_name','phone','location',
        'postal_code','is_admin', 'image_url', 'image_name'
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

    //Accessors
    public function getFullNameAttribute()
    {
        return ucwords($this->last_name . ' ' . $this->first_name);
    }
    // Accessors end

    //Relationship start

    /*
     * A User has  many stories
     */
    public function stories()
    {
        return $this->hasMany(Story::class);
    }

    /*
     * A User has  many comments
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    /*
     * A User has  many bookmarks
     */
    public function bookmarks()
    {
        return $this->belongsToMany(Story::class,'bookmarks');
    }

    /*
     * A User has  many reactions
     */
    public function reactions()
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
