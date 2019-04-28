<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Story;
use Illuminate\Support\Facades\Auth;
use App\Reaction as AppReaction;

class ReactionController extends Controller
{
    public function index()
    {
        $story = Story::with('user')
            ->orderBy('created_at', 'desc')
            ->get();
        return view('story', ['stories' => $story]);
    }

    public function user()
    {
        $user = Auth::user();
        if (!$user) {
            return "Unauthenticated user";
        }
    }

    public function like(Request $request, $id)
    {
        $storyId = $id;
        $action = $request['action'];
        $story = Story::find($storyId);
        if (!$story) {
            return "Story does not exist";
        }

        //user();

        $reaction = AppReaction::where('story_id', $storyId)->where('reaction', true)->first();
        if ($reaction) {
            $reaction->delete();
            $story->decrement('likes_count');
            return "User has removed like";
        } else {
            $reaction = new AppReaction();
        }

        $reaction->user_id = 1;
        $reaction->story_id = $story->id;
        $reaction->reaction = true;
        $reaction->save();
        // $action = $request->get('action');

        // switch ($action) {
        //     case 'Like':
        //         Story::where('id', $id)->increment('likes_count');
        //         break;
        //     case 'Unlike':
        //         Story::where('id', $id)->decrement('dislikes_count');
        //         break;
        // }

        // echo "<pre>";
        // print_r($action);
        // echo "</pre>";
        // die;
        //event(new Reaction($id, $action));
        return [$reaction, $story];
    }
}
