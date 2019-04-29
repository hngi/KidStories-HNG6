<?php

namespace App\Http\Controllers\Api;

use App\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CommentsController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $request->validate([
            'body' => ['required', 'string','min:3']
        ]);

        $comment = Comment::create([
            'story_id'=>$request->story_id,
            'user_id'=>auth()->id(),
            'body'=>$request->body
        ]);

        return response()->json([
            "status"=>201,
            "message"=>"created",
            "data"=>$comment
        ],201);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'body' => ['required', 'string','min:3']
        ]);

        $comment = Comment::findOrFail($id);

        $comment->update([
            'body'=>$request->body
        ]);

        return response()->json([
            "status"=>201,
            "message"=>"created",
            "data"=>$comment
        ],201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destory($id)
    {
        $comment = Comment::findOrFail($id);

        $comment->delete();

        return response()->json([
            'status'=>204,
            'message'=>'deleted'
        ], 204);
    }
}
