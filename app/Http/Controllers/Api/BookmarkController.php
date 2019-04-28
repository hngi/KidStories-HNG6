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
     * @return \Illuminate\Http\Response
     */
    public function add(Request $request,$story_id)
    {
        //check if the person has bookmarked before

         $checkIsBookmark=Bookmark::where([['user_id','=',Auth::user()->id],['story_id','=',$story_id]])->first();

         if($checkIsBookmark != null)
         {
              return response()->json([
            "status"=>201,
            "message"=>"the user has bookmarked the story already",
            "data"=>$checkIsBookmark
                ]);
         }



        $bookmark=Bookmark::create([
            "user_id"=>Auth::user()->id,
            "story_id"=>$story_id
        ]);

        return response()->json([
            "status"=>201,
            "message"=>"bookmarked",
            "data"=>$bookmark
        ]);

    }

    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function remove($id)
    {
        //
        $bookmark=Bookmark::where([['user_id','=',Auth::user()->id],['story_id','=',$story_id]]);

        $bookmark->delete();

          return response()->json([
            "status"=>201,
            "message"=>"bookmark removed",
        
        ]);




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
