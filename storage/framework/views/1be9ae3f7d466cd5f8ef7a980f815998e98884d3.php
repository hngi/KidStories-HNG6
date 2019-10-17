<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" sizes="57x57" href="/favicon/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="/favicon/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/favicon/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="/favicon/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/favicon/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="/favicon/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="/favicon/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="/favicon/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/favicon/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"  href="/favicon/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="/favicon/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon/favicon-16x16.png">
    <link rel="manifest" href="/favicon/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="/favicon/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo e(config('app.name', 'Kids Stories')); ?></title>
    <script src="<?php echo e(asset('js/app.js')); ?>"></script>

<!--     
    <script src="<?php echo e(asset('js/jquery.js')); ?>"></script>
    <script src="<?php echo e(asset('js/popper.min.js')); ?>"></script>
    <script src="<?php echo e(asset('js/bootstrap.min.js')); ?>"></script>
    <script src="<?php echo e(asset('js/jquery-ui.js')); ?>"></script> -->

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Stylesheets -->
  <!--   <link href="<?php echo e(asset('css/app.css')); ?>" rel="stylesheet"> -->
    <link href="<?php echo e(asset('css/bootstrap.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('css/reset.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('css/tstyle.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('css/style.css')); ?>" rel="stylesheet">
    <!-- Responsive -->
    <link href="<?php echo e(asset('css/tresponsive.css')); ?>" rel="stylesheet">

    <?php echo $__env->yieldContent('custom_css'); ?>
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
                            <div class="logo"><a href="<?php echo e(route('homepage')); ?>"><img src="/images/logo.png" alt="" title="" width="80px" height="auto"></a></div>
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
                                            <li class=""><a href="/">Home</a>
                                            </li>
                                            <li class=""><a href="<?php echo e(route('stories.index')); ?>">Browse Stories</a></li>
                                            <li><a href="<?php echo e(route('categories.index')); ?>">Categories</a></li>
                                            <?php if(auth()->guard()->check()): ?>
                                                <li class=""><a  href="<?php echo e(route('stories.mystories')); ?>">My Stories</a></li>
                                            <?php endif; ?>
                                            <?php if(auth()->guard()->guest()): ?>
                                                <li><a href="<?php echo e(route('story.store')); ?>">Create Story</a></li>
                                                <li><a href="<?php echo e(route('login')); ?>"><?php echo e(__('Login')); ?></a></li>
                                                <li><a href="<?php echo e(route('register')); ?>"><?php echo e(__('Register')); ?></a></li>
                                            <?php endif; ?>
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
                                                        <form action="<?php echo e(route('stories.index')); ?>" method="GET">
                                                            <input class="searchBox" type="search" minlength="2" name="search" placeholder="Search...">
                                                        </form>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <!--Language-->

                                    <?php if(auth()->guard()->check()): ?>
                                        <div class="language dropdown">
                                            <a class="btn btn-default dropdown-toggle" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" href="#">
                                                <span class="icon circle-icons fa fa-user"></span> <?php echo e(auth()->user()->fullname); ?> <span class="icon fa fa-caret-down"></span> 
                                            </a>
                                            <ul class="dropdown-menu style-one" aria-labelledby="dropdownMenu2">
                                                <li><a href="<?php echo e(route('profile')); ?>">Profile</a></li>
                                                <li><a href="/favorites">My Favorites</a></li>
                                                <li>
                                                    <a class="dropdown-item" href="<?php echo e(route('logout')); ?>" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                                        <?php echo e(__('Logout')); ?>

                                                    </a>

                                                    <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                                                        <?php echo csrf_field(); ?>
                                                    </form>
                                                </li> 
                                            </ul>
                                        </div>
                                    <?php endif; ?>

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
            <?php echo $__env->yieldContent('content'); ?>
        </main>


        <!-- Footer -->
<footer class="footer-wrap">
    <div class="footer-box">
        <section>
            <h5>Kid Stories</h5>
            <a href="<?php echo e(route('about')); ?>">About Us</a>
            <a href="<?php echo e(route('subscribe')); ?>">Subscriptions</a>
            <!-- <a href="#">Contact Us</a> -->
            <a href="<?php echo e(route('story.store')); ?>">Create a Story</a>

        </section>
        <section>
            <h5>Quick Links</h5>
            <a href="<?php echo e(route('story.store')); ?>">Create a Story</a>
            <a href="<?php echo e(route('stories.trending')); ?>">Trending Stories</a>
            <a href="<?php echo e(route('stories.index')); ?>">Explore Stories</a>
             <a href="https://paystack.com/pay/kidstoriesapp">Make a donation</a>
        </section>
<!--         <section>
            <h5>Others</h5>
            <a href="#">User FAQs</a>
            <a href="#">Legal</a>
            <a href="#">Privacy Policy</a>
            <a href="#">Terms and Conditions</a>
        </section> -->
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
        <p class="col-md-10 pull-left">© 2019 Kid Stories. All rights reserved</p>
        <div class="social-iconsb col-md-2 pull-right">
<!--           <a href="#">  <i class="fa fa-youtube"></i> </a>
 -->          <a target="_blank" href="https://instagram.com/mykidstories">  <i class="fa fa-instagram"></i> </a>
          <a target="_blank" href="https://facebook.com/mykidstories">  <i class="fa fa-facebook"></i> </a>
          <a target="_blank" href="https://twitter.com/mykidstories">  <i class="fa fa-twitter"></i> </a>
        </div>
        <div class="clearfix"></div>
    </div>
</footer>

    </div>
    
    <script src="<?php echo e(asset('js/owl.js')); ?>"></script>
    <script src="<?php echo e(asset('js/appear.js')); ?>"></script>
    <script src="<?php echo e(asset('js/wow.js')); ?>"></script>
    <script src="<?php echo e(asset('js/paroller.js')); ?>"></script>
    <script src="<?php echo e(asset('js/script.js')); ?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
    <script src="<?php echo e(asset('js/index.js')); ?>"></script>
    <?php echo $__env->yieldContent('js'); ?>
</body>

</html><?php /**PATH /home/kelvin/HNG-5/CODE-TESTS/kidstories-main-repo/resources/views/layouts/app.blade.php ENDPATH**/ ?>