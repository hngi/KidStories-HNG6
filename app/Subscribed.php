<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subscribed extends Model
{
    /**
     * fillable properties for subscribed
     */
    protected $fillable = [
        'user_id','subscribe_id','expired_date'
    ];

    //Relationship start

    /*
     * A Subscribed belong to a subscription
     */
    public function subscription()
    {
        return $this->belongsTo(Subscription::class)->withDefault();
    }

    /**
     * A subscribed row belongs to a user
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    //Relationship end
}
