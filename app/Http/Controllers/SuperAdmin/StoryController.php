<?php

namespace App\Http\Controllers\SuperAdmin;

use DB;
use App\Story;
use Illuminate\Http\Request;
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
        $stories = Story::latest()->paginate(10);

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
            'name' => 'required|string|max:255',
            'photo'=>'nullable|mimes:jpeg,jpg,png|max:800', //Max 800KB
        ]);

        $exists = Stories::where('name', 'LIKE', "%{$request->name}")->first();

        if ($exists) {
            return redirect()->back()->withError(__("Stories '{$request->name}' already exists."));
        }

        DB::beginTransaction();

        // Upload image if included in the request
        if($request->hasFile('photo')) {
            $image = $this->fileUploadService->uploadFile($request->file('photo'));
        }

        Stories::create([
            'title'=> $request-> title,
            'body' => $request-> body,
            'category_id' => $request-> category,
            'age' => $request-> age,
            'author' => $request-> author,      
            'story_duration' => $request-> duration,
            'user_id' => $request-> user,
            'is_premium' => $request-> premium,
            'name' => $request->name,
            "image_url" => $image['secure_url'] ?? null,
            "image_name" => $image['public_id'] ?? null,
            "created_at"=> $request-> created_at
        ]);

        DB::commit();

        return redirect()->back()->withStatus(__('Stories successfully created.'));
    }

    /**
     * View a single resource
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $stories = Stories::find($id);
        
        return view('admin.stories.edit', compact('stories'));
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
            'name' => 'required|string|max:255',
            'photo'=>'nullable|mimes:jpeg,jpg,png|max:800', //Max 800KB
        ]);

        $stories = Stories::findOrFail($id);

        $exists = Stories::where('name', 'LIKE', "%{$request->name}")
                            ->where('id', '!=', $stories->id)
                            ->first();

        if ($exists) {
            return redirect()->back()->withError(__("Stories '{$request->name}' already exists."));
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
            'name' => $request->name,
            "image_url" => $image['secure_url'] ?? $stories->image_url,
            "image_name" => $image['public_id'] ?? $stories->image_name
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
        $stories = Stories::find($id);

        $stories->delete();

        if(!is_null($stories->image_name)) {
            $this->fileUploadService->deleteFile($stories->image_name);
        }

        return redirect()->back()->withStatus(__('Stories successfully deleted.'));
    }
}
