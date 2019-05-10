@extends('layouts.app')

@section('content')
<!-- <div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12 p-0">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>
                </div>
            </div>
        </div>
    </div>
</div> -->





        <div class="register_wrapper">
            <div class="register">
                <div class="row">
                    <div class="col-md-7">
                        <div class="illustration d-flex flex-column">
                            <img
                                class="lines"
                                src="../images/resources/lines.png"
                                class="d-block"
                                alt="lines"
                            />
                            <div class="testimonial text-dark align-self-center py-2 px-4">
                                <img src="../images/resources/star.png" class="star" alt="Star Rating" />
                                <img src="../images/resources/star.png" class="star" alt="Star Rating" />
                                <img src="../images/resources/star.png" class="star" alt="Star Rating" />
                                <img src="../images/resources/star.png" class="star" alt="Star Rating" />
                                <img src="../images/resources/star.png" class="star" alt="Star Rating" />
                                <p class="mt-3">
                                   whao it's an educating and interesting stories in there. my daughter love this app, she cant do without reading it. with this app she is always busy after school. it also teaches morals
                                </p>
                                <div class="testifier">
                                    <img src="../images/profile-icon.svg" alt="Image" />
                                    <span class="name font-weight-bold ml-2">Dara Otubu</span>
                                </div>
                            </div>
                            <img
                                class="lines align-self-end d-block"
                                src="../images/resources/lines.png"
                                alt="lines"
                            />
                        </div>
                    </div>

                    <div class="col-md-5">
                        <form class="register_form text-center pr-md-4" method="POST" action="{{ route('register') }}">
                              @csrf

                            <h5 class="font-weight-bold mt-2">Create your Free account</h5>
                            <p>Already have an account? <a href="{{ route('login') }}">Sign In</a></p>
                            <div class="col-lg-12">
                            <input
                                type="text"
                                name="first_name"
                                id="first_name"
                                placeholder="{{ __('First name') }}"
                                value = "{{ old('first_name') }}"
                                class="d-block mt-4 mx-auto pr-2 @error('first_name') is-invalid @enderror"
                                required autocomplete="name" autofocus
                            />
                             @error('first_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>


                        <div class="col-lg-12">
                            <input
                                type="text"
                                name="last_name"
                                id="last_name"
                                placeholder="{{ __('Last name') }}"
                                value ="{{ old('last_name') }}"
                                class="d-block mt-4 mx-auto pr-2 @error('last_name') is-invalid @enderror"
                                required autocomplete="name" autofocus
                            />

                             @error('last_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>


                        <div class="col-lg-12">
                            <input
                                type="email"
                                name="email"
                                id="email"
                                placeholder = "{{ __('E-Mail Address') }}"
                                value="{{ old('email') }}"
                                class="d-block mt-4 mx-auto pr-2 @error('email') is-invalid @enderror"
                                required autocomplete="name" autofocus
                            />
                             @error('email')
                                    <span class="invalid-feedback" role="alert" style="display: block;">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror


                        </div>


                        <div class="col-lg-12">
                            <input
                                type="text"
                                name="phone"
                                id="phone"
                                placeholder = "{{ __('Phone') }}"
                                class="d-block mt-4 mx-auto pr-2 @error('email') is-invalid @enderror"
                                required autocomplete="new-password" @error('phone') is-invalid @enderror"
                            />
                                   <span class="invalid-feedback" role="alert"  style="display: block;">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>

                        </div>

                        <div class="col-lg-12">
                            <input
                                type="password"
                                name="password"
                                id="password"
                                placeholder = "{{ __('Password') }}"
                                class="d-block mt-4 mx-auto pr-2 @error('password') is-invalid @enderror"
                               required autocomplete="new-password"
                            />

                                @error('password')
                                    <span class="invalid-feedback" role="alert" style="display: block;">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror


                        </div>



                        <div class="col-lg-12">
                            <input
                                type="password"
                                name="password_confirmation"
                                id="password-confirm"
                                placeholder = "{{ __('Confirm Password') }}"
                                class="d-block mt-4 mx-auto pr-2"
                                required autocomplete="new-password"
                            />
                        </div>



 
<!-- 
                            <a href="#" class="text-right d-block mt-2 pr-2"
                                >Forgot password?</a
                            > -->

                        <button type="submit" class="register_btn d-inline-block text-white mt-5">
                                    {{ __('Register') }}
                                </button>

                            <p class="mt-4 px-3 px-md-1">
                                By signing up you agree to Kids Stories
                                <a href="#">Terms and Conditions</a>
                            </p>
                            <div class="form-group">
                            <div class="col-md-12">
                                <a href="{{ url('/login/facebook') }}" class="btn btn-facebook col-md-8 col-sm-8" style="margin-bottom:0.5rem;"><i class="fa fa-facebook"></i> Facebook</a>

                                <a href="{{ url('/login/google') }}"  class="btn btn-google col-md-8 col-sm-8"><i class="fa fa-google"></i> Google</a>


                            </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>



@endsection
