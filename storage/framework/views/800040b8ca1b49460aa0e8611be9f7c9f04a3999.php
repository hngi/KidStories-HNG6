<?php if(Auth::guard('admin')->check()): ?>
    <?php echo $__env->make('admin.layouts.navbars.navs.auth', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>
    
<?php if(!Auth::guard('admin')->check()): ?>
    <?php echo $__env->make('admin.layouts.navbars.navs.guest', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?><?php /**PATH /home/kelvin/HNG-5/CODE-TESTS/kidstories-main-repo/resources/views/admin/layouts/navbars/navbar.blade.php ENDPATH**/ ?>