@extends('layouts.app')

@section('custom_css')
    <link href="{{ asset('css/login.css') }}" rel="stylesheet" type="text/css" >
@endsection

@section('content')
    <div class="login_wrapper container">
        <div class="login">
            <div class="row">
                <div class="col-md-7">
                    <div class="illustration text-white text-center d-flex flex-column">
                        <div class="d-flex justify-content-between">
                            <p class="text-left">
                                Kid stories offer a wide range <br />
                                of stories
                            </p>
                            <img
                                class="lines align-self-center"
                                src="images/resources/lines.png"
                                alt="lines"
                            />
                        </div>
                        <img class="book d-block align-self-center mb-2" src="images/resources/book.png" alt="Boy and girl with books"
                        />
                        <img class="lines d-block" src="images/resources/lines.png" alt="lines" />
                    </div>
                </div>
                <div class="col-md-5">
                    <form class="login_form text-center py-3 pr-4"  method="POST" action="{{ route('login') }}">
                    @csrf

                        <h5 class="font-weight-bold mt-1">Log in to your account</h5>
                    <div class="form-group row">

                        <div class="col-md-12">
                            <input id="email" placeholder="Email Address" type="email" class="d-block mt-4 mx-auto pr-2 @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            @if ($errors->has('email'))
                                <span class="invalid-feedback text-left" style="display: block;" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">

                        <div class="col-md-12">
                            <input id="password" placeholder="Password" type="password" class="d-block mt-4 mx-auto pr-2 @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                            @if ($errors->has('password'))
                                <span class="invalid-feedback text-left" style="display: block;" role="alert">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                            @if (Route::has('password.request'))
                                <a class="text-right d-block mt-2 pr-2" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                            @endif

                    <div class="form-group row mb-0">
                        <div class="col-lg-12">
                            <button type="submit" class="login_btn d-inline-block text-white mt-5">
                                {{ __('Login') }}
                            </button>


                        </div>
                    </div>

                        <p class="mt-4">
                            Need an account? <a href="{{ route('register') }}">Create an account</a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
