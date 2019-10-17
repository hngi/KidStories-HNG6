<?php $__env->startSection('content'); ?>
<div class="favourites">
    <!-- Header with BG Image -->
    <div class="favourites_header d-flex justify-content-center align-items-center">
        <h1 class="text-white">Favorites</h1>
    </div>
    <div class="container mt-3">
        <!-- Breadcrumb -->
        <div class="links">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Favorites</li>
                </ol>
            </nav>
        </div>
        <!-- Stories List [Start] -->

        <div class="stories py-5">
            <h6 class="font-weight-bold">Sort by: Date Added</h6>
            <div class="row">
                <?php $__currentLoopData = $bookmarks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bookmark): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-md-3" id="bookmark-div-<?php echo e($bookmark->id); ?>">
                    <div class="card favorite_story_card mt-4">
                        <img src="<?php echo e($bookmark->image_url); ?>" class="card-img-top" alt="<?php echo e($bookmark->image_name); ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo e($bookmark->title); ?></h5>
                            <p class="card-text mb-1">by <span class="author"><?php echo e($bookmark->author); ?></span></p>
                            <hr>
                            <p class="card-text">For ages <?php echo e($bookmark->age_from); ?> - <?php echo e($bookmark->age_to); ?> years</p>
                        </div>
                        <div class="card-footer d-flex justify-content-between">
                            <div class="reactions">
                                <?php if($bookmark->reaction == 'dislike'): ?>
                                <i class="fa fa-thumbs-up fav-icon" style="margin-right:8px;margin-top:6px;" id="fav-like-<?php echo e($bookmark->id); ?>" onclick="react(event);" data-story-id="<?php echo e($bookmark->id); ?>"></i><small class="mr-3" id="likes-count-<?php echo e($bookmark->id); ?>"><?php echo e($bookmark->likes_count); ?></small>
                                <i class="fa fa-thumbs-down fav-icon fav-red" id="fav-dislike-<?php echo e($bookmark->id); ?>" onclick="react(event);" data-story-id="<?php echo e($bookmark->id); ?>" style="margin-top:10px; margin-right:10px;margin-left:10px;"></i><small id="dislikes-count-<?php echo e($bookmark->id); ?>"><?php echo e($bookmark->dislikes_count); ?></small>
                                <?php elseif($bookmark->reaction == 'like'): ?>
                                <i class="fa fa-thumbs-up fav-icon fav-green" style="margin-right:8px;margin-top:6px;" id="fav-like-<?php echo e($bookmark->id); ?>" onclick="react(event);" data-story-id="<?php echo e($bookmark->id); ?>"></i><small class="mr-3" id="likes-count-<?php echo e($bookmark->id); ?>"><?php echo e($bookmark->likes_count); ?></small>
                                <i class="fa fa-thumbs-down fav-icon " id="fav-dislike-<?php echo e($bookmark->id); ?>" onclick="react(event);" data-story-id="<?php echo e($bookmark->id); ?>" style="margin-top:10px; margin-right:10px;margin-left:10px;"></i><small id="dislikes-count-<?php echo e($bookmark->id); ?>"><?php echo e($bookmark->dislikes_count); ?></small>
                                <?php else: ?>
                                <i class="fa fa-thumbs-up fav-icon" style="margin-right:8px;margin-top:6px;" id="fav-like-<?php echo e($bookmark->id); ?>" onclick="react(event);" data-story-id="<?php echo e($bookmark->id); ?>"></i><small class="mr-3" id="likes-count-<?php echo e($bookmark->id); ?>"><?php echo e($bookmark->likes_count); ?></small>
                                <i class="fa fa-thumbs-down fav-icon" id="fav-dislike-<?php echo e($bookmark->id); ?>" onclick="react(event);" data-story-id="<?php echo e($bookmark->id); ?>" style="margin-top:10px; margin-right:10px;margin-left:10px;"></i><small id="dislikes-count-<?php echo e($bookmark->id); ?>"><?php echo e($bookmark->dislikes_count); ?></small>
                                <?php endif; ?>
                            </div>
                            <div class="bookmark">
                                <a> <i class="fa fa-bookmark fav-icon bookmark-blue" style="margin-left: 8px" onclick="bookmark(event);" id="bookmark-<?php echo e($bookmark->id); ?>" data-story-id="<?php echo e($bookmark->id); ?>" data-fav-id = "<?php echo e($bookmark->id); ?>"></i> </a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>
    <!-- Stories List [End] -->
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/kelvin/HNG-5/CODE-TESTS/kidstories-main-repo/resources/views/bookmark.blade.php ENDPATH**/ ?>