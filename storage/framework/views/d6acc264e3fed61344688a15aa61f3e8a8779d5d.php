<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('admin.stories.partials.header', ['title' => __('Story Detail')], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0"><?php echo e(__('Manage Stories')); ?></h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="<?php echo e(route('admin.stories.index')); ?>" class="btn btn-sm btn-primary"><?php echo e(__('Back to list')); ?></a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" 
                            autocomplete="off" enctype="multipart/form-data">
                            <h6 class="heading-small text-muted mb-4"><?php echo e(__('Story information')); ?> 
                               <span>
                                <a href="<?php echo e(route('admin.stories.edit',['id'=>$story->slug])); ?>" class="btn btn-sm btn-primary"><?php echo e(__('edit')); ?></a>
                            </span>
                        </h6>
                            <div class="pl-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-title"><?php echo e(__('Title')); ?> </label>
                                    <input  type="text" value="<?php echo e($story->title); ?>" 
                                        class="form-control form-control-alternative" disabled>
                                </div>         
                                <div class="form-group">
                                    <img src="<?php echo e($story->image_url ?? '/images/placeholder.png'); ?>" style="height:15rem" alt="" 
                                        class="form-control img">
                                </div>   
                                <div class="form-group">
                                    <label class="form-control-label" for="input-title"><?php echo e(__('Tags')); ?> </label>
                                    <select name="tags[]" id="tags" multiple disabled
                                        class="form-control form-control-alternative">
                                        <option value=""></option>
                                        <?php $__currentLoopData = $story->tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option selected>
                                                <?php echo e($tag->name); ?>

                                            </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    <?php if($errors->has('tags')): ?>
                                        <span class="invalid-feedback" role="alert">
                                            <strong><?php echo e($errors->first('tags')); ?></strong>
                                        </span>
                                    <?php endif; ?>
                                </div>                
                                <div class="form-group">
                                    <label class="form-control-label" for="input-title"><?php echo e(__('Content')); ?> </label>
                                    <textarea style="height:200px" type="text" 
                                         class="form-control form-control-alternative" 
                                        disabled >
                                        <?php echo e($story->body); ?>

                                    </textarea>
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label" for="input-title"><?php echo e(__('Created By')); ?> </label>
                                    <input  type="text" 
                                        value="<?php echo e($story->user->fullName); ?>"
                                        class="form-control form-control-alternative" disabled>
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label" for="input-title"><?php echo e(__('Created On')); ?> </label>
                                    <input  type="text" 
                                        value="<?php echo e($story->created_at->toDayDateTimeString()); ?>"
                                        class="form-control form-control-alternative" disabled>
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label" for="input-title"><?php echo e(__('Age')); ?> </label>
                                    <input  type="text" value="<?php echo e($story->age); ?>"
                                        class="form-control form-control-alternative" disabled>
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label" for="input-title"><?php echo e(__('Author')); ?> </label>
                                    <input  type="text" value="<?php echo e($story->author); ?>"
                                        class="form-control form-control-alternative" disabled>
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label" for="input-title"><?php echo e(__('Category')); ?> </label>
                                    <input  type="text" value="<?php echo e($story->category->name); ?>"
                                        class="form-control form-control-alternative" disabled>
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label" for="input-title"><?php echo e(__('Reading Time')); ?> </label>
                                    <input  type="text" value="<?php echo e($story->readingTime); ?>"
                                        class="form-control form-control-alternative" disabled>
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label" for="input-title"><?php echo e(__('Subscription')); ?> </label>
                                    <input  type="text" value="<?php echo e($story->subscription); ?>"
                                        class="form-control form-control-alternative" disabled>
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
<?php $__env->startPush('js'); ?>
    <script type="text/javascript" src="<?php echo e(asset('js/select2.min.js')); ?>"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/select2.min.css')); ?>">
    <script type="text/javascript" src="<?php echo e(asset('js/select2_init.js')); ?>"></script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('admin.layouts.app', ['title' => __('Manage Stories')], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/kelvin/HNG-5/CODE-TESTS/kidstories-main-repo/resources/views/admin/stories/show.blade.php ENDPATH**/ ?>