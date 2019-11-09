@extends('layouts.app')

@section('other_head_title')
My Profile Page
@endsection

@section('custom_css')
<link rel="stylesheet" type="text/css" href="css/profile.css">
@endsection

@section('content')

        <!-- Profile and Image section -->
        <div class="container mt-50">
            <section id="profile">
                <div id="image">
                    <img src="{{ ! is_null($user->image_url) ? $user->image_url : '/images/profile/imgIcon.png' }}" alt="Profile Pic" class="profilePic"> 
                   <!--  <a href="#"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" 
                    id="Layer_1" x="0px" y="0px" viewBox="0 0 300 300" style="enable-background:new 0 0 300 300;" 
                    xml:space="preserve" width="512px" height="512px" class=""><g><g><g><path 
                    d="M149.996,0C67.157,0,0.001,67.161,0.001,149.997S67.157,300,149.996,300s150.003-67.163,150.003-150.003    
                    S232.835,0,149.996,0z M221.302,107.945l-14.247,14.247l-29.001-28.999l-11.002,11.002l29.001,29.001l-71.132,71.126    
                    l-28.999-28.996L84.92,186.328l28.999,28.999l-7.088,7.088l-0.135-0.135c-0.786,1.294-2.064,2.238-3.582,2.575l-27.043,6.03   
                    c-0.405,0.091-0.817,0.135-1.224,0.135c-1.476,0-2.91-0.581-3.973-1.647c-1.364-1.359-1.932-3.322-1.512-5.203l6.027-27.035    
                    c0.34-1.517,1.286-2.798,2.578-3.582l-0.137-0.137L192.3,78.941c1.678-1.675,4.404-1.675,6.082,0.005l22.922,22.917    
                    C222.982,103.541,222.982,106.267,221.302,107.945z" data-original="#000000" class="active-path"
                    data-old_color="#00FF87" fill="#A875FF"/>
                    </g></g></g> </svg> </a> -->
                </div>
                <div class="nameContent">   
                    <h3 class="profileName"> {{ $user->fullname }} </h3>
                    @if ($user->location)
                    <p class="location"> {{ $user->location }} </p>
                    @endif
                <div>
            </section>
        </div>

        <div class="container form-container">  
            @if (session('error'))
                <div class="alert alert-danger" role="alert">
                    {{ session('error') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            @if (session('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                {{ method_field('PUT') }}
                <div>
                    <label for="inputFirstName"> First Name </label>
                    <input class="form-control" type="text" name="first_name" value="{{ $user->first_name }}" id="inputFirstName" placeholder="Enter First Name" />
                    @if ($errors->has('first_name'))
                        <strong class="text-danger">{{ $errors->first('first_name') }}</strong>
                    @endif
                </div>

                <div>
                    <label for="inputLastName"> Last Name </label>
                    <input class="form-control" type="text" name="last_name" value="{{ $user->last_name }}" id="inputLastName" placeholder="Enter Last Name" />
                    @if ($errors->has('last_name'))
                        <strong class="text-danger">{{ $errors->first('last_name') }}</strong>
                    @endif
                </div>

                <div>
                    <label for="inputEmail"> Email </label>
                    <input class="form-control" type="email" name="email" value="{{ $user->email }}" id="inputEmail" placeholder="Enter Email" />
                    @if ($errors->has('email'))
                        <strong class="text-danger">{{ $errors->first('email') }}</strong>
                    @endif
                </div>

                <div>
                    <label for="inputPhoneNumber"> Phone Number </label>
                    <input class="form-control" type="tel" name="phone" value="{{ $user->phone }}" id="inputPhoneNumber" placeholder="Enter Phone Number" />
                </div>

                <div>
                    <label for="inputLocation"> Location </label>
                    <input class="form-control" type="text" name="location" value="{{ $user->location }}" id="inputLocation" placeholder="Enter Location" />
                </div>

                <div>
                    <label for="inputPostal"> Postal Code </label>
                    <input class="form-control" type="text" name="postal_code" value="{{ $user->postal_code }}" id="inputPostal" placeholder="Enter Phone Code" />
                </div>

                <div>
                    <label for="inputStatus"> Update Profile Image </label>
                    <input type="file" name="photo" id="cover">
                </div>
                 <div>
                    <label for="inputStatus"> Membership Status </label>
                    @if($left)
                    <p>Your subscription expires in <strong>{{$left}}</strong></p>
                    @else
                    <p> You are yet to subscribe </p>
                    @endif
                </div>
                
                <div id="button">
                    <input type="submit" value="Save" />
                </div>
            </form>
        </div>      
    

    <!--Scroll to top-->
    <div class="scroll-to-top scroll-to-target" data-target="html"><span class="icon fa fa-angle-double-up"></span></div>

@endsection