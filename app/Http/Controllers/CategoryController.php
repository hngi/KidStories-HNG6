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
    public function show($id)
    {
        //
        $category = Category::find($id);
        return view('storieslisting', compact('category'));

    }
    /**
     * 
     */
    public function filter($id)
    {
        $stories = Story::orderBy('id','desc')->where('category_id',$id)->get();
        $category = Category::find($id);
        return view('filteredlisting', compact('category','stories'));
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

        return view('filteredlisting', compact('category','stories'));
    }
}

