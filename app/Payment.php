<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    //Relationship start

    /*
     * A payment belong to a user
     */
    public function user()
    {
        return $this->belongsTo(User::class)->withDefault();
    }
}
