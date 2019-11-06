<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Story;

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
            'body' => ['required', 'string', 'min:3'],
            'story_id' => ['required']
        ]);

        Story::findOrFail($request->story_id);

        Comment::create([
            'story_id' => $request->story_id,
            'user_id' => auth()->id(),
            'body' => $request->body
        ]);

        return back()->with('success', 'Comment added');
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

        return back()->with('success', 'Comment updated');
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

        return back()->with('success', 'Comment deleted');
    }
}
