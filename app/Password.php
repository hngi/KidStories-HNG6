<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Password extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'password_resets';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'token', 'created_at',
    ];

    public $timestamps = false;
}
