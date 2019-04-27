<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subscribed extends Model
{
    
    //Relationship start

    /*
     * A Subscribed belong to a subscription
     */
    public function subscription()
    {
        return $this->belongsTo(Subscription::class)->withDefault();
    }

    //Relationship end
}
