<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminPasswordRequest;
use App\Admin;
use Illuminate\Support\Facades\Auth;
use Paystack;

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
    {   $stories=\App\Story::count();
        $users=\App\User::count();
        $premium_stories=\App\Story::where('is_premium',true)->count();

        //trying to get the total amount made from subscription. 
        //this would be a temporal means cos the package used does not offer such functionality

        $transactions=Paystack::getAllTransactions();

        $paystackBal=0;

        foreach ($transactions as $key => $value) {
            $paystackBal=intval($paystackBal)+intval($value['amount']);
        }
        
        return view('admin.dashboard',
            compact(
                'users',
                'premium_stories',
                'stories',
                'paystackBal'
            ));
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
