<?php $__env->startSection('PageHeader'); ?>
<?php echo e(__("general.updateCountry")); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('PageLocation'); ?>
##parent-placeholder-beeb47ac6f60afc7d02ef05a32eb9384e933fbd3##

<li>
    <a href="<?php echo e(url('/admin/countries')); ?>">
        <?php echo e(__("general.Countries")); ?>

    </a>
</li>
<li>
    <a href="#">
        <?php echo e(__("general.updateCountry")); ?>

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
                    <form action="<?php echo e(url('/admin/countries/' . $country->id)); ?>" enctype="multipart/form-data"  method="POST">
                        <div class="row">
                            <div class="col-sm-6">
                                <h6 class="txt-dark capitalize-font"><i class="zmdi zmdi-flag mr-10"></i><?php echo e(__("general.CountryInformation")); ?></h6>
                                <hr class="light-grey-hr"/>
                                <?php echo e(method_field('PATCH')); ?>

                                <?php echo e(csrf_field()); ?>

                                <input type="hidden" value="<?php echo e($country->id); ?>" name="country_id">
                                <div class="form-body overflow-hide">
                                    <div class="checkbox checkbox-primary pr-10 pull-left">
                                        <input id="languageAvailability" value="1" name="status" type="checkbox" <?php if(old('is_active')): ?> checked <?php elseif($country->is_active == COUNTRY_ACTIVE): ?> checked <?php endif; ?>>
                                        <label for="languageAvailability"> <?php echo e(__("general.available")); ?> </label>
                                    </div>
                                    <div class="clearfix"></div>

                                    <div class="form-group <?php echo e($errors->has('country_name') ? ' has-error' : ''); ?>">
                                        <label class="control-label mb-10" for="exampleInputuname_01" ><?php echo e(__("general.country_name")); ?></label>

                                            <input type="text" maxlength="20" class="form-control " id="exampleInputuname_01" name="country_name" value=<?php if(old('country_name')): ?> "<?php echo e(old('country_name')); ?>" <?php else: ?> "<?php echo e($country->name); ?>" <?php endif; ?> required />

                                        <?php if($errors->has('country_name')): ?>
                                        <span class="help-block">
                                            <strong><?php echo e($errors->first('country_name')); ?></strong>
                                        </span>
                                        <?php endif; ?>
                                    </div>
                                    <div class="form-group <?php echo e($errors->has('code') ? ' has-error' : ''); ?>">
                                        <label class="control-label mb-10" for="exampleInputuname_01"><?php echo e(__("general.code")); ?></label>


                                            <input type="text" maxlength="5" class="form-control allownumericwithoutdecimal" id="exampleInputuname_01" name="code" value=<?php if(old('code')): ?> "<?php echo e(old('code')); ?>" <?php else: ?> "<?php echo e($country->code); ?>" <?php endif; ?> required />

                                        <?php if($errors->has('code')): ?>
                                        <span class="help-block">
                                            <strong><?php echo e($errors->first('code')); ?></strong>
                                        </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6 col-mx-auto">
                                <h6 class="txt-dark capitalize-font"><i class="zmdi zmdi-translate mr-10"></i><?php echo e(__("general.Localization")); ?></h6>
                                <hr class="light-grey-hr"/>
                                <div class="panel panel-default card-view">
                                    <div class="panel-wrapper collapse in">

                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="form-body overflow-hide">
                                                        <?php $__currentLoopData = $languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <div class="form-group <?php echo e($errors->has('language.'. $language->id) ? ' has-error' : ''); ?>">
                                                            <label class="control-label mb-10" for="exampleInputuname_01" ><?php echo e($language->name); ?></label>
                                                            <div class="input-group">

                                                                <input type="text" maxlength="20" class="form-control " id="exampleInputuname_01" name="language[<?php echo e($language->id); ?>]" value=<?php if(old('language.'. $language->id)): ?> <?php echo e(old('language.'. $language->id)); ?> <?php elseif(isset($countryLanguages[$language->id])): ?> "<?php echo e($countryLanguages[$language->id]->pivot->name); ?>" <?php else: ?> ""  <?php endif; ?>  />
                                                            </div>
                                                            <?php if($errors->has('language.'. $language->id)): ?>
                                                            <span class="help-block">
                                                                <strong><?php echo e($errors->first('language.'. $language->id)); ?></strong>
                                                            </span>
                                                            <?php endif; ?>
                                                        </div>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-actions mt-10">
                                <button type="submit" class="btn btn-success mr-10 mb-30"><?php echo e(__('general.Save')); ?></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">

</div>

<?php $__env->stopSection(); ?>

<!-- /Row -->
<?php $__env->startSection('footer'); ?>
##parent-placeholder-d7eb6b340a11a367a1bec55e4a421d949214759f##
<script>
    $(document).ready(function(){
        "use strict";
        /* Select2 Init*/
        $(".select2").select2();
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.adminlayout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>