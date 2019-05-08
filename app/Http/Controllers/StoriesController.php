<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use App\Tag;
use App\Story;
use Validator;
use App\Bookmark;
use App\Category;
use App\Reaction;
use Carbon\Carbon;
use App\Subscribed;
Use Notification;
use App\Notifications\UserCreatedStory;
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
        } else if (!is_null($request->query('minAge')) && !is_null($request->query('maxAge'))) {
            $minAge = $request->query('minAge');
            $maxAge = $request->query('maxAge');
            
            $stories = $stories->where('age_from', '>=', $minAge)
                            ->where('age_to', '<=', $maxAge)
                            ->orderBy("age_from")->paginate(21);
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
            $reaction_count =  $this->reaction($storyId);
            $stories[$i]['likes_count'] = $reaction_count[0];
            $stories[$i]['dislikes_count'] = $reaction_count[1];
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

            $reaction_count =  $this->reaction($storyId);
            $stories[$i]['likes_count'] = $reaction_count[0];
            $stories[$i]['dislikes_count'] = $reaction_count[1];

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

        $reaction_count =  $this->reaction($id);
        $story['likes_count'] = $reaction_count[0];
        $story['dislikes_count'] = $reaction_count[1];

        return view('story', ['story' => $story]);
    }

    public function create()
    {
        $categories = Category::all();

        return view(
            'create-story', 
            compact('categories','tags')
        );
    }

    public function store(Request $request,Tag $tag)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'body' => 'required',
            'category_id' => 'required|numeric',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
            'age' => 'required',
            'author' => 'required'
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

            $story->tags()->attach($tag->getTagsIds($request->tags));
        DB::commit();

        //notify the admin that user has createdd a story and is awaiting approval
        $admin=\App\Admin::first();
        Notification::send($admin,new UserCreatedStory($story,$admin));


        return redirect()->route('story.show', ['story' => $story->slug]);
    }

    public function show(Request $request, Story $story)
    {
        $story->load('tags');

        $similarStories = $story->similar()->get();

        $user = $request->user();
        $mytime = Carbon::now();
        $timeNow = $mytime->toDateTimeString();
        
        $storyId = $story->id;
        if ($user) {
            $reaction = Reaction::where('story_id', $storyId)
                ->where('user_id', $user->id)
                ->first();
            $bookmark = Bookmark::where('user_id', $user->id)
                ->where('story_id', $storyId)
                ->first();    
            if ($reaction && $reaction->reaction == 0) {
                $story['reaction'] = 'dislike';
            } elseif ($reaction && $reaction->reaction == 1) {
                $story['reaction'] = 'like';
            } else {
                $story['reaction'] = 'nil';
            }
            if ($bookmark) {
                $story['favorite'] = true;
            } else {
                $story['favorite'] = false;
            }
        } else {
            $story['reaction'] = 'nil';
            $story['favorite'] = false;
        }

        if ($user && $story && $story->is_premium == 1) {
            $subcribed = Subscribed::where('user_id', $user->id)->get();

            for ($i = 0; $i < $subcribed->count(); $i++) {
                $expire = strtotime($subcribed[$i]->expired_date);
                $timeNow = strtotime($timeNow);
                if ($timeNow <= $expire) {
                    return view('singlestory', compact('story', 'similarStories'));
                }
            }
            return \redirect('subscribe');
        } elseif (!$user && $story && $story->is_premium == 1) {
            return \redirect('home');
        }

        $reaction_count =  $this->reaction($storyId);
        $story['likes_count'] = $reaction_count[0];
        $story['dislikes_count'] = $reaction_count[1];

        return view('singlestory', compact('story', 'similarStories'));
    }

    public function trendingstories(Request $request)
    {
        $reactions = Reaction::where('reaction', 1)->orderBy('story_id', 'asc')->get();
        $storyCountArray = [];
        
        for ($i=0; $i < $reactions->count(); $i++) { 
           $storyCountArray[$i] = $reactions[$i]->story_id;
        }

        $occurences = array_count_values($storyCountArray);
        asort($occurences);
        $storyIdArray = array_keys($occurences);
        
        $num = count($storyIdArray);
        $stories = [];
        $j = 0;
        
        for ($i=$num-1; $i >= $num - 9 ; $i--) { 
            $stories[$j] = Story::where('id', $storyIdArray[$i])->first();

            $like_reaction = Reaction::where('story_id', $stories[$j]->id)
                                    ->where('reaction', 1)->get();
            
            $stories[$j]['likes_count'] = count($like_reaction);
            
            $dislike_reaction = Reaction::where('story_id', $stories[$j]->id)
                                        ->where('reaction', 0)->get();
            
            $stories[$j]['dislikes_count'] = count($dislike_reaction);
            
            $j++;
        }

        // Sorting feature
        if ($request->query('sort') == 'latest') {
            $stories = collect($stories)->sortBy('created_at');
        } else if ($request->query('sort') == 'age') {
            $stories = collect($stories)->sortBy('age_from');
        }

        $user = $request->user();

        for ($i=0; $i < count($stories); $i++) {
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

            $reaction_count =  $this->reaction($storyId);
            $stories[$i]['likes_count'] = $reaction_count[0];
            $stories[$i]['dislikes_count'] = $reaction_count[1];

        }

        $categories = Category::limit(4)->get();

        return view('trendingstories', compact('stories', 'categories'));
    }

    public function reaction($id)
    {
        $like_reaction = Reaction::where('story_id', $id)
                        ->where('reaction', 1)->get();
        $likeCount = count($like_reaction);
        $dislike_reaction = Reaction::where('story_id', $id)
                    ->where('reaction', 0)->get();
        $dislikeCount = count($dislike_reaction);

        return [$likeCount, $dislikeCount];
    }
}
