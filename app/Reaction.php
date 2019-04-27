<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reaction extends Model
{   
    //Relationship start

    /*
     * A Reaction(like/unlike) belong to a story
     */
    public function story()
    {
        return $this->belongsTo(Story::class)->withDefault();
    }

    //Relationship end
}
