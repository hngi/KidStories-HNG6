<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('admin.layouts.headers.guest', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <div class="container mt--8 pb-5">
        <!-- Table -->
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8">
                <div class="card bg-secondary shadow border-0">
                    <div class="card-header bg-transparent pb-5">
                        <div class="text-muted text-center mt-2"><?php echo e(__('Sign up with your credentials')); ?></div>
                        
                    </div>
                    <div class="card-body px-lg-5 py-lg-5">
                        
                        <form role="form" method="POST" action="<?php echo e(route('admin.post.register')); ?>">
                            <?php echo csrf_field(); ?>

                            <div class="form-group<?php echo e($errors->has('name') ? ' has-danger' : ''); ?>">
                                <div class="input-group input-group-alternative mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-hat-3"></i></span>
                                    </div>
                                    <input class="form-control<?php echo e($errors->has('name') ? ' is-invalid' : ''); ?>" placeholder="<?php echo e(__('Name')); ?>" type="text" name="name" value="<?php echo e(old('name')); ?>" required autofocus>
                                </div>
                                <?php if($errors->has('name')): ?>
                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                        <strong><?php echo e($errors->first('name')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                            <div class="form-group<?php echo e($errors->has('email') ? ' has-danger' : ''); ?>">
                                <div class="input-group input-group-alternative mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                                    </div>
                                    <input class="form-control<?php echo e($errors->has('email') ? ' is-invalid' : ''); ?>" placeholder="<?php echo e(__('Email')); ?>" type="email" name="email" value="<?php echo e(old('email')); ?>" required>
                                </div>
                                <?php if($errors->has('email')): ?>
                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                        <strong><?php echo e($errors->first('email')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                            <div class="form-group<?php echo e($errors->has('password') ? ' has-danger' : ''); ?>">
                                <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                                    </div>
                                    <input class="form-control<?php echo e($errors->has('password') ? ' is-invalid' : ''); ?>" placeholder="<?php echo e(__('Password')); ?>" type="password" name="password" required>
                                </div>
                                <?php if($errors->has('password')): ?>
                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                        <strong><?php echo e($errors->first('password')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                            <div class="form-group">
                                <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                                    </div>
                                    <input class="form-control" placeholder="<?php echo e(__('Confirm Password')); ?>" type="password" name="password_confirmation" required>
                                </div>
                            </div>
                            
                            
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary mt-4"><?php echo e(__('Create account')); ?></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', ['class' => 'bg-default'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/kelvin/HNG-5/CODE-TESTS/kidstories-main-repo/resources/views/admin/auth/register.blade.php ENDPATH**/ ?>