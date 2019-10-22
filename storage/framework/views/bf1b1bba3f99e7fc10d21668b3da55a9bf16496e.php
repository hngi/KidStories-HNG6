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
    <div class="mb-3">
        <h1>Search Results</h1>
    </div>
    <div class="col-md-12 d-flex flex-row p-0 ">
        <div class="col-md-9 p-0">
            <div class="d-flex flex-column col-md-12  p-0">
                <?php if($stories && count($stories) > 0): ?>
                <div class="d-flex flex-row flex-wrap">
                    <?php $__currentLoopData = $stories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $story): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-lg-4 ">
                    <div class="card story-card mb-4 premium-badge-holder">
                        <?php if($story->is_premium): ?>
                        <span class="badge badge-primary premium-badge">PREMIUM</span>
                        <?php endif; ?>
                        <?php if($story->image_url ): ?>
                        <img src="<?php echo e($story->image_url); ?>" />
                        <?php else: ?>
                        <img src="/images/placeholder.png" />
                        <?php endif; ?>
                        <div class="card-body story-card-body">
                            <h5 class="card-title"><a href="/show-story/<?php echo e($story->id); ?>"><?php echo e($story->title); ?></a></h5>
                            <p class="card-text">By <a href="#"><?php echo e($story->author); ?></a></p>
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
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <?php echo e($stories->links()); ?>

                <?php else: ?>
                <p class="empty-response"> No Results for <?php echo e($search); ?></p>
                <?php endif; ?>
            </div>
        </div>
        <div class="col-md-3">
            <div class="d-flex flex-row col-md-12  ">
                <div class="col-md-12" id="category-drop">
                    <h6>POPULAR CATEGORIES</h6><br>
                    <a href="/categories/1">Fantasy</a><br>
                    <a href="/categories/4">Jokes</a><br>
                    <a href="/categories/2">Bedtime Stories</a><br>
                    <a href="/categories/3">Morning Stories</a>

                    <hr style="width:10%;">
                    <div class="searchContainer">
                        <i class="fa fa-search searchIcon"></i>
                        <?php echo Form::open(['route'=>['stories.search'],'method'=>'GET']); ?>

                        <input class="searchBox" type="search" style="height:30px; width: 100%;" name="search" placeholder="Search...">
                        <?php echo e(Form::close()); ?>

                        
                    </div>
                    <hr style="width:10%;">
                    <p>Sort By</p>
                    <div class="card" style="width: 15rem;">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"><a href="/categories/1/stories/sort/age" style="color:inherit;">Age </a> <i class="fas fa-graduation-cap icon-right"></i></li>
                            
                            <li class="list-group-item"><a href="/categories/2/stories/sort/recent" style="color:inherit;">Most Recent </a><i class="fas fa-tint icon-right"></i></li>
                        </ul>
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
            <div class="col-lg-4 col-md-12 col-sm-12 ">
                <img src="../../images/resources/bottom.jpg" alt="" />
            </div>


            <!--Content Column-->
            <div class="content-column col-lg-8 col-md-12 col-sm-12">
                <div class="applink">
                    <h4>Get up close with your child</h4>
                    <div class="text">The Kids Stories app is your go to app for free bedtime stories, fairy tales, poems and short stories for kids. Get in there and start reading!
                    </div>
                    <div class="buttons-box">
                        <a href="#" class="theme-btn wow slideInLeft" data-wow-delay="0ms" data-wow-duration="1500ms"><img src="../../images/icons/apple.png" alt="" /></a>
                        <a href="#" class="theme-btn wow slideInRight" data-wow-delay="0ms" data-wow-duration="1500ms"><img src="../../images/icons/playstore.png" alt="" /></a>
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

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/kelvin/HNG-5/CODE-TESTS/kidstories-main-repo/resources/views/searchlisting.blade.php ENDPATH**/ ?>