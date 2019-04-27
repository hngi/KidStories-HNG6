<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{   
    //Relationship start

    /*
     * A Subscription has many subscribes
     */
    public function subscribeds()
    {
        return $this->hasMany(Subscribed::class);
    }

    //Relationship end
}
