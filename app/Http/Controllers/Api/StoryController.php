<?php
namespace App\Http\Controllers\Api;

use Auth;
use DB;
use App\User;
use App\Story;
use App\Comment;
use Validator;
use App\Category;
use App\Bookmark;
use App\Reaction;
use Illuminate\Http\Request;
use App\Traits\Api\UserTrait;
use App\Services\FileUploadService;
use App\Http\Controllers\Controller;
use App\Http\Resources\StoryResource;
use App\Http\Resources\SingleStoryResource;
use Symfony\Component\HttpFoundation\Response;

class StoryController extends Controller
{
    use UserTrait;
    public function __construct(FileUploadService $fileUploadService)
    {
        $this->fileUploadService = $fileUploadService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $stories = Story::query();
        $stories = $stories->when($request->has('age'), function ($q) use ($request) {
            $age = explode('-', $request->age);
            return $q->where(function ($q) use ($age){
                foreach ($age as $data) {
                    $q->orWhereRaw('? between age_from and age_to ', [$data]);
                }
            });
        });

        $stories = $stories->get();
        return response()->json([
            'status' => 'success',
            'code' => 200,
            'message' => 'OK',
            'data' => StoryResource::collection($stories)
        ], 200);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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
            'age_from' => $age[0] ,
            'age_to' => $age[1] ,
            'author' => $request->author,
            "image_url" => $image['secure_url'] ?? null,
            "image_name" => $image['public_id'] ?? null
        ]);
        DB::commit();
        return response()->json([
            'status' => 'success',
            'code' => 200,
            'message' => 'OK',
            'data' => new StoryResource($story),
        ], 200);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $story = Story::where('id', $id)
                        ->with(['comments.user:id,first_name,last_name,image_url'])
                        ->firstOrFail();
        $user = $request->user('api');
        if ($user) {
            $reaction = Reaction::where('user_id', $user->id)
                ->where('story_id', $id)
                ->first();
            $bookmark = Bookmark::where('user_id', $user->id)
                ->where('story_id', $id)
                ->first();
            if ($reaction && $reaction->reaction == 0) {
                $action = "disliked";
            } else if ($reaction && $reaction->reaction == 1) {
                $action = "liked";
            } else {
                $action = 'none';
            }
            if ($bookmark) {
                $favorite = true;
            } else {
                $favorite = false;
            }
        }else {
            $action = 'none';
            $favorite = false;
        }

        if ($story->is_premium) {
            if ($user) {
                if ($this->userIsPremuim()) {
                    return response()->json([
                        'status' => 'success',
                        "code" => Response::HTTP_OK,
                        'message' => 'premium story',
                        'data' => new SingleStoryResource($story),
                        'reaction' => $action,
                        'bookmark' => $favorite
                    ], Response::HTTP_OK);
                }else {
                    return response()->json([
                        'error' => 'Forbidden',
                        'code' => Response::HTTP_FORBIDDEN,
                        'message' => 'This is a Premium story'
                    ], Response::HTTP_FORBIDDEN);
                }
            }
            return response()->json([
                'error' => 'Unauthorized',
                'code' => Response::HTTP_UNAUTHORIZED,
                'message' => 'You are not authorized'
            ], Response::HTTP_UNAUTHORIZED);
        }
        return response()->json([
            'status' => 'success',
            "code" => Response::HTTP_OK,
            "message" => "OK",
            'data' => new SingleStoryResource($story),
            'reaction' => $action,
            'bookmark' => $favorite
        ], 200);
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $if
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
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
                'error' => 'Category not found',
                'message' => 'Not found',
                'code' => 404
            ], 404);
        }
        $story = Story::where('id', $id)->where('user_id', auth()->id())->first();
        if (!$story) {
            return response()->json([
                'error' => 'Story not found',
                'message' => 'Not found',
                'code' => 404
            ], 404);
        }
        DB::beginTransaction();
        if ($request->hasfile('photo')) {
            $image = $this->fileUploadService->uploadFile($request->file('photo'));
            if(!is_null($story->image_name)) {
                $this->fileUploadService->deleteFile($story->image_name);
            }
        }
        $story->update([
            'title' => $request->title,
            'body' => $request->body,
            'category_id' => $request->category_id,
            'user_id' => auth()->id(),
            'age' => $request->age,
            'author' => $request->author,
            "image_url" => $image['secure_url'] ?? $story->image_url,
            "image_name" => $image['public_id'] ?? $story->image_name
        ]);
        DB::commit();
        return response()->json([
            'status' => 'success',
            'code' => 200,
            'message' => 'OK'
        ], 200);
    }
    /**
     * User can like a story or remove like.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function like(Request $request, $id)
    {
        $user = $request->user('api');
        if(!$user){
            return response()->json([
                'status' => 'failed',
                'code' => 400,
                'message' => 'Kindly log in'
            ]);
        }
        $story = $this->findStory($id);
        $like_reaction = Reaction::where('story_id', $id)
                        ->where('reaction', 1)->get();
        $likeCount = count($like_reaction);
        $dislike_reaction = Reaction::where('story_id', $id)
                    ->where('reaction', 0)->get();
        $dislikeCount = count($dislike_reaction);
        if (!$user) {
            return null;
        }
        $reaction = Reaction::where('story_id', $story->id)
                            ->where('user_id', $user->id)
                            ->first();
        DB::beginTransaction();
        if ($reaction && $reaction->reaction == 1) {
            $reaction->delete();
            $like_reaction = Reaction::where('story_id', $id)
                        ->where('reaction', 1)->get();
            $likeCount = count($like_reaction);
            $dislike_reaction = Reaction::where('story_id', $id)
                        ->where('reaction', 0)->get();
            $dislikeCount = count($dislike_reaction);
            $action = 'Removed like';
            $data = null;
        } else if ($reaction && $reaction->reaction == 0) {
            $reaction = Reaction::updateOrCreate(
                ['story_id' => $id, 'user_id' => $user->id],
                ['reaction' => 1]
            );
            
            $like_reaction = Reaction::where('story_id', $id)
                        ->where('reaction', 1)->get();
            $likeCount = count($like_reaction);
            $dislike_reaction = Reaction::where('story_id', $id)
                        ->where('reaction', 0)->get();
            $dislikeCount = count($dislike_reaction);
            $action = 'Changed to like';
            $data = 1;
        } else {
            $reaction = Reaction::updateOrCreate(
                ['story_id' => $id, 'user_id' => $user->id],
                ['reaction' => 1]
            );
            
            $like_reaction = Reaction::where('story_id', $id)
                        ->where('reaction', 1)->get();
            $likeCount = count($like_reaction);
            $dislike_reaction = Reaction::where('story_id', $id)
                        ->where('reaction', 0)->get();
            $dislikeCount = count($dislike_reaction);
            $action = 'Added like';
            $data = 1;
        }
        DB::commit();
        return response()->json([
            'status' => 'success',
            'code' => 200,
            'message' => 'OK',
            'likes_count'=> $likeCount,
            'dislikes_count' => $dislikeCount,
            'action' => $action,
            'data' => $data
        ], 200);
    }
    /**
     * User can dislike a story or remove dislike.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function dislike(Request $request, $id)
    {
        $user = $request->user('api');
        if(!$user){
            return response()->json([
                'status' => 'failed',
                'code' => 400,
                'message' => 'Kindly log in'
            ]);
        }
        $story = $this->findStory($id);

        $like_reaction = Reaction::where('story_id', $id)
                        ->where('reaction', 1)->get();
        $likeCount = count($like_reaction);
        $dislike_reaction = Reaction::where('story_id', $id)
                    ->where('reaction', 0)->get();
        $dislikeCount = count($dislike_reaction);

        if (!$user) {
            return null;
        }
        $reaction = Reaction::where('story_id', $story->id)
                            ->where('user_id', $user->id)
                            ->first();
        DB::beginTransaction();
        if ($reaction && $reaction->reaction == 0) {
            $reaction->delete();
            $like_reaction = Reaction::where('story_id', $id)
                        ->where('reaction', 1)->get();
            $likeCount = count($like_reaction);
            $dislike_reaction = Reaction::where('story_id', $id)
                        ->where('reaction', 0)->get();
            $dislikeCount = count($dislike_reaction);
            $action = 'Removed dislike';
            $data = null;
        } else if ($reaction && $reaction->reaction == 1) {
            $reaction = Reaction::updateOrCreate(
                ['story_id' => $id, 'user_id' => $user->id],
                ['reaction' => 0]
            );

            $like_reaction = Reaction::where('story_id', $id)
                        ->where('reaction', 1)->get();
            $likeCount = count($like_reaction);
            $dislike_reaction = Reaction::where('story_id', $id)
                        ->where('reaction', 0)->get();
            $dislikeCount = count($dislike_reaction);
            $action = 'Changed to dislike';
            $data = 0;
        } else {
            $story->increment('dislikes_count', 1);
            $like_reaction = Reaction::where('story_id', $id)
                        ->where('reaction', 1)->get();
            $likeCount = count($like_reaction);
            $dislike_reaction = Reaction::where('story_id', $id)
                        ->where('reaction', 0)->get();
            $dislikeCount = count($dislike_reaction);
            $reaction = Reaction::updateOrCreate(
                ['story_id' => $id, 'user_id' => $user->id],
                ['reaction' => 0]
            );
            $action = 'Added dislike';
            $data = 0;
        }
        DB::commit();
        return response()->json([
            'status' => 'success',
            'code' => 200,
            'message' => 'OK',
            'likes_count' => $likeCount,
            'dislikes_count' => $dislikeCount,
            'action' => $action,
            'data' => $data
        ], 200);
    }
    public function findStory($storyId)
    {
        $story = Story::find($storyId);
        if (!$story) {
            return response()->json([
                'status' => 'Not found',
                'code' => 404,
                'message' => "Story does not exist",
                'data' => null
            ], 404);
        } else {
            return $story;
        }
    }
    public function user()
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json([
                'status' => 'failed',
                'code' => 401,
                'message' => 'User unauthenticated',
                'data' => null
            ], 401);
        } else {
            return $user;
        }
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
    /**
     * Like a story
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /*public function likezzzzzz($id)
    {
        $reaction = Reaction::where('story_id', $id)
                            ->where('user_id', auth()->id())
                            ->first();
        if ($reaction && $reaction->reaction == 1) {
            $reaction->delete();
        } else {
            $reaction = Reaction::updateOrCreate([
                'story_id' => $id,
                'user_id' => auth()->id()
            ], [
                'reaction' => 1
            ]);
        }
        return response()->json([
            'status' => 'success',
            'code' => 200,
            'message' => 'OK'
        ], 200);
    }*/
   /**
     * Dislike a story
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /*public function dislikezzzzzzz$id)
    {
        $reaction = Reaction::where('story_id', $id)
                            ->where('user_id', auth()->id())
                            ->first();
        if ($reaction && $reaction->reaction == 0) {
            $reaction->delete();
        } else {
            $reaction = Reaction::updateOrCreate([
                'story_id' => $id,
                'user_id' => auth()->id()
            ], [
                'reaction' => 0
            ]);
        }
        return response()->json([
            'status' => 'success',
            'code' => 200,
            'message' => 'OK'
        ], 200);
    }*/
}
