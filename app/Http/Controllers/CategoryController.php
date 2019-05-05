<?php

namespace App\Http\Controllers;

use Auth;
use App\Category;
use App\Story;
use App\Reaction;
use App\Bookmark;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
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

            $stories = Story::where('category_id', $id)
                            ->where('title', 'LIKE', "%$search%")
                            ->orWhere('author', 'LIKE', "%$search%");
        } else {
            $stories = Story::where('category_id', $id);
        }

        if ($request->query('sort') == 'latest') {
            $stories = $stories->latest()->paginate(21);
        } else if ($request->query('sort') == 'age') {
            $stories = $stories->orderBy("age_from")->paginate(21);
        } else {
            $stories = $stories->paginate(21);
        }

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

        }

        return view('categories_stories', compact('stories', 'categories', 'currentCategory'));

    }
}

