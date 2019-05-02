<?php

namespace App\Http\Controllers\Api;

use DateTime;
use App\Password;
use App\User;
use App\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Http\Controllers\MailController;

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
        if (! $user) {
            return response()->json([
                'status' => 'not found',
                'code' => 404,
                'message' => 'user not found',
            ]);
        }

        $user = Password::where('email', $request->email);
        // prevent having dupicate records
        if ($user) {
            $user->delete();
        }

        // generate token for random recovery
        $token = mt_rand(10000, 99999);

        // create date
        $date = new DateTime();
        $date = $date->format('Y-m-d H:i:s');

        // store in database
        $password = Password::create([
            'email' => $request->email,
            'token' => $token,
            'created_at' => $date,
        ]);


        // send token to user
        MailController::mail($request->email, $token);

        return response()->json([
            'status' => 'sucess',
            'code' => 201,
            'message' => 'access token sent to email address',
        ], 201);
    }


    /**
     * 
     * update user password
     *
     * @param  Request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        // return Password::truncate();
        $request->validate([
            'email' => ['required', 'string', 'min:3'],
            'token' => ['required', 'numeric', 'min:6'],
            'password' => ['required', 'string', 'min:6'],
            'password2' => ['required', 'string', 'min:6'],
        ]);

        if ($request->password != $request->password2) {
            return response()->json([
                'status' => 'bad request',
                'code' => 400,
                'message' => 'passwords do not match',
            ], 400);
        }


        $password = Password::where('email', $request->email)
            ->where('token', $request->token)
            ->first();


        if (!$password) {
            return response()->json([
                'status' => 'not allowed',
                'code' => 401,
                'message' => 'invalid token',
            ], 401);
        }
        // return $user->created_at;
        // calculate time difference
        $start_date = new DateTime($password->created_at);
        $since_start = $start_date->diff(new DateTime());
        $minutes = $since_start->days * 24 * 60;
        $minutes += $since_start->h * 60;
        $minutes += $since_start->i;

        if ($minutes > 5) {
            return response()->json([
                'status' => 'not authorized',
                'code' => 401,
                'message' => 'expired token',
            ], 401);
        }

        // update password
        $user = User::where('email', $request->email)
            ->first();
            
        if (! $user) {
            return response()->json([
                'status' => 'not found',
                'code' => 404,
                'message' => 'user not found',
            ], 404);
        }
        $user->update([
            'password' => Hash::make($request->password)
        ]);
        // remove token from database
        $password = Password::where('email', $request->email)
            ->where('token', $request->token);
        $password->delete();

        return response()->json([
            'status' => 'success',
            'code' => 201,
            'message' => 'Password updated',
        ], 200);
    }
}
