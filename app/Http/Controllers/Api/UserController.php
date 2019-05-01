<?php

namespace App\Http\Controllers\Api;

use DB;
use App\User;
use Validator;
use Illuminate\Http\Request;
use App\Services\FileUploadService;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Resources\StoryResource;

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
     * View all users
     *
     * @return \Illuminate\Http\Response
     */
	public function index()
	{
		$users = User::all();

    	return response()->json([
    		"status" => "success",
            "code" => 200,
    		"message" => "OK",
    		"data" => $users
    	], 200);
	}

    /**
     * Get logged in user's profile
     *
     * @return \Illuminate\Http\Response
     */
    public function showProfile()
    {
    	$user = User::findOrFail(auth()->id());

    	return response()->json([
            "status" => "success",
            "code" => 200,
            "message" => "OK",
            "data" => $user
    	], 200);
    }

    /**
     * Update logged in user's profile
     *
     * @return \Illuminate\Http\Response
     */
    public function updateProfile(Request $request)
    {
        $user = User::findOrFail(auth()->id());

        $validator = Validator::make($request->all(), [
            'first_name' => 'required|min:2',
            'last_name' => 'required|min:2',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'phone'=>'nullable|min:8'
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

        $data = $request->except(['password','photo', 'image_url', 'image_name']);

    	$user->update($data);

    	return response()->json([
            "status" => "success",
            "code" => 200,
            "message" => "OK",
            "data" => $user
        ], 200);
    }

    /**
     * Update logged in user's profile image
     *
     * @return \Illuminate\Http\Response
     */
    public function updateProfileImage(Request $request)
    {
        $this->validate($request, [
            'photo'=>'nullable|mimes:jpeg,jpg,png|max:800', //Max 800KB
        ]);

        $user = User::findOrFail(auth()->id());

        if($request->hasFile('photo')) {
            $image = $this->fileUploadService->uploadFile($request->file('photo'));

            if(!is_null($user->image_name)) {
                $this->fileUploadService->deleteFile($user->image_name);
            }
        }

        $user->update([
            "image_url" => $image['secure_url'] ?? $user->image_url,
            "image_name" => $image['public_id'] ?? $user->image_name
        ]);

        return response()->json([
            'status' => 'success',
            'code' => 200,
            'message' => 'created',
        ], 200);
    }

    public function stories(){
        $stories = User::find(auth()->id())->stories;

        return response()->json([
            'status' => 'success',
            'code' => 200,
            'message' => 'ok',
            'data' => StoryResource::collection($stories)
        ], Response::HTTP_OK);
    }
}
