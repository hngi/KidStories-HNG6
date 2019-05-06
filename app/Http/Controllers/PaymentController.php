<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Paystack;
use App\Payment;
use App\User;
use App\Subscribed;
use App\Subscription;
use Carbon\Carbon;

class PaymentController extends Controller
{
    //
    /**
     * Redirect the User to Paystack Payment Page
     * @return Url
     */
    public function redirectToGateway()
    {
        return Paystack::getAuthorizationUrl()->redirectNow();
    }

    /**
     * Obtain Paystack payment information
     * @return void
     */
    public function handleGatewayCallback()
    {
        $paymentDetails = Paystack::getPaymentData();

       // dd($paymentDetails);

        $user=User::where('email',$paymentDetails['data']['customer']['email'])->first();

    return    $this->updateDatabase($user,$paymentDetails['data']);

        // Now you have the payment details,
        // you can store the authorization_code in your db to allow for recurrent subscriptions
        // you can then redirect or do whatever you want
    }

    public function updateDatabase($user,$data)
    {
    	//update subscribed table
    	$subscription=Subscription::where('title',$data['metadata']['subscription'])->first();

    	$today=Carbon::now();
    	Subscribed::create([
    		"user_id"=>$user->id,
    		"subscription_id"=>$subscription->id,
    		"expired_date"=>$today->addDays($subscription->duration),
    		
    	]);

    	return redirect()->route('home');

    	//updating the payment table might not be neccesary for now. i can retrieve all payment details from paystack directly


    }
}
