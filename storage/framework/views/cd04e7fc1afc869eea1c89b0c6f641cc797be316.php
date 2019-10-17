<?php $__env->startSection('custom_css'); ?>
<style type="text/css">
    .truncate {
        overflow: hidden;white-space: nowrap;text-overflow: ellipsis;
    }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <?php echo $__env->make('admin.stories.partials.cards', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0"><?php echo e(__('Stories')); ?></h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="<?php echo e(route('admin.stories.create')); ?>" class="btn btn-sm btn-primary"><?php echo e(__('Add story')); ?></a>
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
                                    <th scope="col"><?php echo e(__('Title')); ?></th>
                                    <th scope="col"><?php echo e(__('Status')); ?></th>           
                                    <th scope="col"><?php echo e(__('Category')); ?></th>           
                                    <th scope="col"><?php echo e(__('Type')); ?></th>
                                    <th scope="col"><?php echo e(__('Posted By')); ?></th>
                                    <th scope="col"><?php echo e(__('Posted On')); ?></th>
                                    <th scope="col"></th>
                                </tr>                         
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $stories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $story): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <th scope="row" title="<?php echo e($story->title); ?>">
                                            <div class="truncate" style="max-width:260px;margin-bottom:5px;"><?php echo e($story->title); ?></div>
                                            <span class="text-muted" style="font-weight: 400;">By <?php echo e($story->author); ?></span>
                                        </th>
                                        <td>
                                            <span class="badge <?php echo e($story->status == 'Approved' ? 'badge-success' : 'badge-danger'); ?>">
                                                <?php echo e($story->status); ?>

                                            </span>
                                        </td>
                                         <td><?php echo e(ucfirst($story->category->name)); ?></td>
                                        <td>
                                            <span class="badge <?php echo e($story->subscription == 'Regular' ? 'badge-primary' : 'bg-yellow'); ?>">
                                                <?php echo e($story->subscription); ?>

                                            </span>
                                        </td>
                                        <td><?php echo e($story->user->fullname); ?></td>
                                        <td>
                                            <abbr title="<?php echo e($story->created_at->format('d-M-Y') . ' @ ' . $story->created_at->format('H:ia')); ?>">
                                                <?php echo e($story->created_at->diffForHumans()); ?>

                                            </abbr>
                                        </td>
        
                                        <td class="text-right">
                                            <div class="dropdown">
                                                <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                    
                                                    <form action="<?php echo e(route('admin.stories.destroy', $story->slug)); ?>" method="post">
                                                        <?php echo csrf_field(); ?>
                                                        <?php echo method_field('delete'); ?>
                                                        
                                                        <a class="dropdown-item" href="<?php echo e(route('admin.stories.show', $story->slug)); ?>"><?php echo e(__('Detail')); ?></a>
                                                        <a class="dropdown-item" href="<?php echo e(route('admin.stories.edit', $story->slug)); ?>"><?php echo e(__('Edit')); ?></a>
                                                        <button type="button" class="dropdown-item" onclick="confirm('<?php echo e(__("Are you sure you want to delete?")); ?>') ? this.parentElement.submit() : ''">
                                                            <?php echo e(__('Delete')); ?>

                                                        </button>
                                                    </form>                                                        
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
                                <?php echo e($stories->links()); ?>

                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <?php echo $__env->make('admin.layouts.footers.auth', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', ['title' => __('Manage Stories')], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/kelvin/HNG-5/CODE-TESTS/kidstories-main-repo/resources/views/admin/stories/index.blade.php ENDPATH**/ ?>