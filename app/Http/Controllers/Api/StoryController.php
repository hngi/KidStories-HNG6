<?php

namespace App\Http\Controllers\Api;

use App\Story;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Subscribed;
use Illuminate\Routing\Controller;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Resources\StoryResource;
use App\Services\FileUploadService;
use App\Reaction;

class StoryController extends Controller
{
    public function __construct(FileUploadService $fileUploadService)
    {
        $this->fileUploadService = $fileUploadService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // if($this->isUserSubscribe())
        // {
        //     $stories = Story::all();
        // }else
        // {
        //     $stories = Story::where('is_premium','=',false)->get();
        // }

        // return response([
        //     'status' => Response.HTTP_OK,
        //     'method' => 'GET',
        //     'message'=> 'success',
        //     'data' => StoryResource::collection($stories)
        // ],Response.HTTP_OK);
        $stories = Story::all();
        return response()->json([
            'status' => 'success',
            'code' => 200,
            'message' => 'OK',
            'data' => StoryResource::collection($stories)
        ], 200);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = request()->validate([
            'title' => 'required',
            'body' => 'required',
            'category_id' => 'required|numeric',
            'image_url' => 'image|mimes:jpeg,png,jpg,gif,svg',
            'age' => 'required',
            'author' => 'required',
            'story_duration' => 'required',
        ]);
        $data['user_id'] = Auth::user()->id();
        if($request->hasfile('story_image'))
        {
            $image = $this->fileUploadService->uploadFile($request->file('story_image'));
            $data['image_url'] = $image['secure_url'] ?? null;
            $data['image_name'] = $image['public_id'] ?? null;
        }
        $story = Story::create($data);
        return response()->json([
            'status' => 'success',
            'code' => 200,
            'message' => 'OK',
            'data' => StoryResource::collection($story)
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Story  $story
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $story = Story::find($id);
        if($story){
            return response()->json([
                'status' => 'success',
                'data' => $story
            ], 200);
        }
        else {
            return response()->json([
                'error' => ['code' => 404, 'message' => 'Story not found']
            ], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Story  $story
     * @return \Illuminate\Http\Response
     */
    public function edit(Story $story)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Story  $story
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $story = Story::find($id);
        $data = request()->validate([
            'title' => 'required',
            'body' => 'required',
            'category_id' => 'required|numeric',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg',
            'age' => 'required',
            'author' => 'required',
            'story_duration' => 'required',
        ]);
        $data['user_id'] = Auth::user()->id();
        if($request->hasfile('story_image'))
        {
            $image = $this->fileUploadService->uploadFile($request->file('story_image'));
            $data['image_url'] = $image['secure_url'] ?? null;
            $data['image_name'] = $image['public_id'] ?? null;
        }
        $story->update($data);
        return response()->json([
            'status' => 'success',
            'code' => 200,
            'message' => 'OK',
            'data' => StoryResource::collection($story)
        ], 200);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Story  $story
     * @return \Illuminate\Http\Response
     */
    public function destroy(Story $story)
    {
        //
    }

    public function isUserSubscribe(){
        $id = Auth::user()->id();
        $subscribed = Subscribed::where('user_id','=',$id)
                        ->where('expired_date','>=',Carbon::now()->toDateString())->latest()->first();
        if($subscribed !=null){
            return true;
        }
        return false;
    }
    
    public function like($id)
    {
        $user_id = Auth::user()->id();
        $reaction = Reaction::where('story_id','=',$id)->where('user_id','=',$user_id);
        if($reaction->count()){
            $reaction = $reaction->update([
                'reaction'  => 1,
            ]);
            return response()->json([
                'status' => 'success',
                'data' => 'Story Liked'
            ], 200);
        }else {
            Reaction::create([
                'story_id' => $id,
                'user_id' => 1,
                'reaction'  => 1,
            ]);
            return response()->json([
                'status' => 'success',
                'data' => 'Story Liked'
            ], 200);
        }
    }

    public function dislike($id)    
    {
        $user_id = Auth::user()->id();
        $reaction = Reaction::where('story_id','=',$id)->where('user_id','=',$user_id);
        if($reaction->count()){
            $reaction = $reaction->update([
                'reaction'  => 0,
            ]);
            return response()->json([
                'status' => 'success',
                'data' => 'Story Disiked'
            ], 200);
        }else {
            Reaction::create([
                'story_id' => $id,
                'user_id' => $user_id,
                'reaction'  => 0,
            ]);
            return response()->json([
                'status' => 'success',
                'data' => 'Story Disliked'
            ], 200);
        }
    }
}
