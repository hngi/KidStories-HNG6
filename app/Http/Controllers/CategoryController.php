<?php

namespace App\Http\Controllers;

use App\Category;
use App\Story;
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
        $stories = Story::orderBy('id','desc')->where('category_id',1)->get();
        $category = Category::find($id);
        return view('filteredlisting', compact('category','stories'));
    }
    public function filterByAge($id)
    {
        $stories = Story::orderBy('age_from','desc')->where('category_id',1)->get();
        $category = Category::find($id);
        return view('filteredlisting', compact('category','stories'));
    }
}

