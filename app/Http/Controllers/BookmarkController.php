<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Reaction;
use App\Http\Resources\StoryResource;

class BookmarkController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if (!$user) {
            return \redirect('home');
        }
        $bookmarks =  \App\User::find(auth()->id())->bookmarks;
        $data = StoryResource::collection($bookmarks);

        for ($i=0; $i < $data->count(); $i++) { 
            $storyId = $data[$i]->id;
            if ($user) {
                $reaction = Reaction::where('story_id', $storyId)
                    ->where('user_id', $user->id)
                    ->first();
                if ($reaction && $reaction->reaction == 0) {
                    $data[$i]['reaction'] = 'dislike';
                } elseif ($reaction && $reaction->reaction == 1) {
                    $data[$i]['reaction'] = 'like';
                } else {
                    $data[$i]['reaction'] = 'nil';
                }
            } else {
                $data[$i]['reaction'] = 'nil';
            }
        }

        return view('bookmark', ['bookmarks' => $data]);
    }
}
