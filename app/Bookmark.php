<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bookmark extends Model
{
	protected $fillable=['user_id','story_id'];
    //Relationship start

    /*
     * A Bookmark belong to a user
     */
    public function user()
    {
        return $this->belongsTo(User::class)->withDefault();
    }

    //Relationship end
}
