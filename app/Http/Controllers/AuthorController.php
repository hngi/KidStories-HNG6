<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Story;
use App\Category;
use App\Reaction;
use App\Bookmark;

class AuthorController extends Controller
{
    public function getStories(Request $request, $author)
    {
        $stories = Story::where('author', $author)->get();
        $categories = Category::limit(4)->get();

        $user = $request->user();

        for ($i=0; $i < $stories->count(); $i++) {
            $storyId = $stories[$i]->id;
            if ($user) {
                $reaction = Reaction::where('story_id', $storyId)
                    ->where('user_id', $user->id)
                    ->first();
                $bookmark = Bookmark::where('user_id', $user->id)
                    ->where('story_id', $storyId)
                    ->first();    
                if ($reaction && $reaction->reaction == 0) {
                    $stories[$i]['reaction'] = 'dislike';
                } elseif ($reaction && $reaction->reaction == 1) {
                    $stories[$i]['reaction'] = 'like';
                } else {
                    $stories[$i]['reaction'] = 'nil';
                }
                if ($bookmark) {
                    $stories[$i]['favorite'] = true;
                } else {
                    $stories[$i]['favorite'] = false;
                }
            } else {
                $stories[$i]['reaction'] = 'nil';
                $stories[$i]['favorite'] = false;
            }
            $reaction_count =  $this->reaction($storyId);
            $stories[$i]['likes_count'] = $reaction_count[0];
            $stories[$i]['dislikes_count'] = $reaction_count[1];
        }

       // return $stories;

        return view('authorstorieslisting', compact('stories', 'categories'));
    }

    public function reaction($id)
    {
        $like_reaction = Reaction::where('story_id', $id)
                        ->where('reaction', 1)->get();
        $likeCount = count($like_reaction);
        $dislike_reaction = Reaction::where('story_id', $id)
                    ->where('reaction', 0)->get();
        $dislikeCount = count($dislike_reaction);

        return [$likeCount, $dislikeCount];
    }
}
