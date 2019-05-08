<?php

namespace App\Http\Controllers;

use Auth;
use App\Story;
use App\Reaction;
use App\Category;
use App\Bookmark;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$categories = Category::all();

        return view('categories', compact('categories'));
    }

    /**
     * Display the stories related to a category.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function stories(Request $request, $id)
    {
        if ($request->query('search')) {
            $search = $request->query('search');

            $stories = Story::where('category_id', $id)->where('is_approved', true)
                            ->where('title', 'LIKE', "%$search%");
        } else {
            $stories = Story::where('category_id', $id)->where('is_approved', true);
        }

        // Sorting feature
        if (!is_null($request->query('minAge')) && !is_null($request->query('maxAge'))) {
            $minAge = $request->query('minAge');
            $maxAge = $request->query('maxAge');
            
            $stories = $stories->where('age_from', '>=', $minAge)
                            ->where('age_to', '<=', $maxAge)
                            ->orderBy("age_from")->paginate(21);
        } else {
            $stories = $stories->paginate(21);
        }
        // Sorting feature ends

        $categories = Category::limit(4)->get();

        $currentCategory = $id;

        
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

        return view('categories_stories', compact('stories', 'categories', 'currentCategory'));

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

