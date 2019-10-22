<?php

namespace App\Http\Controllers\SuperAdmin;

use Paystack;
use App\User;
use App\Story;
use App\Admin;
use App\Reaction;
use Carbon\Carbon;
use App\Subscribed;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdminPasswordRequest;

class AdminDashboardController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {   
        $usersCount = User::count();
        $query = User::where('created_at', '>' , Carbon::now()->subDays(7));
        $recentUsers = $query->count();
        $users = $query->latest()->limit(5)->get();
        $engagements = Reaction::where('created_at', '>' , Carbon::now()->subDays(7))->count();
        $premiumUsers = Subscribed::distinct('user_name')->count();

        $recentStories = Story::withoutGlobalScopes()->where('created_at', '>' , Carbon::now()->subDays(2))
                            ->with(['user'])
                            ->latest()
                            ->limit(5)
                            ->get();

        $storyCount = Story::withoutGlobalScopes()->count();
        $pendingCount = Story::withoutGlobalScopes()->where('is_approved', 0)->count();
        $premiumCount = Story::withoutGlobalScopes()->where('is_premium', 1)->count();
        $regularCount = Story::withoutGlobalScopes()->where('is_premium', 0)->count();


        //trying to get the total amount made from subscription. 
        //this would be a temporal means cos the package used does not offer such functionality

       /* $transactions=Paystack::getAllTransactions();

        $paystackBal=0;

        foreach ($transactions as $key => $value) {
            $paystackBal=intval($paystackBal)+intval($value['amount']);
        }*/
        
        return view('admin.dashboard',
            compact(
                'users',
                'usersCount', 
                'recentUsers', 
                'premiumUsers',
                'engagements',
                'storyCount', 
                'pendingCount', 
                'premiumCount', 
                'regularCount',
                'recentStories'
                // 'paystackBal'
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
