<?php

namespace App\Http\Controllers\SuperAdmin;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *;
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $users=User::orderBy('id','DESC')->paginate(10);
        return view('admin.users.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request,[
            "first_name"=>['required'],
            "last_name"=>['required'],
            "phone"=>['required','numeric'],
            "location"=>['required'],
            "email"=>['required','unique:users'],
            "password"=>['required'],
            "postal_code"=>['required']
        ]);

        User::create([
            "first_name"=>$request->first_name,
            "last_name"=>$request->last_name,
            "email"=>$request->email,
            "location"=>$request->location,
            "password"=> Hash::make($request->password),
            "postal_code"=>$request->postal_code
        ]);

        return redirect()->route('user.index')->with(['status'=>'user successfully added']);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        //return view('admin.users.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $user=User::findOrFail($id);
        return view('admin.users.edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
       $user=User::findOrFail($id);

         $this->validate($request,[
            "first_name"=>['required'],
            "last_name"=>['required'],
            "phone"=>['required','numeric'],
            "location"=>['required'],
            "email"=>['required',  Rule::unique('users')->ignore($user->id)],
           
            "postal_code"=>['required']
        ]);

        
         $user->update([
            "first_name"=>$request->first_name,
            "last_name"=>$request->last_name,
            "phone"=>$request->phone,
            "location"=>$request->location,
            "postal_code"=>$request->postal_code,
          
         ]);

         return back()->with(['status'=>'user details updated successfully, here is what you have now']);


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $user=User::findOrFail($id);
        $user->delete();

        return back()->with(['status'=>"user successfully deleted"]);
    }
}
