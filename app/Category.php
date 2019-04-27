<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function story()
    {
        return $this->hasMany('App\Story');
    }
}
