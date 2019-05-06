<?php

namespace App\Http\Controllers\SuperAdmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Paystack;
use App\Subscribed;

class PaymentController extends Controller
{
    // displays all payments

    public function index()
    {
    	$transactions=Paystack::getAllTransactions();

    	//dd($transactions);
    	return view('admin.payment.index',compact('transactions'));
    }

}
