<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Story;
use Auth;
use App\Subscribed;
use App\Bookmark;
use Carbon\Carbon;
use Validator;
use App\Category;
use App\Reaction;
use DB;
use App\Services\FileUploadService;
use App\Http\Resources\StoryResource;
use Symfony\Component\HttpFoundation\Response;


class StoriesController extends Controller
{
    public function __construct(FileUploadService $fileUploadService)
    {
        $this->fileUploadService = $fileUploadService;
    }

    public function index()
    {
        $stories = Story::with('user')
            ->where('is_premium', false)
            ->orderBy('created_at', 'desc')
            ->get();
        return view('stories', ['stories' => $stories]);
    }
    public function browsestories(Request $request)
    {
        $stories = Story::paginate(12);

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
       

        return view('stories', ['stories' => $stories, 'message' => "Oops! There are no stores"]);
    }

    public function mystories()
    {
        $stories = Story::where('user_id', auth()->id())->paginate(12);
        if (gettype($stories) != 'array') {
            $stories = [];
        }
        return view('stories', ['stories' => $stories, 'message' => "You have not created any story"]);
    }
    public function singlestory(Request $request, $id)
    {
        $story = Story::where('id', $id)
            ->first();
        $user = $request->user('api');
        $mytime = Carbon::now();
        $timeNow = $mytime->toDateTimeString();

        if ($user && $story && $story->is_premium == 1) {
            $subcribed = Subscribed::where('user_id', $user->id)->get();

            for ($i = 0; $i < $subcribed->count(); $i++) {
                $expire = strtotime($subcribed[$i]->expired_date);
                $timeNow = strtotime($timeNow);
                if ($timeNow <= $expire) {
                    return view('singlestory', ['story' => $story]);
                }
            }
            return \redirect('home');
        } elseif (!$user && $story && $story->is_premium == 1) {
            return \redirect('home');
        }


        // return [$subcribed, $story, $user];
        // if (!$user) {
        //
        // }
        // if ($user["is_premium"] == 0 && $story["is_premium"] == 1) {
        //     return \redirect('home');
        // }

        return view('story', ['story' => $story]);
    }

    public function create()
    {
        $categories = Category::all();
        return view('create-story', compact('categories'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'body' => 'required',
            'category_id' => 'required|numeric',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
            'age' => 'required',
            'author' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => [
                    'code' => 422,
                    'message' => "Unprocessable Entity",
                    'errors' => $validator->errors()
                ]
            ], 422);
        }

        $category = Category::find($request->category_id);

        if (!$category) {
            return response()->json([
                'error' => 'Resource not found',
                'message' => 'Not found',
                'code' => 404
            ], 404);
        }

        DB::beginTransaction();

        if ($request->hasfile('photo')) {
            $image = $this->fileUploadService->uploadFile($request->file('photo'));
        }

        $age = explode('-', $request->age);

        $story = Story::create([
            'title' => $request->title,
            'body' => $request->body,
            'category_id' => $request->category_id,
            'user_id' => auth()->id(),
            'age_from' => $age[0],
            'age_to' => $age[1],
            // 'is_premium' => $request->is_premium,
            'is_premium' => false,
            'author' => $request->author,
            "image_url" => $image['secure_url'] ?? null,
            "image_name" => $image['public_id'] ?? null
        ]);

        DB::commit();
        return redirect()->route('singlestory', ['id' => $story->id]);
        // // /show-story/{story}
        // return response()->json([
        //     'status' => 'success',
        //     'code' => 200,
        //     'message' => 'OK',
        //     'data' => new StoryResource($story),
        // ], 200);
    }

    // public function show(Story $story)
    // {
    //     $story->load('tags');

    //     return view('singlestory');

    //     return redirect('/story/'.$story->id);
    //     // return response()->json([
    //     //     'status' => 'success',
    //     //     'code' => 200,
    //     //     'message' => 'OK',
    //     //     'data' => $story,
    //     // ], 200);
    // }

    public function show(Request $request, Story $story)
    {
        $story->load('tags');

        $user = $request->user();
        $mytime = Carbon::now();
        $timeNow = $mytime->toDateTimeString();
        $storyId = $story->id;

        if ($user) {
            $reaction = Reaction::where('story_id', $storyId)
                ->where('user_id', $user->id)
                ->first();
            if ($reaction && $reaction->reaction == 0) {
                $story['reaction'] = 'dislike';
            } elseif ($reaction && $reaction->reaction == 1) {
                $story['reaction'] = 'like';
            } else {
                $story['reaction'] = 'nil';
            }
        } else {
            $story['reaction'] = 'nil';
        }

        if ($user && $story && $story->is_premium == 1) {
            $subcribed = Subscribed::where('user_id', $user->id)->get();

            for ($i = 0; $i < $subcribed->count(); $i++) {
                $expire = strtotime($subcribed[$i]->expired_date);
                $timeNow = strtotime($timeNow);
                if ($timeNow <= $expire) {
                    $similarStories = $story->similar()->get();

                    return view('singlestory', compact('story', 'similarStories'));
                }
            }
            return \redirect('home');
        } elseif (!$user && $story && $story->is_premium == 1) {
            return \redirect('home');
        }

        $similarStories = $story->similar()->get();

        return view('singlestory', compact('story', 'similarStories'));
    }

    public function search(Request $request)
    {
        $search = $request->get('search');
        $stories = Story::where('title', 'LIKE', "%$search%")->orWhere('author', 'LIKE', "%$search%")->paginate(3);

        $user = $request->user();


        for ($i = 0; $i < $stories->count(); $i++) {
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
            } else {
                $test = 1;
                $stories[$i]['reaction'] = 'nil';
            }
        }
        return view('searchlisting', ['stories' => $stories, 'search' => $search]);
    }
}
