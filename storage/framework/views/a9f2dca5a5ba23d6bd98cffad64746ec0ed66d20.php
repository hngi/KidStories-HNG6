<?php $__env->startSection('custom_css'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/categories.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <div class="content">
        <!-- Showcase -->
        <section class="top-container">
            <header class="showcase">
                <h1 class="text-white"> Categories </h1>
            </header>
        </section>

        <!-- Navigation --> 
        <nav class="min-nav">
            <ul>
                <li><a href="<?php echo e(route('homepage')); ?>"> Home </a></li>
                <i class="fa fa-chevron-right"></i>
                <li><a class="current" href="<?php echo e(route('categories.index')); ?>"> Categories </a></li>
            </ul>
        </nav>   

        <!-- Story Categories -->
        <span >
            <h1 class="container1 span"> All Categories </h1>
        </span>    

        <div class="wrapper">     
            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                <div class="item">
                    <a href="<?php echo e(route('categories.stories', $category->id)); ?>"> 
                        <img class="category" src="<?php echo e($category->image_url); ?>"> 
                        <div class="info"> <?php echo e($category->name); ?> </div> 
                    </a>
                </div>

            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>     
        </div>
    </div>

    <section class="main-banner">
        <div class="container2">
            <div class="row c">

                <!--Image Column-->
                <div class="col-lg-4 col-md-12 col-sm-12 pcab">
                    <img src="<?php echo e(asset('images/resources/bottom.jpg')); ?>" alt=""  />
                </div>

                
                <!--Content Column-->
                <div class="content-column col-lg-8 pcad col-md-12 col-sm-12">
                    <div class="applink">
                        <h4>Get up close with your child</h4>
                        <div class="text">The Kids Stories app is your go to app for free bedtime stories, fairy tales, poems and short stories for kids. Get in there and start reading!
                        </div>
                        <div class="buttons-box">
                            <!-- <a href="#" class="theme-btn wow slideInLeft" data-wow-delay="0ms" data-wow-duration="1500ms"><img src="images/icons/apple.png" alt="" /></a> -->
                            <a href="https://github.com/hnginternship5/kidstories-android/blob/production/Bedtimestory/app/debug/app-debug.apk" class="theme-btn wow slideInRight" data-wow-delay="0ms" data-wow-duration="1500ms"><img src="<?php echo e(asset('images/icons/playstore.png')); ?>" alt="" /></a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>   

    <!--Scroll to top-->
    <div class="scroll-to-top scroll-to-target" data-target="html"><span class="icon fa fa-angle-double-up"></span></div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/kelvin/HNG-5/CODE-TESTS/kidstories-main-repo/resources/views/categories.blade.php ENDPATH**/ ?>