<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Story extends Model
{
    protected $fillable = [
        'title', 'body', 'category_id', 'age_from', 'age_to', 'author', 
        'image_url', 'image_name', 'user_id', 'is_premium'
    ];

    //Accessors
    public function getAgeAttribute()
    {
        return ucwords($this->age_from . '-' . $this->age_to);
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
}
