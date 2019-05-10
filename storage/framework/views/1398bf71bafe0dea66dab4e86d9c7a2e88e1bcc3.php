<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('admin.users.partials.header', ['title' => __('Add User')], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>   

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0"><?php echo e(__('User Management')); ?></h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="<?php echo e(route('admin.user.index')); ?>" class="btn btn-sm btn-primary"><?php echo e(__('Back to list')); ?></a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <?php if(session('status')): ?>
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <?php echo e(session('status')); ?>

                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        <?php endif; ?>
                        
                         <?php if($errors->all()): ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                You have some errors below!
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        <?php endif; ?>

                        <form method="post" action="<?php echo e(route('admin.user.store')); ?>" autocomplete="off">
                            <?php echo csrf_field(); ?>
                            
                            <h6 class="heading-small text-muted mb-4"><?php echo e(__('User information')); ?></h6>
                            <div class="pl-lg-4">
                                <div class="form-group<?php echo e($errors->has('first_name') ? ' has-danger' : ''); ?>">
                                    <label class="form-control-label" for="input-name"><?php echo e(__('First name')); ?></label>
                                    <input type="text" name="first_name" id="input-name" class="form-control form-control-alternative<?php echo e($errors->has('first_name') ? ' is-invalid' : ''); ?>" placeholder="<?php echo e(__('First name')); ?>" value="<?php echo e(old('first_name')); ?>" autofocus>
                                    <?php if($errors->has('first_name')): ?>
                                        <span class="invalid-feedback" role="alert">
                                            <strong><?php echo e($errors->first('first_name')); ?></strong>
                                        </span>
                                    <?php endif; ?>
                                </div>

                                 <div class="form-group<?php echo e($errors->has('last_name') ? ' has-danger' : ''); ?>">
                                    <label class="form-control-label" for="input-name"><?php echo e(__('Last name')); ?></label>
                                    <input type="text" name="last_name" id="input-name" class="form-control form-control-alternative<?php echo e($errors->has('first_name') ? ' is-invalid' : ''); ?>" placeholder="<?php echo e(__('Last name')); ?>" value="<?php echo e(old('last_name')); ?>" autofocus>
                                    <?php if($errors->has('last_name')): ?>
                                        <span class="invalid-feedback" role="alert">
                                            <strong><?php echo e($errors->first('last_name')); ?></strong>
                                        </span>
                                    <?php endif; ?>
                                </div>

                                <div class="form-group<?php echo e($errors->has('email') ? ' has-danger' : ''); ?>">
                                    <label class="form-control-label" for="input-email"><?php echo e(__('Email')); ?></label>
                                    <input type="email" name="email" id="input-email" class="form-control form-control-alternative<?php echo e($errors->has('email') ? ' is-invalid' : ''); ?>" placeholder="<?php echo e(__('Email')); ?>" value="<?php echo e(old('email')); ?>">
                                    <?php if($errors->has('email')): ?>
                                        <span class="invalid-feedback" role="alert">
                                            <strong><?php echo e($errors->first('email')); ?></strong>
                                        </span>
                                    <?php endif; ?>
                                </div>
                                <div class="form-group<?php echo e($errors->has('password') ? ' has-danger' : ''); ?>">
                                    <label class="form-control-label" for="input-password"><?php echo e(__('Password')); ?></label>
                                    <input type="password" name="password" id="input-password" class="form-control form-control-alternative<?php echo e($errors->has('password') ? ' is-invalid' : ''); ?>" placeholder="<?php echo e(__('Password')); ?>" value="">
                                    
                                    <?php if($errors->has('password')): ?>
                                        <span class="invalid-feedback" role="alert">
                                            <strong><?php echo e($errors->first('password')); ?></strong>
                                        </span>
                                    <?php endif; ?>
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label" for="input-password-confirmation"><?php echo e(__('Confirm Password')); ?></label>
                                    <input type="password" name="password_confirmation" id="input-password-confirmation" class="form-control form-control-alternative" placeholder="<?php echo e(__('Confirm Password')); ?>" value="">
                                </div>

                                <div class="form-group<?php echo e($errors->has('phone') ? ' has-danger' : ''); ?>">
                                    <label class="form-control-label" for="input-email"><?php echo e(__('Phone')); ?></label>
                                    <input type="text" name="phone" id="input-email" class="form-control form-control-alternative<?php echo e($errors->has('phone') ? ' is-invalid' : ''); ?>" placeholder="<?php echo e(__('Phone')); ?>" value="<?php echo e(old('phone')); ?>">
                                    <?php if($errors->has('phone')): ?>
                                        <span class="invalid-feedback" role="alert">
                                            <strong><?php echo e($errors->first('phone')); ?></strong>
                                        </span>
                                    <?php endif; ?>
                                </div>

                                  <div class="form-group<?php echo e($errors->has('location') ? ' has-danger' : ''); ?>">
                                    <label class="form-control-label" for="input-location"><?php echo e(__('Location')); ?></label>
                                    <input type="text" name="location" id="input-location" class="form-control form-control-alternative" placeholder="<?php echo e(__('Location')); ?>" value="<?php echo e(old('location')); ?>">
                                </div>

                                <div class="form-group<?php echo e($errors->has('postal_code') ? ' has-danger' : ''); ?>">
                                    <label class="form-control-label" for="input-postal-code"><?php echo e(__('Postal Code')); ?></label>
                                    <input type="text" name="postal_code" id="input-postal-code" class="form-control form-control-alternative" placeholder="<?php echo e(__('Postal Code')); ?>" value="<?php echo e(old('postal_code')); ?>">
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-success mt-4"><?php echo e(__('Save')); ?></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
        <?php echo $__env->make('admin.layouts.footers.auth', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', ['title' => __('User Management')], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/kelvin/HNG-5/CODE-TESTS/kidstories-main-repo/resources/views/admin/users/create.blade.php ENDPATH**/ ?>