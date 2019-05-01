<?php

namespace App\Http\Controllers\SuperAdmin;

use DB;
use App\Story;
use Illuminate\Http\Request;
use App\Services\FileUploadService;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

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

        return view('admin.stories.index', compact('stories'));
    }

    /**
     * VDisplay form to create resource
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.stories.create');
    }

    /**
     * Create a resource
     *
     * @param \App\Http\Requests\Request  $request
     * @return Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'author' => 'required|string|max:255',
            'story_duration' => 'required|string|max:255',                
            'is_premium' => 'required|string|max:255',            
            'age' => 'required|string|max:255',
            'category_id' => 'required|string|max:255',            
            'photo'=>'nullable|mimes:jpeg,jpg,png|max:800', //Max 800KB
            'created_at' => 'required',            
            'user_id' => 'required',
            
           
            
        ]);

        $exists = Story::where('title', 'LIKE', "%{$request->title}")->first();

        if ($exists) {
            return redirect()->back()->withError(__("Story '{$request->title}' already exists."));
        }
// 
        DB::beginTransaction();

        // Upload image if included in the request
        if($request->hasFile('photo')) {
            $image = $this->fileUploadService->uploadFile($request->file('photo'));
        }
// 
        Story::create([
             'title'=> $request-> title,
            'body' => $request-> body,            
            'age' => $request-> age,
            'author' => $request-> author,      
            'story_duration' => $request-> story_duration,            
            'is_premium' => $request-> is_premium,
            'category_id' => $request-> category_id,             
            "image_url" => $image['secure_url']?? null,
            "image_name" => $image['public_id'] ?? null,
            'created_at' =>  $request-> created_at,            
            'user_id' =>  $request-> user_id
   
        ]);

        DB::commit();

        return redirect()->back()->withStatus(__('Story successfully created.'));
    }

    /**
     * View a single resource'user_id' => auth()->id(),
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $story = Story::find($id);
        
        return view('admin.stories.edit', compact('story'));
    }

    /**
     * Update resource
     *
     * @param \App\Http\Requests\Request  $request
     * @param  int  $id
     * @return Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'author' => 'required|string|max:255',
            'story_duration' => 'required|string|max:255',                
            'is_premium' => 'required|string|max:255',            
            'age' => 'required|string|max:255',
            'category_id' => 'required|string|max:255',            
            'photo'=>'nullable|mimes:jpeg,jpg,png|max:800', //Max 800KB            
            'updated_at' => 'required',
            'user_id' => 'required',            
            
        ]);

        $stories = Story::findOrFail($id);

        $exists = Story::where('title', 'LIKE', "%{$request->title}")
                            ->where('id', '!=', $stories->id)
                            ->first();

        if ($exists) {
            return redirect()->back()->withError(__("Stories '{$request->title}' already exists."));
        }

        DB::beginTransaction();

        // Upload image if included in the request
        if($request->hasFile('photo')) {
            $image = $this->fileUploadService->uploadFile($request->file('photo'));

            if(!is_null($stories->image_name)) {
                $this->fileUploadService->deleteFile($stories->image_name);
            }
        }

        $stories->update([
            'title'=> $request-> title,
            'body' => $request-> body,            
            'age' => $request-> age,
            'author' => $request-> author,      
            'story_duration' => $request-> story_duration,            
            'is_premium' => $request-> is_premium,
            'category_id' => $request-> category_id,             
            "image_url" => $image['secure_url']?? null,
            "image_name" => $image['public_id'] ?? null,           
            'updated_at' =>  $request-> updated_at,
            'user_id' =>  $request-> user_id   
        ]);

        DB::commit();

        return redirect()->route('stories.index')->withStatus(__('Stories successfully updated.'));
    }

    /**
     * Delete resource
     *
     * @param \App\Http\Requests\Request  $request
     * @param  int  $id
     * @return Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $stories = Story::find($id);

        $stories->delete();

        if(!is_null($stories->image_name)) {
            $this->fileUploadService->deleteFile($stories->image_name);
        }

        return redirect()->back()->withStatus(__('Stories successfully deleted.'));
    }
}
