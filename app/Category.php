<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name', 'image_url', 'image_name'];

    //Relationship start

    /*
     * A category has many stories
     */
    public function stories()
    {
        return $this->hasMany(Story::class)->withDefault();
    }

    //Relationship end
}
