<?php $__env->startSection('PageHeader'); ?>
<?php echo e(__("general.Create_New_Admin")); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('PageLocation'); ?>
##parent-placeholder-beeb47ac6f60afc7d02ef05a32eb9384e933fbd3##

<li>
    <a href="#">
        <?php echo e(__("general.Create_New_Admin")); ?>

    </a>
</li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
##parent-placeholder-040f06fd774092478d450774f5ba30c5da78acc8##

<div class="row">
    <div class="col-md-12">
        <div class="panel-group accordion-struct" id="accordion_1" role="tablist" aria-multiselectable="true">
            <div class="panel panel-default">
                <div class="panel-heading activestate" role="tab" id="heading_1">
                    <a role="button" data-toggle="collapse" data-parent="#accordion_1" href="#collapse_1" aria-expanded="false"><?php echo e(__('general.Create_New_Admin')); ?></a>
                </div>
                <div id="collapse_1" class="panel-collapse collapse " role="tabpanel">
                    <div class="panel-body pa-15">
                        <div class="form-wrap">
                            <div class="form-body">
                                <form action="<?php echo e(url('/admin/users/admin/' . $user->id)); ?>" method="POST">
                                    <?php echo e(method_field('PATCH')); ?>

                                    <?php echo e(csrf_field()); ?>

                                    <input type="hidden" value="<?php echo e($user->id); ?>" name="provider_id">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h6 class="txt-dark capitalize-font"><i class="fa fa-credit-card mr-10"></i><?php echo e(__("general.paymentTypesDiscounts")); ?></h6>
                                            <hr class="light-grey-hr"/>
                                        </div>
                                    </div>
                                    <div class="form-actions mt-10">
                                        <button type="submit" class="btn btn-success mr-10 mb-30"><?php echo e(__('general.Save')); ?></button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php echo $__env->make('partials.admin.show', ['user' => $user , 'loginType' => 1 ], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.adminlayout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>