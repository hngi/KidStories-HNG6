<?php $__env->startSection('custom_css'); ?>
    <link href="<?php echo e(asset('css/login.css')); ?>" rel="stylesheet" type="text/css" >
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
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
                    <form class="login_form text-center py-3 pr-md-4"  method="POST" action="<?php echo e(route('login')); ?>">
                    <?php echo csrf_field(); ?>

                        <h5 class="font-weight-bold mt-1">Log in to your account</h5>
                        <br>
                        <span><a href="<?php echo e(route('auth.social',['provider'=>'google'])); ?>">Login with Gmail</a></span>
                    <div class="form-group row">

                        <div class="col-md-12">
                            <input id="email" placeholder="Email Address" type="email" class="d-block mt-4 mx-auto pr-2 <?php if ($errors->has('email')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('email'); ?> is-invalid <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>" name="email" value="<?php echo e(old('email')); ?>" required autocomplete="email" autofocus>
                            <?php if($errors->has('email')): ?>
                                <span class="invalid-feedback text-left" style="display: block;" role="alert">
                                    <strong><?php echo e($errors->first('email')); ?></strong>
                                </span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="form-group row">

                        <div class="col-md-12">
                            <input id="password" placeholder="Password" type="password" class="d-block mt-4 mx-auto pr-2 <?php if ($errors->has('password')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('password'); ?> is-invalid <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>" name="password" required autocomplete="current-password">

                            <?php if($errors->has('password')): ?>
                                <span class="invalid-feedback text-left" style="display: block;" role="alert">
                                    <strong><?php echo e($errors->first('password')); ?></strong>
                                </span>
                            <?php endif; ?>
                        </div>
                    </div>

                            <?php if(Route::has('password.request')): ?>
                                <a class="text-right d-block mt-2 pr-2" style="margin-right:2rem" href="<?php echo e(route('password.request')); ?>">
                                    <?php echo e(__('Forgot Your Password?')); ?>

                                </a>
                            <?php endif; ?>

                    <div class="form-group row mb-0">
                        <div class="col-lg-12">
                            <button type="submit" class="login_btn d-inline-block text-white mt-5">
                                <?php echo e(__('Login')); ?>

                            </button>


                        </div>
                    </div>

                        <p class="mt-4">
                            Need an account? <a href="<?php echo e(route('register')); ?>">Create an account</a>
                        </p>
                        <div class="form-group">
                            <div class="col-md-12">
                                <a href="<?php echo e(url('/login/facebook')); ?>" class="btn btn-facebook col-md-8 col-sm-8" style="margin-bottom:0.5rem;"><i class="fa fa-facebook"></i> Facebook</a>

                                <a href="<?php echo e(url('/login/google')); ?>"  class="btn btn-google col-md-8 col-sm-8"><i class="fa fa-google"></i> Google</a>


                            </div>

                             


                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/kelvin/HNG-5/CODE-TESTS/kidstories-main-repo/resources/views/auth/login.blade.php ENDPATH**/ ?>