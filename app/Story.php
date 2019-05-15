<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Story extends Model
{
    protected $fillable = [
        'title', 'body', 'category_id', 'age_from', 'age_to', 'author', 
        'image_url', 'image_name', 'user_id', 'is_premium','is_approved'
    ];

    // FIXME: Please, don't uncomment. Understand what you are about to do first.
    // protected $appends = ['like','dislike'];

     /**
     * Boot the model.
     */
    protected static function boot()
    {
        parent::boot();

        static::created(function ($story) {
            $story->slug = $story->title;
            $story->save();
        });

        static::addGlobalScope('approved', function (Builder $builder) {
            $builder->where('is_approved', '!=', false);
        });
    }

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

    public function getReactionAttribute()
    {   
        if(!is_null(auth()->id())){
            $reaction = $this->reactions()->where(
                'user_id',auth()->id()
            )->first();
                
            if($reaction){
                return $reaction->reaction == 1?'like':'dislike';
            }else{
                return 'nil';
            }
        }
        
        return 'nil';
    }

    public function getFavoriteAttribute()
    {   
        if(!is_null(auth()->id())){
            $bookmark = $this->bookmarks()->where(
                'user_id',auth()->id()
            )->first();
            
            return $bookmark ?true:false;
        }

        return false;
        
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
    //Mutator

    /**
     * Set the proper slug attribute.
     *
     * @param string $value
     */
    public function setSlugAttribute($value)
    {
        if (static::whereSlug($slug = str_slug($value))->exists()) {
            $slug = "{$slug}-{$this->id}";
        }

        $this->attributes['slug'] = $slug;
    }

    //Mutator end
    
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

    public function likeReactions()
    {
        return $this->hasMany(Reaction::class)->where('reaction',1);
    }

    public function bookmarks()
    {
        return $this->hasMany(Bookmark::class);
    }

    /*
     * A Story belongs to many tags
     */
    public function tags()
    {
        return $this->belongsToMany(Tag::class)->withTimestamps();
    }

    //Relationship end

    //Local scope start
    public function scopeSimilar($query)
    {   
        return $query->where(
            'category_id',$this->category_id
        )->where('id','!=',$this->id)->take(4);
    }

    public function scopeTrending($query)
    {   
        return $query->withCount('likeReactions')
            ->orderBy('like_reactions_count', 'desc');
        
    }

    //Local scope end
    /**
     * Get the route key name.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

}
