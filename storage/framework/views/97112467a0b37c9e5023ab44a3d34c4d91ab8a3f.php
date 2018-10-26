<?php $__env->startSection('PageHeader'); ?>
<?php echo e(__("general.Categories")); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('PageLocation'); ?>
##parent-placeholder-beeb47ac6f60afc7d02ef05a32eb9384e933fbd3##

<li>
    <a href="<?php echo e(url('/admin/categories')); ?>">
        <?php echo e(__("general.Categories")); ?>

    </a>
</li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
##parent-placeholder-040f06fd774092478d450774f5ba30c5da78acc8##
<!-- Row -->
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-default card-view">
            <div class="panel-wrapper collapse in">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-sm-4">
                            <a href="<?php echo e(url('/admin/categories/create')); ?>" >
                                <button class="btn btn-success btn-block btn-rounded btn-outline  btn-success">
                                    <?php echo e(__("general.addNewCategory")); ?>

                                </button>
                            </a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="table-wrap">
                            <div class="table-responsive">
                                <table class="table display responsive product-overview mb-30" id="categoriesTable">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th><?php echo e(__("general.category_id")); ?></th>
                                        <th><?php echo e(__("general.Name")); ?></th>
                                        <th><?php echo e(__("general.Service")); ?></th>
                                        <th><?php echo e(__("general.Status")); ?></th>
                                        <th><?php echo e(__("general.Edit")); ?></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td class="txt-dark centerCol"><?php echo e($loop->iteration); ?></td>
                                        <td class="txt-dark centerCol"><?php echo e($category->id); ?></td>
                                        <td class="txt-dark centerCol"><?php echo e($category->name); ?></td>
                                        <td class="txt-dark centerCol">
                                            <img src="<?php echo e(asset(\Storage::url('Services/'.$category->icon))); ?>" style="width: 11%;height: 5%;"/>
                                        </td>

                                        <td class="centerCol">
                                            <?php if($category->is_active == CATEGORY_ACTIVE): ?>
                                                <span class="label label-success font-weight-100"><?php echo e(__("general.active")); ?></span>
                                            <?php else: ?>
                                                <span class="label label-danger font-weight-100"><?php echo e(__("general.inactive")); ?></span>
                                            <?php endif; ?>

                                        </td>

                                        <td class="centerCol">
                                            <a href="<?php echo e(url('admin/categories/' . $category->id . '/edit/')); ?>" class="text-inverse pr-10" title="Edit" data-toggle="tooltip">
                                                <i class="zmdi zmdi-edit txt-danger"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<!-- /Row -->
<?php $__env->startSection('footer'); ?>
##parent-placeholder-d7eb6b340a11a367a1bec55e4a421d949214759f##
<script>
    $(document).ready(function(){
        "use strict";
        $('#categoriesTable').DataTable();
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.adminlayout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>