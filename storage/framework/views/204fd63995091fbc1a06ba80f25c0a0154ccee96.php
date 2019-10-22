<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('admin.categories.partials.header', ['title' => __('Edit Category')], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>   

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0"><?php echo e(__('Manage Categories')); ?></h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="<?php echo e(route('admin.categories.index')); ?>" class="btn btn-sm btn-primary"><?php echo e(__('Back to list')); ?></a>
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

                        <?php if(session('error')): ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <?php echo e(session('error')); ?>

                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        <?php endif; ?>
                        
                        <form method="post" action="<?php echo e(route('admin.categories.update', $category->id)); ?>" autocomplete="off" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>

                            <?php echo method_field('put'); ?>
                            
                            <h6 class="heading-small text-muted mb-4"><?php echo e(__('Category information')); ?></h6>
                            <div class="pl-lg-4">
                                <div class="form-group<?php echo e($errors->has('name') ? ' has-danger' : ''); ?>">
                                    <label class="form-control-label" for="input-name"><?php echo e(__('Name')); ?> *</label>
                                    <input type="text" name="name" id="input-name" class="form-control form-control-alternative<?php echo e($errors->has('name') ? ' is-invalid' : ''); ?>" placeholder="<?php echo e(__('Name')); ?>" value="<?php echo e($category->name ?? old('name')); ?>" required>

                                    <?php if($errors->has('name')): ?>
                                        <span class="invalid-feedback" role="alert">
                                            <strong><?php echo e($errors->first('name')); ?></strong>
                                        </span>
                                    <?php endif; ?>
                                </div>
                                <div class="form-group<?php echo e($errors->has('photo') ? ' has-danger' : ''); ?>">
                                    <label class="form-control-label" for="input-photo"><?php echo e(__('Photo')); ?> <i>(Optional)</i></label>
                                    <input type="file" name="photo" id="input-photo" class="form-control form-control-alternative<?php echo e($errors->has('photo') ? ' is-invalid' : ''); ?>" placeholder="<?php echo e(__('Photo')); ?>" value="<?php echo e(old('photo')); ?>">

                                    <?php if($errors->has('photo')): ?>
                                        <span class="invalid-feedback" role="alert">
                                            <strong><?php echo e($errors->first('photo')); ?></strong>
                                        </span>
                                    <?php endif; ?>
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
<?php echo $__env->make('admin.layouts.app', ['title' => __('Manage Categories')], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/kelvin/HNG-5/CODE-TESTS/kidstories-main-repo/resources/views/admin/categories/edit.blade.php ENDPATH**/ ?>