<?php $__env->startSection('custom_css'); ?>
<link href="<?php echo e(asset('css/storieslisting.css')); ?>" rel="stylesheet" type="text/css">
    <link href="<?php echo e(asset('css/singlestory.css')); ?>" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

<div class="p-0 col-md-12">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb arr-right ">
            <li class="breadcrumb-item"><a href="<?php echo e(route('homepage')); ?>">Home</a></li>
            <li class="breadcrumb-item titlecase active"><a href="<?php echo e(route('story.show',$story->slug)); ?>"> <?php echo e($story->title); ?> </a></li>
        </ol>
    </nav>
</div>
    <div class="content">
        <!-- Content begins -->
        <span class="content1 topic">
            <h1 class="titlecase"> <?php echo e($story->title); ?> </h1>
            <h3 class="titlecase"> By: <?php echo e($story->author); ?> </h3>
        </span>

        <!-- Story section -->
        <div class="content1">
            <!-- Bookmark story -->
            <div class="subContent">
                <div class="subcontent-icon">
                    <?php if($story->favorite == true): ?>
                    <a> <i class="far fa-bookmark bookmark-blue stBookmark" onclick="bookmark(event);" id="bookmark-<?php echo e($story->id); ?>" data-story-id="<?php echo e($story->id); ?>"></i> </a>
                    <?php else: ?>
                    <a> <i class="far fa-bookmark stBookmark" onclick="bookmark(event);" id="bookmark-<?php echo e($story->id); ?>" data-story-id="<?php echo e($story->id); ?>"></i> </a>
                    <?php endif; ?>
                    
                </div> <!-- Bookmark story ends -->

                <!-- Stories -->
                <img class="stories" src="<?php echo e($story->image_url ?? '/images/placeholder.png'); ?>" >             
                <p><?php echo e($story->body); ?> </p>
            </div>

            <h1 class="end"> THE END </h1>
            <!-- Story section ends -->

            <!-- Tags -->
            <div class="tags">
                <div>
                    <div style="float:left;">
                        <?php $__currentLoopData = $story->tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <button class="" type="submit" id="submit"> <?php echo e($tag->name); ?> </button>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                     </div>
                     <div style="float:right;">
                        <?php if($story->reaction == 'dislike'): ?>
                        <i class="fa fa-thumbs-up fav-icon" style="margin-right:8px;margin-top:6px;" id="fav-like-<?php echo e($story->id); ?>" onclick="react(event);" data-story-id="<?php echo e($story->id); ?>"></i><small class="mr-3" id="likes-count-<?php echo e($story->id); ?>"><?php echo e($story->likes_count); ?></small>
                        <i class="fa fa-thumbs-down fav-icon fav-red" id="fav-dislike-<?php echo e($story->id); ?>" onclick="react(event);" data-story-id="<?php echo e($story->id); ?>" style="margin-top:10px; margin-right:10px;margin-left:10px;"></i><small id="dislikes-count-<?php echo e($story->id); ?>"><?php echo e($story->dislikes_count); ?></small>
                        <?php elseif($story->reaction == 'like'): ?>
                        <i class="fa fa-thumbs-up fav-icon fav-green" style="margin-right:8px;margin-top:6px;" id="fav-like-<?php echo e($story->id); ?>" onclick="react(event);" data-story-id="<?php echo e($story->id); ?>"></i><small class="mr-3" id="likes-count-<?php echo e($story->id); ?>"><?php echo e($story->likes_count); ?></small>
                        <i class="fa fa-thumbs-down fav-icon " id="fav-dislike-<?php echo e($story->id); ?>" onclick="react(event);" data-story-id="<?php echo e($story->id); ?>" style="margin-top:10px; margin-right:10px;margin-left:10px;"></i><small id="dislikes-count-<?php echo e($story->id); ?>"><?php echo e($story->dislikes_count); ?></small>
                        <?php else: ?>
                        <i class="fa fa-thumbs-up fav-icon" style="margin-right:8px;margin-top:6px;" id="fav-like-<?php echo e($story->id); ?>" onclick="react(event);" data-story-id="<?php echo e($story->id); ?>"></i><small class="mr-3" id="likes-count-<?php echo e($story->id); ?>"><?php echo e($story->likes_count); ?></small>
                        <i class="fa fa-thumbs-down fav-icon" id="fav-dislike-<?php echo e($story->id); ?>" onclick="react(event);" data-story-id="<?php echo e($story->id); ?>" style="margin-top:10px; margin-right:10px;margin-left:10px;"></i><small id="dislikes-count-<?php echo e($story->id); ?>"><?php echo e($story->dislikes_count); ?></small>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <!-- Tags ends -->
            <hr>
            <h1> Stories You Might Like </h1>
            <!-- Cards section -->
            <div class="stories">
                <div class="row">
                    <?php $__currentLoopData = $similarStories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $similarStory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                       <div class="col-md-3">
                            <div class="card story_card mt-4">
                                <?php if($similarStory->is_premium): ?>
                                    <span class="badge badge-primary premium-badge">PREMIUM</span>
                                <?php endif; ?>
                                <img src="<?php echo e($similarStory->image_url ?? '/images/placeholder.png'); ?>" 
                                    class="card-img-top cards" alt="story image">
                                <div class="card-body">
                                    <h5 class="card-title" style="font-size:1rem">
                                        <a href="<?php echo e(route('story.show',$story->slug)); ?>">
                                            <?php echo e(str_limit($similarStory->title,22)); ?>

                                        </a>
                                    </h5>
                                    <p class="card-text mb-1">by 
                                        <span class="author">
                                            <?php echo e($similarStory->author); ?>

                                        </span>
                                    </p>
                                    <hr>
                                    <p class="card-text">For kids <?php echo e($similarStory->age); ?> years</p>
                                </div>
                                <div class="card-footer d-flex justify-content-between">
                                    <div class="reactions">
                                        <a class="like" href="#">
                                            <i class="fa fa-thumbs-up mr-2"></i>
                                            <small class="mr-3"> <?php echo e($similarStory->likes); ?> </small>
                                        </a>
                                        <a class="dislike" href="#">
                                            <i class="fa fa-thumbs-down mr-2"></i>
                                            <small> <?php echo e($similarStory->dislikes); ?> </small>
                                        </a>
                                    </div>
                                    <div class="bookmark">
                                        <a>
                                            <i class="fa fa-bookmark"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div> 
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>                                       
            </div>    
        </div> 
    </div> 
     <!-- App Section -->
    <section class="main-banner">
        <div class="container2">
            <div class="row c">
                <!--Image Column-->
                <div class="col-lg-4 col-md-12 col-sm-12 ">
                    <img src="/images/resources/bottom2.jpg" alt=""  />
                </div>

                <!--Content Column-->
                <div class="content-column col-lg-8 col-md-12 col-sm-12">
                    <div class="applink">
                        <h4>Get up close with your child</h4>
                        <div class="text">The Kids Stories app is your go to app for free bedtime stories, fairy tales, poems and short stories for kids. Get in there and start reading!
                        </div>
                        <div class="buttons-box">
                            <!-- <a href="#" class="theme-btn wow slideInLeft" data-wow-delay="0ms" data-wow-duration="1500ms"><img src="/images/icons/apple.png" alt="" /></a> -->
                            <a href="https://github.com/hnginternship5/kidstories-android/blob/production/Bedtimestory/app/debug/app-debug.apk" class="theme-btn wow slideInRight" data-wow-delay="0ms" data-wow-duration="1500ms"><img src="/images/icons/playstore.png" alt="" /></a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section> 
    <!-- App sections ends -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/kelvin/HNG-5/CODE-TESTS/kidstories-main-repo/resources/views/singlestory.blade.php ENDPATH**/ ?>