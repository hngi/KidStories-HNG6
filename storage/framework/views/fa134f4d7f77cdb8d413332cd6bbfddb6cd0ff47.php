<?php $__env->startSection('custom_css'); ?>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/select2.min.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/MultiFileUpload.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <!-- Header goes here -->
    <div class="page-wrapper">
        <div class="auto-container">
            <section class="add-story">
                <form action="<?php echo e(route('story.store')); ?>" method="post" enctype="multipart/form-data">
                <?php echo e(csrf_field()); ?>

                     <div class="form-input">
                        <label for="category">Category:</label>
                        <select name="category_id" id="category" class="form-control" required>
                            <option value="">Select category</option>
                            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($category->id); ?>"><?php echo e($category->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <div class="form-input title-input" style="margin-top: 20px;">
                        <label for="title">Title:</label>
                        <input type="text"  class="form-control" name="title" id="title" required>
                    </div>
                    <div class="form-input" style="margin-top: 20px;">
                        <label for="age">Age:</label>
                        <input type="text" class="form-control" name="age" id="age" required placeholder="eg 1-4">
                    </div>
                    <div class="form-input" style="margin-top: 20px;">
                        <label for="author">Author:</label>
                        <input type="text" class="form-control" name="author" id="author" required>
                    </div>
                    <div class="form-input" style="margin-top: 20px;">
                        <label for="cover">Cover Image:</label>
                        <p id="for_ad_image" class="valError text-danger small"></p>
                        <div class="file-upload-previews"></div>
                        <div class="file-upload">
                            <input type="file" name="photo" 
                                class="file-upload-input with-preview" 
                                title="Click to add files" 
                                maxlength="1" accept="jpg|jpeg|png|gif" 
                                onchange="checkFile(this)" id="img">
                            <span style="color:#000">CLICK OR DRAG IMAGES HERE</span>
                            <input type="hidden" id="imgCount" value="1"/>
                            <input type="hidden" id="previousImages" 
                                    name="previousImages" value="1">
                        </div>
                    </div>
                    <div class="form-input" style="margin-top: 20px;">
                        <label for="category">Tags:</label>
                        <select name="tags[]" id="tags" class="form-control" multiple required>
                            <option value=""></option>
                            <?php $__currentLoopData = $tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($tag->id); ?>"><?php echo e($tag->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <div class="form-input" style="margin-top: 20px;">
                        <label for="content">Content:</label>
                        <textarea class="form-control" placeholder="And the fish happened to grow wings..." name="body" id="content" cols="50" rows="10" required></textarea>
                    </div>
                    <div class="buttons">
                        <button class="btn save">Post</button>
                    </div>
                </form>
            </section>
        </div>
    </div>
    <!--End pagewrapper-->

    <!-- Footer goes here -->
    <!--Scroll to top-->
    <div class="scroll-to-top scroll-to-target" data-target="html"><span class="icon fa fa-angle-double-up"></span></div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
    <script type="text/javascript" src="<?php echo e(asset('js/jQuery.MultiFile.min.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('js/select2.min.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('js/select2_init.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('js/MultiFileUpload.js')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/kelvin/HNG-5/CODE-TESTS/kidstories-main-repo/resources/views/create-story.blade.php ENDPATH**/ ?>