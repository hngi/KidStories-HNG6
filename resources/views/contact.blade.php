@extends('layouts.app')

@section('custom_css')
    <link href="{{ asset('css/about.css') }}" rel="stylesheet" type="text/css" >
@endsection

@section('content')

        <div class="bannerx">
        <div class="banner__content">
            <h1 class="faq-text">Contact Us</h1>
        </div> 
    </div>

<div class="auto-container m-b-60">

    <div class="col-md-6 pull-left">

        <h2>We would love to hear from you!</h2>

        <p class="appr">Thank you for choosing Kids Stories. We would love to hear from you. Please feel free to email us or fill the form below. Happy reading!</p>

        <div class="contact-text">
            <i class="fa fa-map-pin"></i><span class="info-space">Kidstories</span>
            <p style="margin-left: 22px">3, Birrel Avenue, Sabo, <br> Yaba, Lagos   </p>
            <p style="margin-left: 22px"></p>
        <i class="fa fa-phone"></i> <span class="info-space">0810-323-2433</span><br style="margin-bottom: 10px;">
        <i class="fa fa-envelope"></i> <span class="info-space">hello@kidstories.com</span>
        </div>
    </div>


    <div class="col-md-6 pull-left">
    <div class="container">
    <div class="card text-white mb-3" style="background-color: #718CFB">

  <div class="card-body">
    <form>
    <div class="form-group align-items-center">
    <div class="col">
    <label for="exampleFormControlInput1">Full name</label>
    <input type="email" class="form-control detail" id="exampleFormControlInput1" placeholder="Full Name">
  </div>
</div>

    <div class="form-group align-items-center">
    <div class="col">
    <label for="exampleFormControlInput1">Email address</label>
    <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
  </div>
</div>
  
    <div class="form-group align-items-center">
    <div class="col">
    <label for="exampleFormControlInput1">Subject</label>
    <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="Hello!">
  </div>
</div>
  

    <div class="form-group align-items-center">
    <div class="col">
    <label for="exampleFormControlTextarea1">Message</label>
    <textarea class="form-control" id="exampleFormControlTextarea1" rows="6" placeholder="Your message..."></textarea>
  </div>
</div>
</form>
<div class="col-md-12">
<button type="button" class="btn btn-light "><a href="#">Send Message</a></button>
</div>
  </div>
</div>
        
    </div>
    </div>
      


    </div>
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
