<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use Validator;
use App\Story;
use App\Bookmark;
use App\Category;
use App\Reaction;
use Carbon\Carbon;
use App\Subscribed;
use Illuminate\Http\Request;
use App\Services\FileUploadService;
use App\Http\Resources\StoryResource;
use Symfony\Component\HttpFoundation\Response;


class StoriesController extends Controller
{
    public function __construct(FileUploadService $fileUploadService)
    {
        $this->fileUploadService = $fileUploadService;
    }

    /**
     * Show all stories
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->query('search')) {
            $search = $request->query('search');

            $stories = Story::where('title', 'LIKE', "%$search%")
                            ->orWhere('author', 'LIKE', "%$search%");
        } else {
            $stories = Story::query();
        }

        if ($request->query('sort') == 'latest') {
            $stories = $stories->latest()->paginate(21);
        } else if ($request->query('sort') == 'age') {
            $stories = $stories->orderBy("age_from")->paginate(21);
        } else {
            $stories = $stories->paginate(21);
        }

        $categories = Category::limit(4)->get();
        
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

        return view('stories', compact('stories', 'categories'));
    }

    /**
     * Show all stories belonging to a logged in user
     *
     * @return \Illuminate\Http\Response
     */
    public function mystories(Request $request)
    {
        if ($request->query('search')) {
            $search = $request->query('search');

            $stories = Story::where('user_id', auth()->id())->paginate(21)
                            ->where('title', 'LIKE', "%$search%")
                            ->orWhere('author', 'LIKE', "%$search%");
        } else {
            $stories = Story::where('user_id', auth()->id());
        }

        if ($request->query('sort') == 'latest') {
            $stories = $stories->latest()->paginate(21);
        } else if ($request->query('sort') == 'age') {
            $stories = $stories->orderBy("age_from")->paginate(21);
        } else {
            $stories = $stories->paginate(21);
        }

        $categories = Category::limit(4)->get();
        
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

        return view('mystories', compact('stories', 'categories'));
    }

    /**
     * Show single story
     *
     * @return \Illuminate\Http\Response
     */
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
        return redirect()->route('story.show', ['story' => $story->slug]);
    }

    public function show(Request $request, Story $story)
    {
        $story->load('tags');

        $similarStories = $story->similar()->get();

        return view('singlestory', compact('story', 'similarStories'));
    }
}
