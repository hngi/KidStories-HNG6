<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

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
            'author'        => $this->author,
            'age'           => $this->age,
            'author'        => $this->author,
            'story_duration'=> $this->readingTime($this->body) ,
            'is_premium'    => $this->is_premium,
            'likes_count'   => $this->likes_count,
            'dislikes_count'=> $this->dislikes_count
        ];
    }

    public function readingTime($text) {
        $wordsPerMinute = 200;
        $numberOfWords =  count(explode(' ', $text));
        $minutes = $numberOfWords / $wordsPerMinute;
        $readTime = ceil($minutes);

        return  $minutes > 1 ? "$readTime minutes read" : "$readTime minute read";
      }
}
