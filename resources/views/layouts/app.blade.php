<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Kids Stories') }}</title>


    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/jquery.js') }}"></script>
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/jquery-ui.js') }}"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Stylesheets -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('css/reset.css') }}" rel="stylesheet">
    <link href="{{ asset('css/tstyle.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <!-- Responsive -->
    <link href="{{ asset('css/tresponsive.css') }}" rel="stylesheet">

    @yield('custom_css')

</head>

<body>
    <div class="page-wrapper">

        <!-- Main Header-->
        <header class="main-header header-style-one">

            <!--Header-Upper-->
            <div class="header-upper">
                <div class="auto-container">
                    <div class="clearfix">
                        <!-- start of Logo -->
                        <div class="pull-left logo-outer">
                            <div class="logo"><a href="{{ route('homepage') }}"><img src="/images/logo.png" alt="" title="" width="105px" height="auto"></a></div>
                        </div>

                        <div class="pull-right upper-right clearfix">
                            <div class="nav-outer clearfix">

                                <!-- Main Menu -->
                                <nav class="main-menu navbar-expand-md">
                                    <div class="navbar-header">
                                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                                            <span class="icon-bar"></span>
                                            <span class="icon-bar"></span>
                                            <span class="icon-bar"></span>
                                        </button>
                                    </div>

                                    <div class="navbar-collapse collapse clearfix" id="navbarSupportedContent">
                                        <ul class="navigation clearfix">
                                            <li class="current"><a href="#">Home</a>
                                            </li>
                                            <li class=""><a href="#">Browse Stories</a>
                                            </li>
                                            <li><a href="{{ route('categories.index') }}">Categories</a></li>
                                            <li class=""><a href="#">My Stories</a>
                                            </li>
                                            <li><a href="#">About Us</a></li>
                                        </ul>
                                    </div>

                                </nav>

                                <!-- Main Menu End-->
                                <div class="outer-box">
                                    <!--Search Box-->
                                    <div class="search-box-outer">
                                        <div class="dropdown">
                                            <button class="search-box-btn dropdown-toggle" type="button" id="dropdownMenu3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="fa fa-search"></span></button>
                                            <ul class="dropdown-menu pull-right search-panel" aria-labelledby="dropdownMenu3">
                                                <li class="panel-outer">
                                                    <div class="form-container">
                                                        <form method="post" action="#">
                                                            <div class="form-group">
                                                                <input type="search" name="field-name" value="" placeholder="Search Here" required>
                                                                <button type="submit" class="search-btn"><span class="fa fa-search"></span></button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <!--Language-->
                                    <div class="language dropdown"><a class="btn btn-default dropdown-toggle" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" href="#"><span class="icon circle-icons fa fa-user"></span> Account <span class="icon fa fa-caret-down"></span> </a>
                                        <ul class="dropdown-menu style-one" aria-labelledby="dropdownMenu2">
                                            @guest
                                            <li>
                                                <a href="{{ route('login') }}">{{ __('Login') }}</a>
                                            </li>
                                            @if (Route::has('register'))
                                            <li>
                                                <a href="{{ route('register') }}">{{ __('Register') }}</a>
                                            </li>
                                            @endif
                                            @else
                                            <li>
                                            <a href="{{route('admin.profile')}}">
                                                    Profile
                                                </a>
                                            </li>
                                            <li>
                                                <a href="/bookmarks">
                                                    My Favorites
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                                    {{ __('Logout') }}
                                                </a>

                                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                    @csrf
                                                </form>
                                            </li>
                                            @endguest
                                        </ul>
                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <!--End Header Upper-->

        </header>
        <!--End Main Header -->

        <!-- Body -->
        <main>
            @yield('content')
        </main>

        <!-- Footer -->
        <footer class="footer-wrap">
            <div class="footer-box">
                <section>
                    <h5>Kid Stories</h5>
                    <a href="#">About Us</a>
                    <a href="#">Stories</a>
                    <a href="#">Contact Us</a>
                    <a href="#">Advertise with Us</a>
                </section>
                <section>
                    <h5>Quick Links</h5>
                    <a href="/create-story">Create a Story</a>
                    <a href="#">Favorite Story</a>
                    <a href="#">Explore Stories</a>
                    <a href="#">Authors</a>
                    <a href="#">Make a donation</a>
                </section>
                <section>
                    <h5>Others</h5>
                    <a href="#">User FAQs</a>
                    <a href="#">Legal</a>
                    <a href="#">Privacy Policy</a>
                    <a href="#">Terms and Conditions</a>
                </section>
                <section>
                    <h5>Newsletter</h5>
                    <p>Subscribe to our newsletter and be the first to get latest updates about new stories from us</p>
                    <div class="subscribe">
                        <input type="email" name="" id="subscribe-email" placeholder="Type email">
                        <button class="send-icon"><i class="fa fa-paper-plane"></i></button>
                    </div>
                </section>
            </div>
            <hr>
            <div class="footer-info">
                <p>© 2019 Kid Stories. All rights reserved</p>
                <div class="social-icons">

                </div>
            </div>
        </footer>

    </div>

    <script src="{{ asset('js/jquery.js') }}"></script>
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/jquery-ui.js') }}"></script>
    <script src="{{ asset('js/owl.js') }}"></script>
    <script src="{{ asset('js/appear.js') }}"></script>
    <script src="{{ asset('js/wow.js') }}"></script>
    <script src="{{ asset('js/paroller.js') }}"></script>
    <script src="{{ asset('js/script.js') }}"></script>
    <script src="{{ asset('js/index.js') }}"></script>
</body>

</html>
