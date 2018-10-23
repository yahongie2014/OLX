<?php $__env->startSection('PageHeader'); ?>
<?php echo e(__("general.Profile")); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('PageLocation'); ?>
##parent-placeholder-beeb47ac6f60afc7d02ef05a32eb9384e933fbd3##

<li>
    <a href="#">
        <?php echo e(__("general.Profile")); ?>

    </a>
</li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
##parent-placeholder-040f06fd774092478d450774f5ba30c5da78acc8##

<?php if($user->provider): ?>
<div class="row">
    <div class="col-md-12">
        <div class="panel-group accordion-struct" id="accordion_1" role="tablist" aria-multiselectable="true">
            <div class="panel panel-default">
                <div class="panel-heading activestate" role="tab" id="heading_1">
                    <a role="button" data-toggle="collapse" data-parent="#accordion_1" href="#collapse_1" aria-expanded="false"><?php echo e(__('general.ProviderPromoCode')); ?></a>
                </div>
                <div id="collapse_1" class="panel-collapse collapse " role="tabpanel">
                    <div class="panel-body pa-15">
                        <div class="form-wrap">
                            <div class="form-body">
                                <form action="<?php echo e(url('/admin/provider/' . $user->provider->id)); ?>" method="POST">
                                    <?php echo e(method_field('PATCH')); ?>

                                    <?php echo e(csrf_field()); ?>

                                    <input type="hidden" value="<?php echo e($user->provider->id); ?>" name="provider_id">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <!--<label class="control-label mb-10"><?php echo e(__("general.ProviderPromoCode")); ?> : </label>-->
                                                <?php if($user->provider->promo_code): ?>
                                                    <p class="text-success mb-10"><?php echo e($user->provider->promo_code); ?></p>
                                                <?php else: ?>
                                                    <p class="text-danger mb-10"><?php echo e(__("general.noProviderPromoCode")); ?></p>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <h6 class="txt-dark capitalize-font"><i class="zmdi zmdi-card-giftcard mr-10"></i><?php echo e(__("general.servicesTypesDiscounts")); ?></h6>
                                            <hr class="light-grey-hr"/>
                                            <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div class="col-md-3">
                                                <div class="form-group <?php echo e($errors->has('service.'. $service->id) ? ' has-error' : ''); ?>">
                                                    <label class="control-label mb-10" for="exampleInputuname_01" ><?php echo e($service->name); ?></label>
                                                    <div class="input-group">

                                                        <input type="text" maxlength="20" class="form-control " id="exampleInputuname_01" name="service[<?php echo e($service->id); ?>]" value=<?php if(isset($serviceDiscount[$service->id])): ?> "<?php echo e($serviceDiscount[$service->id]); ?>" <?php else: ?> 0  <?php endif; ?>  />
                                                        <div class="input-group-addon">
                                                            %
                                                        </div>
                                                    </div>
                                                    <?php if($errors->has('service.'. $service->id)): ?>
                                                    <span class="help-block">
                                                        <strong><?php echo e($errors->first('service.'. $service->id)); ?></strong>
                                                    </span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </div>
                                        <div class="col-md-12">
                                            <h6 class="txt-dark capitalize-font"><i class="fa fa-credit-card mr-10"></i><?php echo e(__("general.paymentTypesDiscounts")); ?></h6>
                                            <hr class="light-grey-hr"/>
                                            <?php $__currentLoopData = $paymentTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $paymentType): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div class="col-md-3">
                                                <div class="form-group <?php echo e($errors->has('paymentType.' . $paymentType->id) ? ' has-error' : ''); ?>">
                                                    <label class="control-label mb-10" for="exampleInputuname_01" ><?php echo e($paymentType->name); ?></label>
                                                    <div class="input-group">

                                                        <input type="text" maxlength="20" class="form-control " id="exampleInputuname_01" name="paymentType[<?php echo e($paymentType->id); ?>]" value=<?php if(isset($paymentTypesDiscount[$paymentType->id])): ?> "<?php echo e($paymentTypesDiscount[$paymentType->id]); ?>" <?php else: ?> 0  <?php endif; ?>  />
                                                        <div class="input-group-addon">
                                                            %
                                                        </div>
                                                    </div>
                                                    <?php if($errors->has('paymentType.' . $paymentType->id)): ?>
                                                    <span class="help-block">
                                                        <strong><?php echo e($errors->first('paymentType.' . $paymentType->id)); ?></strong>
                                                    </span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
<?php endif; ?>
<?php echo $__env->make('partials.user.show', ['user' => $user , 'loginType' => 1 ], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.adminlayout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>