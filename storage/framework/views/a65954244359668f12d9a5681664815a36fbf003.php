<?php $__env->startSection('custom_css'); ?>
<link href="<?php echo e(asset('css/storieslisting.css')); ?>" rel="stylesheet" type="text/css" >
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
   <div class="container crumb">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb arr-right ">
          <li class="breadcrumb-item"><a href="<?php echo e(route('homepage')); ?>">Home</a></li>
          <li class="breadcrumb-item active"><a href="#">Stories</a></li>
        </ol>
      </nav>

    <h1><?php echo e($category->name); ?> Category Story Listing</h1>
  </div>
   <div class="container">
      <div class="row">
        <div class="col-md-9">
      <div class="row">
      <?php if(count($stories) > 0): ?>
           <?php $__currentLoopData = $stories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $story): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <div class="col-md-4">
            <div class="card mb-4 shadow-sm">
            <img src="https://i.imgur.com/7OBNw1t.jpg" class="card-img-top" alt="...">
            <div class="card-body">
              <h5 class="card-title"><a href="/story/<?php echo e($story->id); ?>"><?php echo e($story->title); ?></a></h5>
              <p class="card-text">By <a href="#"><?php echo e($story->author); ?></a></p>
              <hr style="margin:0 -5px;">
              <p>For Kids <?php echo e($story->age_from .' to '. $story->age_to); ?> years</p>
              <hr style="margin:0 -20px;">
              <div class="d-flex justify-content-between align-items-center card-">
                <div class="btn-group">

                <i class="fas fa-thumbs-up" style="margin-right:8px;margin-top:6px;"></i> <?php echo e($story->likes_count); ?>

                <i class="fas fa-thumbs-down" style="margin-top:10px; margin-right:10px;margin-left:10px;" ></i><?php echo e($story->dislikes_count); ?>

                </div>
                <span class="verticalLine">
            <i class="far fa-bookmark" style="margin-left: 8px;"></i>
          </span>

              </div>
            </div>
          </div>
        </div>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      <?php else: ?>
          <p> Oops There are no Stories in this category</p>
      <?php endif; ?>
     
            

</div>

</div>
<div class="">
  
    <span class="verticalLine" id="line" style="border-bottom-width:500px; border-bottom-style:solid;"  >
      <p></p>

</span>
</div>

   <div class="col-md-2" id="category-drop">
      <h4>POPULAR CATEGORIES</h4>
      <a href="/categories/1">Fantasy</a><br>
      <a href="/categories/4">Jokes</a><br>
      <a href="/categories/2">Bedtime Stories</a><br>
      <a href="/categories/3">Morning Stories</a>
      
      
  <div class="searchContainer" >
  <i class="fa fa-search searchIcon"></i>
  <input class="searchBox" type="search" style="height:30px; width: 100%;" name="search" placeholder="Search...">
</div>
<hr style="width:10%;">
<p>Sort By</p>
<div class="card" style="width: 15rem;">
  <ul class="list-group list-group-flush">
    <li class="list-group-item"><a href="/categories/<?php echo e($category->id); ?>/stories/filter/age">Age </a> <i class="fas fa-graduation-cap icon-right"></i></li>
    
    <li class="list-group-item"><a href="/categories/<?php echo e($category->id); ?>/stories/filter/recent">Most Recent </a><i class="fas fa-tint icon-right"></i></li>
  </ul>
</div>

    </div>
  </div>
</div>


  
<div class="container" style="margin-top:100px;"> 
<div class=" mb-3" style="max-width:auto;">
  <div class="row no-gutters">
    <div class="col-md-4">
      <img src="https://i.imgur.com/pN55hZ9.png" class="card-img" alt="...">
    </div>
    <div class="col-md-8">
      <div class="card-body">
        <h5 class="card-title" id='quote' style="float: center;">Get Up Close With Your Child</h5>
        <p class="card-text" style="">Read free bedtime stories, fairy tales, poems and short stories for kids</p>
      
        <div>
          <a href="#"><img src="https://www.neoncrm.com/wp-content/uploads/2017/06/appstore.png" width="200px" height="80px"></a>
        <a href="#"><img src="https://play.google.com/intl/en_us/badges/images/generic/en_badge_web_generic.png" width="200px" height="100px"></a>
        </div>


        
      </div>
    </div>
  </div>
</div>
</div>


    <!-- Footer goes here -->
    <!--Scroll to top-->
    <div class="scroll-to-top scroll-to-target" data-target="html"><span class="icon fa fa-angle-double-up"></span></div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/kelvin/HNG-5/CODE-TESTS/kidstories-main-repo/resources/views/filteredlisting.blade.php ENDPATH**/ ?>