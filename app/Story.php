<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Story extends Model
{
    //Relationship start

    /*
     * A Story belong to a user
     */
    public function user()
    {
        return $this->belongsTo(User::class)->withDefault();
    }

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
        return $this->hasMany(Comment::class)->withDefault();
    }

    /*
     * A Story has many reactions
     */
    public function reaction()
    {
        return $this->hasMany(Reaction::class)->withDefault();
    }

    //Relationship end
}
