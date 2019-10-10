<?php

namespace App\Http\Controllers;

use DB;
use App\User;
use Illuminate\Http\Request;
use App\Services\FileUploadService;
use App\Subscribed;
use Carbon\Carbon;
use JD\Cloudder\Facades\Cloudder;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(FileUploadService $fileUploadService)
    {
        $this->fileUploadService = $fileUploadService;
    }

    /**
     * Get logged in user's profile
     *
     * @return \Illuminate\Http\Response
     */
    public function showProfile()
    {
        $data['user'] = User::findOrFail(auth()->id());
        $package = Subscribed::where('user_id',auth()->user()->id)->first();
            if($package){
            $data['left'] = Carbon::parse($package->expired_date)->longAbsoluteDiffForHumans(Carbon::now());
        } else {
            $data['left'] = null;
        }


    	return view('profile')->with($data);
    }

    /**
     * Update logged in user's profile
     *
     * @return \Illuminate\Http\Response
     */
    public function updateProfile(Request $request)
    {
        $user = User::findOrFail(auth()->id());

        $this->validate($request, [
            'first_name' => 'required|min:2',
            'last_name' => 'required|min:2',
            'photo'=>'nullable|mimes:jpeg,jpg,png|between:1, 6000', //Max 800KB
            'email' => 'required|string|unique:users,email,'.$user->id,
            'phone'=>'nullable|min:8'
        ]);

        DB::beginTransaction();

        if($request->hasFile('photo')) {
            $image = $this->fileUploadService->uploadFile($request->file('photo'));

            if(!is_null($user->image_name)) {
                $this->fileUploadService->deleteFile($user->image_name);
            }
        }

        $user->update([
    		'first_name' => $request->first_name,
    		'last_name' => $request->last_name,
    		'email' => $request->email,
    		'phone' => $request->phone,
    		'location' => $request->location,
    		'postal_code' => $request->postal_code,
    		'image_url' => $image['secure_url'] ?? $user->image_url,
            'image_name' => $image['public_id'] ?? $user->image_name
    	]);
//        $user->save();

    	DB::commit();

    	return redirect()->back()->with(['success' => 'Profile updated!']);
    }
}
