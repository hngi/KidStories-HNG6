<?php

namespace App\Http\Controllers\SuperAdmin;

use Hash;
use App\User;
use Validator;
use App\Reaction;
use Carbon\Carbon;
use App\Subscribed;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *;
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $query = User::orderBy('id', 'DESC')->with(['stories', 'subscriptions']);

        $usersCount = $query->count();
        $recentUsers = $query->where('created_at', '>' , Carbon::now()->subDays(7))->count();
        $engagements = Reaction::where('created_at', '>' , Carbon::now()->subDays(7))->count();
        $premiumUsers = Subscribed::distinct('user_name')->count();

        $users = $query->paginate(25);

        return view('admin.users.index', compact(
            'users', 
            'usersCount', 
            'recentUsers', 
            'premiumUsers',
            'engagements'
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
        $this->validate($request,[
            "first_name"=>['required'],
            "last_name"=>['required'],
            "phone"=>['required','numeric'],
            "email"=>['required','unique:users'],
            "password"=>['required', 'string', 'confirmed']
        ]);

        User::create([
            "first_name"=>$request->first_name,
            "last_name"=>$request->last_name,
            "email"=>$request->email,
            "phone"=>$request->phone,
            "location"=>$request->location,
            "password"=> Hash::make($request->password),
            "postal_code"=>$request->postal_code
        ]);

        return redirect()->back()->with(['status'=>'User successfully added']);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
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
        $user=User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
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
       $user=User::findOrFail($id);

         $this->validate($request,[
            "first_name" => ['required'],
            "last_name" => ['required'],
            "phone" => ['required','numeric'],
            "email" => ['required',  Rule::unique('users')->ignore($user->id)],
        ]);

         $user->update([
            "first_name" => $request->first_name,
            "last_name" => $request->last_name,
            "phone" => $request->phone,
            "location" => $request->location,
            "postal_code" => $request->postal_code,
          
         ]);

         return back()->with(['status'=>'User details updated!']);


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user=User::findOrFail($id);
        $user->delete();

        return back()->with(['status'=>"User successfully deleted"]);
    }
}
