<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{   

    //Relationship start

    /*
     * A Category has many stories
     */
    public function stories()
    {
        return $this->hasMany(Story::class);
    }

    //Relationship end
}
