<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{

    //Relationship start

    /*
     * A Comment belong to a user
     */
    public function user()
    {
        return $this->belongsTo(User::class)->withDefault();
    }

    /*
     * A Comment belong to a story
     */
    public function story()
    {
        return $this->belongsTo(Story::class)->withDefault();
    }

    //Relationship end
}
