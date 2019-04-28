<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
class UserController extends Controller
{
    //

	public function index()
	{
			$users=User::all();

    	return response()->json([

    		"status"=>201,
    		"message"=>'success',
    		"data"=>$users

    	]);
	}

    public function show($id)
    {
    	$user=User::findOrFail($id);

    	return response()->json([

    		"status"=>201,
    		"message"=>'success',
    		"data"=>$user

    	]);
    }

    public function update(Request $request,$id)
    {
    	$user=User::findOrFail($id);
    	$user->update($request->all());

    	return response()->json([

    		"status"=>201,
    		"message"=>'success',
    		"data"=>$user

    	]);


    }
}
