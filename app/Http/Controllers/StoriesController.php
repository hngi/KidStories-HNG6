<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Story;
use Auth;
use App\Subscribed;
use Carbon\Carbon;

class StoriesController extends Controller
{
    public function index()
    {
        $stories = Story::with('user')
            ->where('is_premium', false)
            ->orderBy('created_at', 'desc')
            ->get();
        return view('stories', ['stories' => $stories]);
    }

    public function singlestory($id)
    {
        $story = Story::where('id', $id)
            ->first();
        $user = Auth::user();
        $mytime = Carbon::now();
        $timeNow = $mytime->toDateTimeString();
        $subcribed = '';
        if ($user) {
            $subcribed = Subscribed::where('user_id', $user->id);
        }

        return [$subcribed, $story, $user];
        // if (!$user) {
        //     return \redirect('home');
        // }
        // if ($user["is_premium"] == 0 && $story["is_premium"] == 1) {
        //     return \redirect('home');
        // }

        // return view('story', ['story' => $story]);
    }
}
