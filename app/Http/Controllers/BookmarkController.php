<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
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
        
        return view('bookmark', ['bookmarks' => $data]);
    }

    public function user()
    {
        $user = Auth::user();
        if (!$user) {
            return \redirect('home');
        }
    }
}
