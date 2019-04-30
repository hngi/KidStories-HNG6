<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Story;

class StoriesController extends Controller
{
    public function index()
    {
        $stories = Story::with('user')
            ->where('is_premium', false)
            ->orderBy('created_at', 'desc')
            ->get();
        return view('story', ['stories' => $stories]);
    }
}
