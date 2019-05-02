<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminPasswordRequest;
use App\Admin;
use Illuminate\Support\Facades\Auth;

class AdminDashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('admin.dashboard');
    }
    /**
     * @param mixed $old_password, $password,Confirmed_password
     */

    public function changePassword(AdminPasswordRequest $request)
    {
        $admin = Admin::find(Auth::guard('admin')->id());
        $admin->password = bcrypt($request->password);
        $admin->update();
        return redirect()->back()->with('message', 'Your password has been updated successfully.');
    }

    public function profile(){

        $admin = Admin::find(Auth::guard('admin')->id());

        return view('admin.profile.edit',compact('admin',$admin));
    }
}
