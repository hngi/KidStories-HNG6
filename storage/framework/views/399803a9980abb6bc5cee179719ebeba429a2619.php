<?php $__env->startSection('content'); ?>
    
    <?php echo $__env->make('admin.users.partials.cards', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0"><?php echo e(__('Users')); ?></h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="<?php echo e(route('admin.user.create')); ?>" class="btn btn-sm btn-primary"><?php echo e(__('Add user')); ?></a>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-12">
                        <?php if(session('status')): ?>
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <?php echo e(session('status')); ?>

                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col"><?php echo e(__('Name')); ?></th>
                                    <th scope="col"><?php echo e(__('Contact')); ?></th>
                                    <th scope="col"><?php echo e(__('Stories')); ?></th>
                                    <th scope="col"><?php echo e(__('Image')); ?></th>
                                    <th scope="col"><?php echo e(__('Joined')); ?></th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td>
                                            <?php echo e($user->fullname); ?>

                                            <?php if($user->subscriptions->count() > 0): ?>
                                            <sup><i class="fa fa-star" style="color:yellow;font-size: 10px;"></i></sup>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <a href="mailto:<?php echo e($user->email); ?>"><?php echo e($user->email); ?></a> <br>
                                            <a href="tel:<?php echo e($user->phone); ?>" class="text-muted"><?php echo e($user->phone); ?></a>
                                        </td>
                                        <td>
                                            <?php echo e($count = $user->stories->count()); ?>

                                            <?php echo e(str_plural('story', $count)); ?>

                                        </td>
                                        <td>
                                            <?php if($user->image_url): ?>
                                                <a href="<?php echo e($user->image_url); ?>" target="_blank">View image</a>
                                            <?php else: ?>
                                                <span>No image yet</span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php echo e($user->created_at->format('d F, Y')); ?> <br>
                                            <?php echo e($user->created_at->format('h:ia')); ?>

                                        </td>
                                        <td class="text-right">
                                            <div class="dropdown">
                                                <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                    <?php if($user->id != auth()->id()): ?>
                                                        <form action="<?php echo e(route('admin.user.destroy', $user)); ?>" method="post">
                                                            <?php echo csrf_field(); ?>
                                                            <?php echo method_field('delete'); ?>
                                                            
                                                            <a class="dropdown-item" href="<?php echo e(route('admin.user.edit', $user)); ?>"><?php echo e(__('Edit')); ?></a>
                                                            <button type="button" class="dropdown-item" onclick="confirm('<?php echo e(__("Are you sure you want to delete this user?")); ?>') ? this.parentElement.submit() : ''">
                                                                <?php echo e(__('Delete')); ?>

                                                            </button>
                                                        </form>    
                                                    <?php else: ?>
                                                        <a class="dropdown-item" href="<?php echo e(route('admin.profile.edit')); ?>"><?php echo e(__('Edit')); ?></a>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer py-4">
                        <nav class="d-flex justify-content-end" aria-label="...">
                            <?php echo e($users->links()); ?>

                        </nav>
                    </div>
                </div>
            </div>
        </div>
            
        <?php echo $__env->make('admin.layouts.footers.auth', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', ['title' => __('User Management')], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/kelvin/HNG-5/CODE-TESTS/kidstories-main-repo/resources/views/admin/users/index.blade.php ENDPATH**/ ?>