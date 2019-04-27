<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Story extends Model
{   
    //Relationship start

    /*
     * A Story belong to a category
     */
    public function category()
    {
        return $this->belongsTo(Category::class)->withDefault();
    }

    /*
     * A Story has many comments
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    //Relationship end
}
