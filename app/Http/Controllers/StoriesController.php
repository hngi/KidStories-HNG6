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
use Illuminate\Http\Request;
use App\Http\Requests\StoryRequest;
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

            $stories = Story::where('is_approved', 1)->where('title', 'LIKE', "$search%");
        } else {
            $stories = Story::query()->where('is_approved', 1);
        }
        if (!is_null($request->query('minAge')) && !is_null($request->query('maxAge'))) {
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
        $stories = Story::withoutGlobalScopes();

        if ($request->query('search')) {
            $search = $request->query('search');

            $stories = $stories->where('user_id', auth()->id())
                            ->where('title', 'LIKE', "%$search%");
        } else {
            $stories = $stories->where('user_id', auth()->id());
        }

        // Sorting feature
        if (!is_null($request->query('minAge')) && !is_null($request->query('maxAge'))) {
            $minAge = $request->query('minAge');
            $maxAge = $request->query('maxAge');
            
            $stories = $stories->where('age_from', '>=', $minAge)
                            ->where('age_to', '<=', $maxAge)
                            ->orderBy("age_from");
        }

        if (!is_null($request->query('category'))) {
            $stories = $stories->where('category_id', $request->query('category'));
        }
        
        $stories = $stories->paginate(21);
        
        // Sorting feature ends

        $categories = Category::all();
        
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
        //dd($stories->toArray());
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
        $tags = Tag::all();
        return view(
            'create-story', 
            compact('categories','tags')
        );
    }

    public function store(StoryRequest $request,Tag $tag)
    {   
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

        DB::commit(); //dd('Inside the store before redirect');
        return redirect()->route('story.show', ['story' => $story->slug]);
    }

    public function show(Request $request, $story)
    {   
        $story = Story::withoutGlobalScopes()
            ->where('slug',$story)->firstOrFail();

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
        $stories = Story::trending()->take(9)->get();

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
