<?php $__env->startSection('custom_css'); ?>
<link href="<?php echo e(asset('css/storieslisting.css')); ?>" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="p-0 col-md-12">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb arr-right ">
            <li class="breadcrumb-item"><a href="<?php echo e(route('homepage')); ?>">Home</a></li>
            <li class="breadcrumb-item active"><a href="#">Stories</a></li>
        </ol>
    </nav>
</div>

<div class="auto-container adjust-padding">
    <div class="col-md-12 d-flex flex-row p-0 ">
        <div class="col-md-9 p-0">
            <div class="d-flex flex-column col-md-12  p-0">
                <div class="d-flex flex-row flex-wrap">
                    <?php $__empty_1 = true; $__currentLoopData = $stories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $story): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <div class="col-lg-4 ">
                    <div class="card col-lg-12 p-0 story-card mb-4 premium-badge-holder">
                                <?php if($story->is_premium): ?>
                                    <span class="badge badge-primary premium-badge">PREMIUM</span>
                                <?php endif; ?>

                                <?php if($story->image_url ): ?>
                                <a href="<?php echo e(route('story.show',$story->slug)); ?>"><img src="<?php echo e($story->image_url); ?>" /></a>
                                <?php else: ?>
                                <a href="<?php echo e(route('story.show',$story->slug)); ?>"><img src="/images/placeholder.png" /></a>
                                <?php endif; ?>

                                <div class="card-body story-card-body">
                                    <h5 class="card-title"><a href="<?php echo e(route('story.show',['story'=>$story->slug])); ?>"><?php echo e($story->title); ?></a></h5>
                                    <p class="card-text">By <a href="<?php echo e(route('author.stories', $story->author)); ?>"><?php echo e($story->author); ?></a></p>
                                    <hr style="margin:0 -5px;">
                                    <p>For Kids <?php echo e($story->age_from .' to '. $story->age_to); ?> years</p>
                                    <hr style="margin:0 -20px;">
                                    <div class="d-flex justify-content-between align-items-center card-">
                                        <div class="btn-group">
                                            <?php if($story->reaction == 'dislike'): ?>
                                            <i class="fas fa-thumbs-up fav-icon" style="margin-right:8px;margin-top:6px;" id="fav-like-<?php echo e($story->id); ?>" onclick="react(event);" data-story-id="<?php echo e($story->id); ?>"></i><small class="mr-3" id="likes-count-<?php echo e($story->id); ?>"><?php echo e($story->likes_count); ?></small>
                                            <i class="fas fa-thumbs-down fav-icon fav-red" id="fav-dislike-<?php echo e($story->id); ?>" onclick="react(event);" data-story-id="<?php echo e($story->id); ?>" style="margin-top:10px; margin-right:10px;margin-left:10px;"></i><small id="dislikes-count-<?php echo e($story->id); ?>"><?php echo e($story->dislikes_count); ?></small>
                                            <?php elseif($story->reaction == 'like'): ?>
                                            <i class="fas fa-thumbs-up fav-icon fav-green" style="margin-right:8px;margin-top:6px;" id="fav-like-<?php echo e($story->id); ?>" onclick="react(event);" data-story-id="<?php echo e($story->id); ?>"></i><small class="mr-3" id="likes-count-<?php echo e($story->id); ?>"><?php echo e($story->likes_count); ?></small>
                                            <i class="fas fa-thumbs-down fav-icon " id="fav-dislike-<?php echo e($story->id); ?>" onclick="react(event);" data-story-id="<?php echo e($story->id); ?>" style="margin-top:10px; margin-right:10px;margin-left:10px;"></i><small id="dislikes-count-<?php echo e($story->id); ?>"><?php echo e($story->dislikes_count); ?></small>
                                            <?php else: ?>
                                            <i class="fas fa-thumbs-up fav-icon" style="margin-right:8px;margin-top:6px;" id="fav-like-<?php echo e($story->id); ?>" onclick="react(event);" data-story-id="<?php echo e($story->id); ?>"></i><small class="mr-3" id="likes-count-<?php echo e($story->id); ?>"><?php echo e($story->likes_count); ?></small>
                                            <i class="fas fa-thumbs-down fav-icon" id="fav-dislike-<?php echo e($story->id); ?>" onclick="react(event);" data-story-id="<?php echo e($story->id); ?>" style="margin-top:10px; margin-right:10px;margin-left:10px;"></i><small id="dislikes-count-<?php echo e($story->id); ?>"><?php echo e($story->dislikes_count); ?></small>
                                            <?php endif; ?>
                                        </div>
                                        <span class="verticalLine">
                                        <?php if($story->favorite == true): ?>
                                            <a> <i class="far fa-bookmark bookmark-blue" style="margin-left: 8px" onclick="bookmark(event);" id="bookmark-<?php echo e($story->id); ?>" data-story-id="<?php echo e($story->id); ?>"></i> </a>
                                            <?php else: ?>
                                            <a> <i class="far fa-bookmark" style="margin-left: 8px" onclick="bookmark(event);" id="bookmark-<?php echo e($story->id); ?>" data-story-id="<?php echo e($story->id); ?>"></i> </a>
                                            <?php endif; ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <p style="font-size:24px; margin-top: 20px; font-weight: 200; text-align: center;">Oops! No stories found.</p>
                    <?php endif; ?>
                </div>

                <div style="margin-top: 40px;">
                    <?php echo e($stories->appends($_GET)->links()); ?>

                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="d-flex flex-row col-md-12  ">
                <div class="col-md-12" id="category-drop">
                    <h6>POPULAR CATEGORIES</h6><br>
                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <a href="<?php echo e(route('categories.stories', $category->id)); ?>"><?php echo e($category->name); ?></a><br>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    <hr style="width:10%;">
                    <div class="searchContainer">
                        <i class="fa fa-search searchIcon"></i>
                        <form action="<?php echo e(route('stories.index')); ?>">
                            <input class="searchBox" type="search" style="height:30px; width: 100%;" name="search" placeholder="Search..." value="<?php echo e(request()->query('search')); ?>" minlength="2" autocomplete="off">
                        </form>
                    </div>
                    <hr style="width:10%;">
                    <p>SORT BY</p>
                    <div class="card" style="width: 15rem;">
                        <form action="<?php echo e(url()->current()); ?>" method="GET">
                            <input type="hidden" name="search" value="<?php echo e(request()->query('search')); ?>">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                    <small style="display: block;">Min Age:</small>
                                    <select class="form-control form-control-sm" name="minAge">
                                        <option value="">Any age</option>
                                        <?php for($i = 0; $i < 18; $i++): ?>
                                            <option value="<?php echo e($i); ?>" <?php echo e(!is_null(request()->query('minAge')) && request()->query('minAge') == $i ? 'selected' : ''); ?>><?php echo e($i); ?></option>
                                        <?php endfor; ?>
                                    </select>
                                    <small style="margin-top: 8px;display: block;">Max Age:</small>
                                    <select class="form-control form-control-sm" name="maxAge" style="margin-bottom: 8px;">
                                        <option value="">Any age</option>
                                        <?php for($i = 1; $i < 18; $i++): ?>
                                            <option value="<?php echo e($i); ?>" <?php echo e(!is_null(request()->query('minAge')) && request()->query('maxAge') == $i ? 'selected' : ''); ?>><?php echo e($i); ?></option>
                                        <?php endfor; ?>
                                    </select>
                                </li>
                                

                                <li class="list-group-item">
                                    <button type="submit" class="form-control form-control-sm btn-primary">Sort</button>
                                </li>
                            </ul>
                        </form>
                    </div>
                    
                </div>
            </div>

        </div>
    </div>
