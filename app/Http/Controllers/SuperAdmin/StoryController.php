<?php

namespace App\Http\Controllers\SuperAdmin;

use DB;
use App\Story;
use App\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Requests\StoryRequest;
use App\Services\FileUploadService;
use App\Http\Controllers\Controller;

class StoryController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(FileUploadService $fileUploadService)
    {
        $this->middleware('admin');

        $this->fileUploadService = $fileUploadService;
    }

    /**
     * Show all
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $stories = Story::latest()->paginate(25);

        return view(
            'admin.stories.index', 
            compact('stories')
        );
    }

    /**
     * VDisplay form to create resource
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {   
        $categories = Category::all();

        return view(
            'admin.stories.create',
            compact('categories')
        );
    }

    /**
     * Create a resource
     *
     * @param \App\Http\Requests\StoryRequest  $request
     * @return Illuminate\Http\Response
     */
    public function store(StoryRequest $request)
    {
        // Upload image if included in the request
        if($request->hasFile('photo')) {
            $image = $this->fileUploadService
                ->uploadFile($request->file('photo'));
        }
        
        $age = explode('-', $request->age);

        Story::create([
            'title'=> $request->title,
            'body' => $request->body,            
            'age_from' => $age[0],
            'age_to' => $age[1],
            'author' => $request->author ?? 'Unknown',      
            'is_premium' => $request->is_premium,
            'category_id' => $request->category_id,             
            "image_url" => $image['secure_url']?? null,
            "image_name" => $image['public_id'] ?? null,
            'user_id' =>  auth('admin')->id()
        ]);

        return redirect()->back()->withStatus(
            __('Story successfully created.')
        );
    }

    /**
     *
     * @param  \App\Story  $story
     * @return \Illuminate\View\View
     */
    public function edit(Story $story)
    {   
        $categories = Category::all();

        return view(
            'admin.stories.edit', 
            compact('story','categories')
        );
    }

    /**
     * Update resource
     *
     * @param \App\Http\Requests\StoryRequest  $request
     * @param  \App\Story  $story
     * @return Illuminate\Http\Response
     */
    public function update(StoryRequest $request,Story $story)
    {
        // Upload image if included in the request
        if($request->hasFile('photo')) {
            $image = $this->fileUploadService
                ->uploadFile($request->file('photo'));

            if(!is_null($story->image_name)) {
                $this->fileUploadService->deleteFile(
                    $story->image_name
                );
            }
        }

        $age = explode('-', $request->age);

        $story->update([
            'title'=> $request->title,
            'body' => $request->body,            
            'age_from' =>$age[0],
            'age_to' =>$age[1],
            'author' => $request->author,      
            'is_premium' => $request->is_premium,
            'category_id' => $request->category_id,             
            "image_url" => $image['secure_url']?? null,
            "image_name" => $image['public_id'] ?? null,           
            'user_id' =>  auth('admin')->id()  
        ]);

        return redirect()->route('admin.stories.index')
            ->withStatus(__('Stories successfully updated.'));
    }

    /**
     * Delete resource
     *
     * @param  \App\Story  $story
     * @return Illuminate\Http\Response
     */
    public function destroy(Story $story)
    {
        $story->delete();

        if(!is_null($story->image_name)) {
            $this->fileUploadService
                ->deleteFile($story->image_name);
        }

        return redirect()->back()->withStatus(
            __('Stories successfully deleted.')
        );
    }

    /**
     * Show resource
     *
     * @param  \App\Story  $story
     * @return Illuminate\Http\Response
     */
    public function show(Story $story)
    {
        return view(
            'admin.stories.show', 
            compact('story')
        );
    }
}
