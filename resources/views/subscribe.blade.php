@extends('layouts.app')

@section('custom_css')
    <link href="{{ asset('css/about.css') }}" rel="stylesheet" type="text/css" >
@endsection

@section('content')

        <div class="upgrade container text-center px-4">
            <h2 class="font-weight-bold">Unlock Your Storytelling Potential</h2>
            <p>
                A full library of interesting stories at your fingertips for your kids -
                never miss the next <br />
                great bedtime story and improve your storytelling skills.
            </p>
            <h3>First 7 Days Free</h3>
            <!-- Subcription Plans -->
            <div class="plans d-md-flex justify-content-around mt-4 mx-auto">
                <!-- Monthly Subscription -->
                <div class="monthly mb-4">
                    <p class="mb-4">Monthly Billing</p>
                    <div class="payment_card monthly_card">
                        <h5>Monthly</h5>
                        <h1>1000/<span class="month">month</span></h1>
                        <div class="benefits text-md-left">
                            <p class="font-weight-bold">Benefits</p>
                            <span class="benefit d-block"
                                >Unlimited access to all bedtime stories</span
                            >
                            <span class="benefit d-block">Become a better storyteller</span>
                            <span class="benefit d-block"
                                >Exciting new contents regularly</span
                            >
                            <span class="benefit d-block mb-5"
                                >Offline access to saved stories</span
                            >
                        </div>
                        <a href="#" class="proceed text-white text-center"
                            >Start - 7 Days Free Trial</a
                        >
                    </div>
                </div>
                <!-- Monthly Ends -->

                <!-- Yearly subcription -->
                <div class="annual">
                    <p class="mb-4">Yearly Billing <small>Save 20%</small></p>
                    <div class="payment_card annual_card">
                        <h5>Yearly</h5>
                        <h1>10,000/<span class="month">Year</span></h1>
                        <div class="benefits text-md-left">
                            <p class="font-weight-bold">Benefits</p>
                            <span class="benefit d-block"
                                >Unlimited access to all bedtime stories</span
                            >
                            <span class="benefit d-block">Become a better storyteller</span>
                            <span class="benefit d-block"
                                >Exciting new contents regularly</span
                            >
                            <span class="benefit d-block mb-5"
                                >Offline access to saved stories</span
                            >
                        </div>
                        <a href="#" class="proceed text-white text-center"
                            >Start - 7 Days Free Trial</a
                        >
                    </div>
                </div>
                <!-- Yearly ends -->
            </div>
            <!-- Subcription Plan ends -->
            <p class="mt-4">
                See our <a href="">Privacy Policy</a> & <a href="">Terms of Use</a>
            </p>
        </div>


<!--Scroll to top-->
<div class="scroll-to-top scroll-to-target" data-target="html"><span class="icon fa fa-angle-double-up"></span></div>

<!-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
            </div>
        </div>
    </div>
</div> -->
@endsection
