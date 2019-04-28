<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Bookmark;
use Auth;

class BookmarkController extends Controller
{
  

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
        $bookmark = Bookmark::where('user_id', Auth::user()->id)
                                ->where('story_id', $storyId)
                                ->first();

         if ($bookmark != null) {
            return response()->json([
                'status' => 'success',
                'code' => 200,
                'message' => 'OK',
                "data" => true
            ], 200);
         }

        Bookmark::create([
            "user_id" => Auth::user()->id,
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
        Bookmark::where('user_id', Auth::user()->id)
                ->where('story_id',$storyId)
                ->delete();

          return response()->json([
            'status' => 'success',
            'code' => 200,
            'message' => 'OK',
        ], 200);
    }


    public function status($story_id)
    {
        $status=Bookmark::where([['story_id','=',$story_id],['user_id','=',Auth::user()->id]])->first();

        if($status == null)
        {
            return response()->json([
                "status"=>201,
                "message"=>"user has bookmarked already",
                "data"=>true
            ]);
        }

         return response()->json([
                "status"=>201,
                "message"=>"user has not bookmarked this story",
                "data"=>false
            ]);


    }
}
