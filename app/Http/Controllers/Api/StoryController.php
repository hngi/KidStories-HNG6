<?php

namespace App\Http\Controllers\Api;

use App\Story;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Subscribed;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Resources\StoryResource;
use App\Http\Controllers\Controller;
use App\Reaction;

class StoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if ($this->isUserSubscribe()) {
            $stories = Story::all();
        } else {
            $stories = Story::where('is_premium', '=', false)->get();
        }

        return response([
            'status' => Response . HTTP_OK,
            'method' => 'GET',
            'message' => 'success',
            'data' => StoryResource::collection($stories)
        ], Response . HTTP_OK);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Story  $story
     * @return \Illuminate\Http\Response
     */
    public function show(Story $story)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Story  $story
     * @return \Illuminate\Http\Response
     */
    public function edit(Story $story)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Story  $story
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Story $story)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Story  $story
     * @return \Illuminate\Http\Response
     */
    public function destroy(Story $story)
    {
        //
    }

    public function isUserSubscribe()
    {
        $id = Auth::user()->id();
        $subscribed = Subscribed::where('user_id', '=', $id)
            ->where('expired_date', '>=', Carbon::now()->toDateString())->latest()->first();
        if ($subscribed != null) {
            return true;
        }
        return false;
    }

    /**
     * User can like a story or remove like.
     *
     * @param  \App\Reaction  $reaction
     * @return \Illuminate\Http\Response
     */
    public function like(Request $request, $id)
    {

        $user = $this->user();
        $story = $this->findstory($id);

        $reaction = Reaction::where('story_id', $story->id)->where('user_id', $user->id)->where('reaction', true)->first();
        if ($reaction) {
            $reaction->delete();
            $story->decrement('likes_count');
            return response()->json([
                'status' => 'success',
                'code' => 201,
                'message' => "User has removed like",
                'data' => [$reaction, $story, $user]
            ], 201);
        } else {
            $reaction = new Reaction();
        }

        $story->increment('likes_count');
        $reaction->user_id = $user->id;
        $reaction->story_id = $story->id;
        $reaction->reaction = true;
        $reaction->save();

        return response()->json([
            'status' => 'success',
            'code' => 201,
            'message' => 'User has liked story',
            'data' => [$reaction, $story, $user]
        ], 201);

        //return [$reaction, $story, $user];
    }

    /**
     * User can dislike a story or remove dislike.
     *
     * @param  \App\Reaction  $reaction
     * @return \Illuminate\Http\Response
     */
    public function dislike(Request $request, $id)
    {

        $user = $this->user();
        $story = $this->findstory($id);

        $reaction = Reaction::where('story_id', $story->id)->where('user_id', $user->id)->where('reaction', false)->first();
        if ($reaction) {
            $reaction->delete();
            $story->decrement('dislikes_count');
            return response()->json([
                'status' => 'success',
                'code' => 201,
                'message' => "User has removed dislike",
                'data' => [$reaction, $story, $user]
            ], 201);
        } else {
            $reaction = new Reaction();
        }

        $story->increment('dislikes_count');
        $reaction->user_id = $user->id;
        $reaction->story_id = $story->id;
        $reaction->reaction = false;
        $reaction->save();

        return response()->json([
            'status' => 'success',
            'code' => 201,
            'message' => 'User has disliked story',
            'data' => [$reaction, $story, $user]
        ], 201);

        //return [$reaction, $story, $user];
    }

    public function findstory($storyId)
    {
        $story = Story::find($storyId);
        if (!$story) {
            return response()->json([
                'status' => 'Not found',
                'code' => 404,
                'message' => "Story does not exist",
                'data' => null
            ], 404);
        } else {
            return $story;
        }
    }

    public function user()
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json([
                'status' => 'failed',
                'code' => 401,
                'message' => 'User unauthenticated',
                'data' => null
            ], 401);
        } else {
            return $user;
        }
    }
}
