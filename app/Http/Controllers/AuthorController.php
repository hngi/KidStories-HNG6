<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Story;
use App\Category;

class AuthorController extends Controller
{
    public function getStories(Request $request, $author)
    {
        $stories = Story::where('author', $author)->get();
        $categories = Category::limit(4)->get();

       // return $stories;

        return view('authorstorieslisting', compact('stories', 'categories'));
    }
}
