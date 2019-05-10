<?php $__env->startSection('custom_css'); ?>
    <link href="<?php echo e(asset('css/about.css')); ?>" rel="stylesheet" type="text/css" >
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

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
                        <form method="POST" action="<?php echo e(route('pay')); ?>" accept-charset="UTF-8">

                            
            <input type="hidden" name="email" value="<?php echo e(Auth::user()->email); ?>"> 
            <input type="hidden" name="orderID" value="345">
            <input type="hidden" name="amount" value="100000"> 
          
            <input type="hidden" name="metadata" value="<?php echo e(json_encode($array = ['subscription' => 'monthly',])); ?>" > 
            <input type="hidden" name="reference" value="<?php echo e(Paystack::genTranxRef()); ?>"> 
            <input type="hidden" name="key" value="<?php echo e(config('paystack.secretKey')); ?>"> 
            <?php echo e(csrf_field()); ?> 





                        <button class="proceed text-white text-center"
                            >Start - 7 Days Free Trial</button
                        >
                    </form>
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
                         <form method="POST" action="<?php echo e(route('pay')); ?>" accept-charset="UTF-8">

                            
            <input type="hidden" name="email" value="<?php echo e(Auth::user()->email); ?>"> 
            <input type="hidden" name="orderID" value="345">
            <input type="hidden" name="amount" value="1000000"> 
          
            <input type="hidden" name="metadata" value="<?php echo e(json_encode($array = ['subscription' => 'yearly',])); ?>" > 
            <input type="hidden" name="reference" value="<?php echo e(Paystack::genTranxRef()); ?>"> 
            <input type="hidden" name="key" value="<?php echo e(config('paystack.secretKey')); ?>"> 
            <?php echo e(csrf_field()); ?> 





                        <button class="proceed text-white text-center"
                            >Start - 7 Days Free Trial</button
                        >
                    </form>
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
                    <?php if(session('status')): ?>
                        <div class="alert alert-success" role="alert">
                            <?php echo e(session('status')); ?>

                        </div>
                    <?php endif; ?>

                    You are logged in!
                </div>
            </div>
        </div>
    </div>
</div> -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/kelvin/HNG-5/CODE-TESTS/kidstories-main-repo/resources/views/subscribe.blade.php ENDPATH**/ ?>