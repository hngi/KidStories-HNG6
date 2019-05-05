<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Bookmark;
use App\Reaction;

class StoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'            => $this->id,
            'title'         => $this->title,
            'body'          => $this->body,
            'category_id'   => $this->category_id,
            'user_id'       => $this->user_id,
            'image_url'     => $this->image_url,
            'image_name'    => $this->image_name,
            'age'           => $this->age,
            'author'        => $this->author,
            'story_duration'=> $this->readingTime ,
            'is_premium'    => $this->is_premium,
            'likes_count'   => $this->likes_count,
            'dislikes_count'=> $this->dislikes_count,
            'reaction'      => $this->getReaction($request, $this->id),
            'bookmark'      => $this->getBookmarkStatus($request, $this->id)
        ];
    }

    public function getReaction($request, $storyId)
    {
        $user = $request->user('api');
        if ($user) {
            $reaction = Reaction::where('story_id', $storyId)
                    ->where('user_id', $user->id)
                    ->first();
            if ($reaction) {
                return $reaction->reaction; 
            }        
                   
        }
            return 'nil';
        
        
    }

    public function getBookmarkStatus($request, $storyId)
    {
        $user = $request->user('api');
        if ($user) {
            $bookmark = Bookmark::where('story_id', $storyId)
                    ->where('user_id', $user->id)
                    ->first();
            if ($bookmark) {
                return true;
            }
                            
        }
            return false;
        
    }

}
