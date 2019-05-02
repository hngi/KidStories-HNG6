<?php

namespace App\Http\Controllers\Api;

use App\Tag;
use App\Story;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TagController extends Controller
{
    /**
     * Fetch all tags
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags = Tag::all();
        $tagsStories = $tags->each(function($tag){
            $tag->stories;
        });
        return response()->json([
            'status' => 'success',
            'code' => 200,
            'message' => 'OK',
            'data' => $tagsStories
        ], 200);
    }

    /**
     * This gets all the stories related to a tag
     *
     * @param string $tagName
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storiesByTag(Request $request, $tagName){
        $data = '';

        $tags = Tag::where('name', 'LIKE', "{$tagName}%")->get();
        
        $data = $tags;

        return response()->json([
            'status' => 'success',
            'code' => 200,
            'message' => 'OK',
            'data' => $data
        ], 200);

    }

}
