<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Story extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function reaction()
    {
        return $this->hasMany('App\Reaction');
    }

    public function category()
    {
        return $this->hasMany('App\Category');
    }

    public function comment()
    {
        return $this->hasMany('App\Comment');
    }
}
