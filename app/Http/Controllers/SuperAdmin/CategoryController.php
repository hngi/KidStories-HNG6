<?php

namespace App\Http\Controllers\SuperAdmin;

use DB;
use App\Category;
use Illuminate\Http\Request;
use App\Services\FileUploadService;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
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
        $categories = Category::latest()->paginate(25);

        return view('admin.categories.index', compact('categories'));
    }

    /**
     * VDisplay form to create resource
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.categories.create');
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

        $exists = Category::where('name', 'LIKE', "%{$request->name}")->first();

        if ($exists) {
            return redirect()->back()->withError(__("Category '{$request->name}' already exists."));
        }

        DB::beginTransaction();

        // Upload image if included in the request
        if($request->hasFile('photo')) {
            $image = $this->fileUploadService->uploadFile($request->file('photo'));
        }

        Category::create([
            'name' => $request->name,
            "image_url" => $image['secure_url'] ?? null,
            "image_name" => $image['public_id'] ?? null
        ]);

        DB::commit();

        return redirect()->back()->withStatus(__('Category successfully created.'));
    }

    /**
     * View a single resource
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $category = Category::find($id);
        
        return view('admin.categories.edit', compact('category'));
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

        $category = Category::findOrFail($id);

        $exists = Category::where('name', 'LIKE', "%{$request->name}")
                            ->where('id', '!=', $category->id)
                            ->first();

        if ($exists) {
            return redirect()->back()->withError(__("Category '{$request->name}' already exists."));
        }

        DB::beginTransaction();

        // Upload image if included in the request
        if($request->hasFile('photo')) {
            $image = $this->fileUploadService->uploadFile($request->file('photo'));

            if(!is_null($category->image_name)) {
                $this->fileUploadService->deleteFile($category->image_name);
            }
        }

        $category->update([
            'name' => $request->name,
            "image_url" => $image['secure_url'] ?? $category->image_url,
            "image_name" => $image['public_id'] ?? $category->image_name
        ]);

        DB::commit();

        return redirect()->route('admin.categories.index')->withStatus(__('Category successfully updated.'));
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
        $category = Category::find($id);

        $category->delete();

        if(!is_null($category->image_name)) {
            $this->fileUploadService->deleteFile($category->image_name);
        }

        return redirect()->back()->withStatus(__('Category successfully deleted.'));
    }
}
