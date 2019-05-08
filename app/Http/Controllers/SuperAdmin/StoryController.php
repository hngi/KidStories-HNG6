<?php

namespace App\Http\Controllers\SuperAdmin;

use DB;
use App\Tag;
use App\Story;
use App\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Requests\StoryRequest;
use App\Services\FileUploadService;
use App\Http\Controllers\Controller;
use Notification;
use App\Notifications\UserStoryApproved;

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
        $unApprovedStories=Story::where('is_approved',false)->count();
        return view(
            'admin.stories.index', 
            compact('stories','unApprovedStories')
        );
    }

    public function unApprovedStories()
    {
        $stories=Story::where('is_approved',false)->paginate(10);

        return view(
            "admin.stories.unapproved-stories",
            compact('stories')
        );
    }

    public function approve($id)
    {
        $story=Story::find($id);
      //  return $story;
        $story->update(['is_approved'=>true]);

    // send a notification to the user
        $user=$story->user;



        Notification::send($user,new UserStoryApproved($story,$user));

        return back()->with(['status'=>'story has been approved and removed from this list']);

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
    public function store(StoryRequest $request,Tag $tag)
    {   
        // Upload image if included in the request
        if($request->hasFile('photo')) {
            $image = $this->fileUploadService
                ->uploadFile($request->file('photo'));
        }
        
        $age = explode('-', $request->age);
        $rawStory = $request->except([
            'age','photo','author','tags'
        ]);
        $rawStory['author'] = $request->author ??'Unknow';
        $rawStory['image_url'] = $image['secure_url']?? null;
        $rawStory['image_name'] = $image['public_id']?? null;
        $rawStory['age_from']=$age[0];
        $rawStory['age_to']=$age[1];
        DB::transaction(function()use($request,$rawStory,$tag){
            $story = $request->user('admin')->stories()->create($rawStory);
            $story->tags()->attach($tag->getTagsIds($request->tags));
        });

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
        $story->load('tags');
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
    public function update(StoryRequest $request,Story $story,Tag $tag)
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
        $rawStory = $request->except([
            'age','photo','author','tags',
            '_token','_method','previousImage'
        ]);
        $rawStory['author'] = $request->author ??'Unknow';
        $rawStory['image_url'] = $image['secure_url']?? null;
        $rawStory['image_name'] = $image['public_id']?? null;
        $rawStory['age_from']=$age[0];
        $rawStory['age_to']=$age[1]; 
        DB::transaction(function()use($story,$request,$rawStory,$tag){
            $story->update($rawStory);
            $story->tags()->sync($tag->getTagsIds($request->tags));
        });

        return redirect()->route('admin.stories.index')
            ->withStatus(__('Story successfully updated.'));
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
        $story->load('tags');
        
        return view(
            'admin.stories.show', 
            compact('story')
        );
    }
}
