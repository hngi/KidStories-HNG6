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
            'email' => ['required', 'string', 'min:3']
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
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
        //TODO: after updating passwords remove user details from password_reset table
    }


    /**
     * TODO
     * check if input tken is d valid token assigned
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $request->validate([
            'email' => ['required', 'string', 'min:3'],
            'token' => ['required', 'numeric', 'min:6']
        ]);

        $user = Password::where('email', $request->email)
            ->where('token', $request->token)
            ->first();

        if (! $user) {
            return response()->json([
                'status' => 'not found',
                'code' => 401,
                'message' => 'invalid token',
            ], 401);  
        }

        // TODO: check if token has expired
        // cehck with created_date

        // TODO: authenticate user for 5min to change passwords only

        return response()->json([
            'status' => 'success',
            'code' => 200,
            'message' => 'valid token, authentication expires in 5min',
        ], 200);


    }
}
