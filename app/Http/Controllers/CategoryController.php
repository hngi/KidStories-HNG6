<?php

namespace App\Http\Controllers;

use Auth;
use App\Category;
use App\Story;
use App\Reaction;
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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        //
        $category = Category::find($id);
        $user = $request->user();


        for ($i=0; $i < $category->stories->count(); $i++) {
            $storyId = $category->stories[$i]->id;
            if ($user) {
                $test = 0;
                $reaction = Reaction::where('story_id', $storyId)
                ->where('user_id', $user->id)
                ->first();
                if ($reaction && $reaction->reaction == 0) {
                    $category->stories[$i]['reaction'] = 'dislike';
                } elseif ($reaction && $reaction->reaction == 1) {
                    $category->stories[$i]['reaction'] = 'like';
                } else {
                    $category->stories[$i]['reaction'] = 'nil';
                }
            }else {
                $test = 1;
                $category->stories[$i]['reaction'] = 'nil';
            }

        }
        return view('storieslisting', compact('category'));

    }

    /**
     * Display the specified resource.
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

        $stories = ($request->query('sort') == 'latest') 
                        ? $stories->latest()->get() 
                        : $stories->get();

        //Retrieve current query strings:
        $currentQueries = $request->query();

        //Declare new queries you want to append to string:
        $newQueries = [$request->query('search'), $request->query('sort')];

        //Merge together current and new query strings:
        $allQueries = array_merge($currentQueries, $newQueries);

        //Generate the URL with all the queries:
        $request->fullUrlWithQuery($allQueries);

        // dd($request->fullUrlWithQuery($allQueries));
        // dd($allQueries);

        $categories = Category::limit(4)->get();

        $currentCategory = $id;

        
        $user = $request->user();

        for ($i=0; $i < $stories->count(); $i++) {
            $storyId = $stories[$i]->id;
            if ($user) {
                $reaction = Reaction::where('story_id', $storyId)
                ->where('user_id', $user->id)
                ->first();
                if ($reaction && $reaction->reaction == 0) {
                    $stories[$i]['reaction'] = 'dislike';
                } elseif ($reaction && $reaction->reaction == 1) {
                    $stories[$i]['reaction'] = 'like';
                } else {
                    $stories[$i]['reaction'] = 'nil';
                }
            }else {
                $stories[$i]['reaction'] = 'nil';
            }

        }

        return view('categories_stories', compact('stories', 'categories', 'currentCategory'));

    }

    /**
     *
     */
    public function filter(Request $request, $id)
    {
        $stories = Story::orderBy('id','desc')->where('category_id',$id)->get();
        $category = Category::find($id);$user = $request->user();

        $user = $request->user();


        for ($i=0; $i < $stories->count(); $i++) {
            $storyId = $stories[$i]->id;
            if ($user) {
                $test = 0;
                $reaction = Reaction::where('story_id', $storyId)
                ->where('user_id', $user->id)
                ->first();
                if ($reaction && $reaction->reaction == 0) {
                    $stories[$i]['reaction'] = 'dislike';
                } elseif ($reaction && $reaction->reaction == 1) {
                    $stories[$i]['reaction'] = 'like';
                } else {
                    $stories[$i]['reaction'] = 'nil';
                }
            }else {
                $test = 1;
                $stories[$i]['reaction'] = 'nil';
            }

        }
        return view('storieslisting', compact('category','stories'));
    }
    public function filterByAge(Request $request, $id)
    {
        $stories = Story::orderBy('age_from','desc')->where('category_id', $id)->get();
        $category = Category::find($id);
        $user = $request->user();


        for ($i=0; $i < $stories->count(); $i++) {
            $storyId = $stories[$i]->id;
            if ($user) {
                $test = 0;
                $reaction = Reaction::where('story_id', $storyId)
                ->where('user_id', $user->id)
                ->first();
                if ($reaction && $reaction->reaction == 0) {
                    $stories[$i]['reaction'] = 'dislike';
                } elseif ($reaction && $reaction->reaction == 1) {
                    $stories[$i]['reaction'] = 'like';
                } else {
                    $stories[$i]['reaction'] = 'nil';
                }
            }else {
                $test = 1;
                $stories[$i]['reaction'] = 'nil';
            }

        }

        return view('storieslisting', compact('category','stories'));
    }
}

