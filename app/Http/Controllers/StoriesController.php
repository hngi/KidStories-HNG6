<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Story;
use Validator;
use App\Category;
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
        return view('story', ['stories' => $stories]);
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
            'age_from' => $age[0] ,
            'age_to' => $age[1] ,
            // 'is_premium' => $request->is_premium,
            'is_premium' => false,
            'author' => $request->author,
            "image_url" => $image['secure_url'] ?? null,
            "image_name" => $image['public_id'] ?? null
        ]);

        DB::commit();
        // /show-story/{story}
        return response()->json([
            'status' => 'success',
            'code' => 200,
            'message' => 'OK',
            'data' => new StoryResource($story),
        ], 200);
    }

    public function show(Story $story)
    {   
        $story->load('tags');
        
        return view('singlestory');
    }
}