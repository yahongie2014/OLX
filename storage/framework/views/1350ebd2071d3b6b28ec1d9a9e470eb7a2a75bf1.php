<?php $__env->startSection('PageHeader'); ?>
<?php echo e(__("general.Languages")); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('PageLocation'); ?>
##parent-placeholder-beeb47ac6f60afc7d02ef05a32eb9384e933fbd3##

<li>
    <a href="<?php echo e(url('/admin/languages')); ?>">
        <?php echo e(__("general.Languages")); ?>

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
                            <a href="<?php echo e(url('/admin/languages/create')); ?>" >
                                <button class="btn btn-success btn-block btn-rounded btn-outline  btn-success">
                                    <?php echo e(__("general.addNewLanguage")); ?>

                                </button>
                            </a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="table-wrap">
                            <div class="table-responsive">
                                <table class="table display responsive product-overview mb-30" id="languagesTable">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th><?php echo e(__("general.language_id")); ?></th>
                                        <th><?php echo e(__("general.Name")); ?></th>
                                        <th><?php echo e(__("general.Status")); ?></th>

                                        <th><?php echo e(__("general.Edit")); ?></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $__currentLoopData = $languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td class="txt-dark centerCol"><?php echo e($loop->iteration); ?></td>
                                        <td class="txt-dark centerCol"><?php echo e($language->id); ?></td>
                                        <td class="txt-dark centerCol"><?php echo e($language->name); ?></td>
                                        <td class="centerCol">
                                            <?php if($language->status == LANGUAGE_ACTIVE): ?>
                                                <span class="label label-success font-weight-100"><?php echo e(__("general.active")); ?></span>
                                            <?php else: ?>
                                                <span class="label label-danger font-weight-100"><?php echo e(__("general.inactive")); ?></span>
                                            <?php endif; ?>

                                            <?php if($language->default == DEFAULT_LANGUAGE): ?>
                                            <span class="label label-primary font-weight-100"><?php echo e(__("general.defaultLanguage")); ?></span>
                                            <?php endif; ?>
                                        </td>

                                        <td class="centerCol">
                                            <a href="<?php echo e(url('admin/languages/' . $language->id . '/edit/')); ?>" class="text-inverse pr-10" title="Edit" data-toggle="tooltip">
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
        $('#languagesTable').DataTable();
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.adminlayout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>