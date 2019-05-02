<?php

namespace App\Traits\Api;

use Carbon\Carbon;

trait UserTrait
{
    /**
     * Get the post register / login redirect path.
     *
     * @return string
     */
    public function userIsPremuim()
    {
        $user = \App\User::find(request()->user('api')->id);
        $expires = $user->subscriptions->first()->expired_date;
        $now = Carbon::now();
        $active = $expires > $now;
        return $active;
    }

}
