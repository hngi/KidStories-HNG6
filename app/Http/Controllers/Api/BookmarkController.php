<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Bookmark;
use Auth;
use App\Http\Resources\StoryResource;
use Symfony\Component\HttpFoundation\Response;

class BookmarkController extends Controller
{
    public function index (){

         $bookmarks =  \App\User::find(auth()->id())->bookmarks;

        return response()->json([
            'status' => 'success',
            'code' => 200,
            'message' => 'OK',
            "data" => StoryResource::collection($bookmarks)
        ], Response::HTTP_OK);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $storyId
     * @return \Illuminate\Http\Response
     */
    public function add(Request $request, $storyId)
    {
        //check if the person has bookmarked before
        $bookmark = Bookmark::where('user_id', auth()->id())
                                ->where('story_id', $storyId)
                                ->first();

         if ($bookmark != null) {
             $bookmark->delete();
            return response()->json([
                'status' => 'success',
                'code' => 200,
                'message' => 'Removed',
                "data" => true
            ], 200);
         }

        Bookmark::create([
            "user_id" => auth()->id(),
            "story_id" => $storyId
        ]);

        return response()->json([
            'status' => 'success',
            'code' => 201,
            'message' => 'Created',
            "data" => true
        ], 201);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $storyId
     * @return \Illuminate\Http\Response
     */
    public function remove($storyId)
    {
        Bookmark::where('user_id', auth()->id())
                ->where('story_id',$storyId)
                ->delete();

          return response()->json([
            'status' => 'success',
            'code' => 204,
            'message' => 'deleted',
        ], 204);
    }

    /**
     * Check the status of a bookmark
     *
     * @param  int  $storyId
     * @return \Illuminate\Http\Response
     */
    public function status($storyId)
    {
        $status = Bookmark::where('user_id', auth()->id())
                                ->where('story_id', $storyId)
                                ->first();

        $response = is_null($status) ? false : true;

        return response()->json([
            'status' => 'success',
            'code' => 200,
            'message' => 'OK',
            "data" => $response
        ], 200);
    }

}
