<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{   
    //Relationship start
protected $fillable=['subscription_id','user_id','expired_date'];
    /**
     * A Subscription has many subscribes
     */
    public function subscribeds()
    {
        return $this->hasMany(Subscribed::class);
    }

    //Relationship end
}
