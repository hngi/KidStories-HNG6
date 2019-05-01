<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    //
    protected $guarded = [];

    /*
    * A Tag has many stories
    */
   public function stories()
   {
       return $this->belongsToMany(Story::class);
   }
}
