<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'story_id', 'user_id', 'body',
    ];

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

    public function getCommentDateAttribute()
    {
        return Carbon::parse($this->created_at)->isoFormat('MMM Do YYYY');
    }

    public function getCommentTimeAttribute()
    {
        return Carbon::parse($this->created_at)->format('g:i A');
    }


    //Relationship end
}
