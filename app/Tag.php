<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = ['name'];

    public function getTagsIds($tags)
	{
		$tagsIds = array_filter(
	        $tags,function($value){ return is_numeric($value);}
	    );

		$newTags = array_diff($tags, $tagsIds);

		$newTagsIds = [];

		if(count($newTags) > 0)
		{	
			$now = \Carbon\Carbon::now();

			$prepareNewTags = array_map(function($tag) use($now){	
				return ['name'=>$tag,'created_at'=>$now,'updated_at'=>$now];
				}, $newTags
			);

			$newTagsIds = $this->getNewTagsIds($prepareNewTags);
		}

		return array_merge($tagsIds,$newTagsIds);
	}

	private function getNewTagsIds($prepareNewTags)
	{	
		$newTagsIds = \DB::transaction(function()use($prepareNewTags) {

		   // 1- get the last id of your table ($lastIdBeforeInsertion)
			$lastIdBeforeInsertion = static::latest('id')->first()->id;

		   // 2- insert your data
		   static::insert($prepareNewTags);

		  // 3- Getting the last inserted ids
		
          $insertedIds = array_map(
            function($tag,$key) use($lastIdBeforeInsertion){	
                return (string)($lastIdBeforeInsertion+$key+1);
            },$prepareNewTags,array_keys(array_values($prepareNewTags))
          );

		  return $insertedIds;

		});

		return $newTagsIds;
	}    
}
