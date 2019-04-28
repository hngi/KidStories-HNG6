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
            'title' => $this->title,
            'category_id'=> $this->category_id,
            'user_id' => $this->user_id,
            'image_url' => $this->image_url,
            'image_name' => $this->image_name,
            'age'       => $this->age,
            'author' => $this->author,
            'story_duration' => $this->story_duration,
            'is_premium' => $this->is_premium

        ];
    }
}
