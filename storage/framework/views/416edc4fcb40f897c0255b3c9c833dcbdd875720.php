<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('admin.stories.partials.header', ['title' => __('Edit Story')], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>   
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
                        <?php echo $__env->make('admin.stories.partials.flash', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <form method="post" action="<?php echo e(route('admin.stories.update',$story->slug)); ?>"
                            autocomplete="off" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>  <?php echo method_field('PUT'); ?>
                            <h6 class="heading-small text-muted mb-4"><?php echo e(__('Story information')); ?></h6>
                            <div class="pl-lg-4">
                                <div class="form-group <?php echo e($errors->has('category_id') ? ' has-danger' : ''); ?>">
                                    <label class="form-control-label" for="input-title"><?php echo e(__('Category')); ?> </label>
                                    <select name="category_id" class="form-control form-control-alternative">
                                        <option value="">Select Category</option>
                                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($category->id); ?>"
                                                 <?php echo e($category->id == old('category_id')?'selected':
                                                    $category->id == $story->category_id?'selected':''); ?>>
                                                <?php echo e($category->name); ?>

                                            </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    <?php if($errors->has('category_id')): ?>
                                        <span class="invalid-feedback" role="alert">
                                            <strong><?php echo e($errors->first('category_id')); ?></strong>
                                        </span>
                                    <?php endif; ?>
                                </div>

                                <div class="form-group <?php echo e($errors->has('title') ? ' has-danger' : ''); ?>">
                                    <label class="form-control-label" for="input-title"><?php echo e(__('Title')); ?> *</label>
                                    <input  type="text" name="title" 
                                        class="form-control form-control-alternative" required
                                        value="<?php echo e(old('title')?:$story->title); ?>">
                                    <?php if($errors->has('title')): ?>
                                        <span class="invalid-feedback" role="alert">
                                            <strong><?php echo e($errors->first('title')); ?></strong>
                                        </span>
                                    <?php endif; ?>
                                </div>  

                                <div class="form-group <?php echo e($errors->has('photo') ? ' has-danger' : ''); ?>">
                                    <label class="form-control-label" for="input-title"><?php echo e(__('Story Image')); ?> </label>
                                    <p id="for_ad_image" class="valError text-danger small"></p>
                                    <?php if($story->image_url): ?>
                                        <div class="file-upload-previews">
                                            <div class="MultiFile-label">
                                                <a class="MultiFile-remove" href="#" id="removeAdImg" 
                                                    data-item-id="<?php echo e($story->id); ?>" 
                                                    data-img-name="<?php echo e($story->image_url); ?>">x</a> 
                                                <span>
                                                    <span class="MultiFile-label" 
                                                        title="File selected: <?php echo e($story->image_url); ?>.jpg">
                                                        
                                                        <img class="MultiFile-preview" 
                                                                style="max-height:100px; max-width:100px;" 
                                                                src="<?php echo e($story->image_url); ?>">
                                                    </span>
                                                </span>
                                                <input type="hidden" name="previousImage" value="<?php echo e($story->image_url); ?>" />
                                            </div>
                                        </div> 
                                    <?php endif; ?>
                                    
                                    <div class="file-upload" 
                                        style="display:<?php echo e($story->image_url?'none':'block'); ?>">
                                        <input type="file" name="photo" 
                                        class="file-upload-input with-preview" 
                                        title="Click to add files" 
                                        maxlength="1" accept="jpg|jpeg|png|gif" 
                                        onchange="checkFile(this)" id="img">
                                        <span style="color:#000">CLICK OR DRAG IMAGES HERE</span>
                                        <input type="hidden" id="imgCount" value="1"/>
                                    </div>
                                </div>         
                                <div class="form-group <?php echo e($errors->has('tags') ? ' has-danger' : ''); ?>">
                                    <label class="form-control-label" for="input-title"><?php echo e(__('Tags')); ?> </label>
                                    <select name="tags[]" id="tags" multiple required
                                        class="form-control form-control-alternative">
                                        <option value=""></option>
                                        <?php $__currentLoopData = $tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($tag->id); ?>"
                                                <?php echo e(in_array($tag->id,$story->tags->pluck('id')->all())?'selected':''); ?>>
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
                                <div class="form-group <?php echo e($errors->has('body') ? ' has-danger' : ''); ?>">
                                    <label class="form-control-label" for="input-title"><?php echo e(__('Content')); ?> *</label>
                                    <textarea style="height:200px" type="text" 
                                         class="form-control form-control-alternative" name="body" required>
                                         <?php echo e(old('body')?:$story->body); ?>

                                    </textarea>
                                    <?php if($errors->has('body')): ?>
                                        <span class="invalid-feedback" role="alert">
                                            <strong><?php echo e($errors->first('body')); ?></strong>
                                        </span>
                                    <?php endif; ?>
                                </div>
                                <div class="form-group <?php echo e($errors->has('age') ? ' has-danger' : ''); ?>">
                                    <label class="form-control-label" for="input-title"><?php echo e(__('Age')); ?> *</label>
                                    <input  type="text" name="age"
                                        class="form-control form-control-alternative"  required 
                                        value="<?php echo e(old('age')?:$story->age); ?>">
                                    <?php if($errors->has('age')): ?>
                                        <span class="invalid-feedback" role="alert">
                                            <strong><?php echo e($errors->first('age')); ?></strong>
                                        </span>
                                    <?php endif; ?>
                                </div>
                                <div class="form-group <?php echo e($errors->has('author') ? ' has-danger' : ''); ?>">
                                    <label class="form-control-label" for="input-title"><?php echo e(__('Author')); ?> </label>
                                    <input  type="text" name="author"
                                        class="form-control form-control-alternative" 
                                        value="<?php echo e(old('author')?:$story->author); ?>">
                                    <?php if($errors->has('author')): ?>
                                        <span class="invalid-feedback" role="alert">
                                            <strong><?php echo e($errors->first('author')); ?></strong>
                                        </span>
                                    <?php endif; ?>
                                </div>

                                <div class="form-group <?php echo e($errors->has('is_premium') ? ' has-danger' : ''); ?>">
                                        <label class="form-control-label" for="input-is_premium"><?php echo e(__('Subscription')); ?></label><br>                                    
                                        <input type="radio" name="is_premium" value="1" 
                                             <?php echo e(old('is_premium')==1?'checked':
                                                $story->is_premium == 1?'checked':''); ?>> Premium<br>
                                        <input type="radio" name="is_premium" value="0"
                                            <?php echo e(old('is_premium')==='0'?'checked':
                                                $story->is_premium == 0?'checked':''); ?>> Regular<br>                                    
                                    <?php if($errors->has('is_premium')): ?>
                                        <span class="invalid-feedback" role="alert">
                                            <strong><?php echo e($errors->first('is_premium')); ?></strong>
                                        </span>
                                    <?php endif; ?>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-success mt-4"><?php echo e(__('Update')); ?></button>
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
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/MultiFileUpload.css')); ?>">
    <script type="text/javascript" src="<?php echo e(asset('js/jQuery.MultiFile.min.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('js/MultiFileUpload.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('js/select2.min.js')); ?>"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/select2.min.css')); ?>">
    <script type="text/javascript" src="<?php echo e(asset('js/select2_init.js')); ?>"></script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('admin.layouts.app', ['title' => __('Manage Stories')], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/kelvin/HNG-5/CODE-TESTS/kidstories-main-repo/resources/views/admin/stories/edit.blade.php ENDPATH**/ ?>