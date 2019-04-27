<?php

namespace App\Http\Controllers\Api;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use DB;
use Auth;

class AuthController extends Controller
{
    //
	/**
     * Login API
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request){
        if (Auth::attempt(['email' => request('email'), 'password' => request('password')])) {

            $user = Auth::user();

           

				$response = [
            'id' => $user->id,
			'first_name' => $user->first_name,
			'last_name' => $user->last_name,
			'is_admin' => $user->is_admin,
			'email' => $user->email,
			'location'=>$user->location,
			'postal_code'=>$user->postal_code,
			'phone'=>$user->phone,
			'token' => $user->createToken('MyApp')->accessToken
			];

            return response()->json([
                'status' => 'success',
                'code' => 200,
                'message' => 'OK',
                'data' => $response
            ], 200);
        } else {
            return response()->json([
                'error' => ['code' => 401, 'message' => 'Unauthorized']
            ], 401);
        }
    }

	/**
     * Register API
     *
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {

    



        $validator = Validator::make($request->all(), [
            'first_name' => 'required|min:2',
            'last_name' => 'required|min:2',
			'email' => 'required|email|unique:users',
            'password' => 'required',
            'phone'=>'required',
            'location'=>'required',
            'postal_code'=>'required'
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

		DB::beginTransaction();

        $user = User::create([
            'first_name'=>$request->get('first_name'),
            'last_name'=>$request->get('last_name'),
            'email'=>$request->get('email'),
            'password'=>bcrypt($request->get('password')),
            'is_admin' => false,
            'postal_code'=>$request->get('postal_code'),
            'phone'=>$request->get('phone'),
            'location'=>$request->get('location'),


        ]);

		DB::commit();

		$response = [
            'id' => $user->id,
			'first_name' => $user->first_name,
			'last_name' => $user->last_name,
			'is_admin' => $user->is_admin,
			'email' => $user->email,
			'location'=>$user->location,
			'postal_code'=>$user->postal_code,
			'phone'=>$user->phone,
			'token' => $user->createToken('MyApp')->accessToken
		];

        return response()->json([
            'status' => 'success',
            'code' => 201,
            'message' => 'Created',
            'data' => $response
        ], 201);
    }


  
	/**
     * Returns the details of a logged in user
     *
     * @return \Illuminate\Http\Response
     */
    public function details()
    {
    	
        $user = User::where('id', Auth::user()->id)->first();

        return response()->json([
            'status' => 'success',
            'code' => 200,
            'message' => 'OK',
            'data' => $user
        ], 200);
    }

	/**
     * Log user out
     *
     * @return \Illuminate\Http\Response
     */
    public function logout()
    {
        DB::table('oauth_access_tokens')
	        ->where('user_id', Auth::user()->id)
	        ->update(['revoked' => true]);

        return response()->json(['status' => true]);
    }

    public function changePassword(Request $request)
    {
        $user=User::findOrFail(Auth::user()->id);
        $user->update(['password'=>$request->password]);

        return response()->json([
            "status"=>"success",
            "code"=>200,
            "data"=>$user

        ]);

    }

 /**   public function allUsers()
    {
        $users=User::where('is_admin',false)->get();

        return response()->json([

            "status"=>'success',
            "code"=>200,
            "data"=>$users

        ]);

    }
    **/

}
