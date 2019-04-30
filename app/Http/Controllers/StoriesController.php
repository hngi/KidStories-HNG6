<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Story;

class StoriesController extends Controller
{
    public function index(Request $request)
    {
        $story = Story::with('user')
            ->orderBy('created_at', 'desc')
            ->get();
        return view('story', ['stories' => $story]);
    }
}
