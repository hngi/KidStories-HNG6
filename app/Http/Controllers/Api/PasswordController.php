<?php

namespace App\Http\Controllers\Api;

use App\Password;
use App\User;
use App\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PasswordController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $request->validate([
            'email' => ['required', 'string','min:3']
        ]);

        $user = User::where('email', $request->email)->first();

        if (! $user) {
            return response()->json([
                'status' => 'not found',
                'code' => 404,
                'message' => 'user not found',
            ]);
        }

        $token = mt_rand(10000, 99999);

        $password = Password::create([
            'email' => $request->email,
            'token' => $token,
        ]);

        // TODO: send email to user with token

        return response()->json([
            'status' => 'sucess',
            'code' => 201,
            'message' => 'access token sent to email address',
        ], 201);
    }


    /**
     * Update user password
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
    }

    
    /**
     * TODO
     * check if input tken is d valid token assigned
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {

    }
}
