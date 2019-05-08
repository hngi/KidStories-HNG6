<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Services\FileUploadService;

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
    	$user = User::findOrFail(auth()->id());

    	return view('profile', compact('user'));
    }
}
