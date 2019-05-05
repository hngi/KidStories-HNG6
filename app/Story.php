<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Story extends Model
{
    protected $fillable = [
        'title', 'body', 'category_id', 'age_from', 'age_to', 'author', 
        'image_url', 'image_name', 'user_id', 'is_premium'
    ];

    // FIXME: Please, don't uncomment. Understand what you are about to do first.
    // protected $appends = ['like','dislike'];

    //Accessors
    public function getAgeAttribute()
    {
        return ucwords($this->age_from . '-' . $this->age_to);
    }

    public function getLikesAttribute()
    {
        return $this->reactions()->where('reaction',1)->count();
    }

    public function getDislikesAttribute()
    {
        return $this->reactions()->where('reaction',0)->count();
    }

    public function getreadingTimeAttribute($text) {
        $wordsPerMinute = 200;
        $numberOfWords =  count(explode(' ', $this->body));
        $minutes = $numberOfWords / $wordsPerMinute;
        $readTime = ceil($minutes);

        return  $minutes > 1 ? "$readTime minutes read" : "$readTime minute read";
    }

    public function getSubscriptionAttribute(){
        return $this->is_premium == 1?'Premium':'Regular';
    }
    // Accessors end

    
    //Relationship start

    /*
     * A Story belong to a user
     */
    public function user()
    {
        return $this->belongsTo(User::class)->withDefault();
    }

    /*
     * A Story belong to a category
     */
    public function category()
    {
        return $this->belongsTo(Category::class)->withDefault();
    }

    /*
     * A Story has many comments
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    /*
     * A Story has many reactions
     */
    public function reactions()
    {
        return $this->hasMany(Reaction::class);
    }

    public function bookmarkedBy()
    {
        return $this->belongsToMany(Users::class,'bookmarks');
    }

    //Relationship end

    /*
     * A Story belongs to many tags
     */
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function scopeSimilar($query)
    {
        return $query->where('category_id',$this->category_id)->take(4);
    }


}
