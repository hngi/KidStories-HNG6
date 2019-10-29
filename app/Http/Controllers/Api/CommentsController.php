<?php

namespace App\Http\Controllers\Api;

use App\Story;
use App\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CommentsController extends Controller
{

    public function index($id)
    {
        $comments = Comment::where('story_id', $id)->get();
        return response()->json([
            'status' => 'suucess',
            'code' => 201,
            'message' => 'created',
            "data" => $comments
        ], 201);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'body' => ['required', 'string', 'min:3'],
            'story_id' => ['required']
        ]);

        Story::findOrFail($request->story_id);

        $comment = Comment::create([
            'story_id' => $request->story_id,
            'user_id' => auth()->id(),
            'body' => $request->body
        ]);

        return response()->json([
            'status' => 'suucess',
            'code' => 201,
            'message' => 'created',
            "data" => $comment
        ], 201);
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
            'body' => ['required', 'string', 'min:3']
        ]);

        $comment = Comment::where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        $comment->update([
            'body' => $request->body
        ]);

        return response()->json([
            'status' => 'success',
            'code' => 200,
            'message' => 'created',
            'data' => $comment
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destory($id)
    {
        $comment = Comment::where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        $comment->delete();

        return response()->json([
            'status' => 'success',
            'code' => 204,
            'message' => 'deleted'
        ], 204);
    }
}