</div>
<!-- App Section -->
<section class="main-banner">
    <div class="container2">
        <div class="row c">

            <!--Image Column-->
            <div class="col-lg-4 col-md-12 col-sm-12 pcab">
                <img src="<?php echo e(asset('images/resources/bottom.jpg')); ?>" alt="" />
            </div>


            <!--Content Column-->
            <div class="content-column col-lg-8 pcad col-md-12 col-sm-12">
                <div class="applink">
                    <h4>Get up close with your child</h4>
                    <div class="text">The Kids Stories app is your go to app for free bedtime stories, fairy tales, poems and short stories for kids. Get in there and start reading!
                    </div>
                    <div class="buttons-box">
                   <!--      <a href="#" class="theme-btn wow slideInLeft" data-wow-delay="0ms" data-wow-duration="1500ms"><img src="<?php echo e(asset('images/icons/apple.png')); ?>" alt="" /></a> -->
                        <a href="https://github.com/hnginternship5/kidstories-android/blob/production/Bedtimestory/app/debug/app-debug.apk" class="theme-btn wow slideInRight" data-wow-delay="0ms" data-wow-duration="1500ms"><img src="<?php echo e(asset('images/icons/playstore.png')); ?>" alt="" /></a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
<!-- End App Section -->
<!-- Footer goes here -->
<!--Scroll to top-->
<div class="scroll-to-top scroll-to-target" data-target="html"><span class="icon fa fa-angle-double-up"></span></div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/kelvin/HNG-5/CODE-TESTS/kidstories-main-repo/resources/views/stories.blade.php ENDPATH**/ ?>