<?php $__env->startSection('PageHeader'); ?>
<?php echo e(__("general.updateCity")); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('PageLocation'); ?>
##parent-placeholder-beeb47ac6f60afc7d02ef05a32eb9384e933fbd3##

<li>
    <a href="<?php echo e(url('/admin/cities')); ?>">
        <?php echo e(__("general.Cities")); ?>

    </a>
</li>
<li>
    <a href="#">
        <?php echo e(__("general.updateCity")); ?>

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
                    <form action="<?php echo e(url('/admin/cities/' . $city->id)); ?>" enctype="multipart/form-data"  method="POST">
                        <div class="row">
                            <div class="col-sm-6">
                                <h6 class="txt-dark capitalize-font"><i class="zmdi zmdi-flag mr-10"></i><?php echo e(__("general.CityInformation")); ?></h6>
                                <hr class="light-grey-hr"/>
                                <?php echo e(method_field('PATCH')); ?>

                                <?php echo e(csrf_field()); ?>

                                <input type="hidden" value="<?php echo e($city->id); ?>" name="city_id">
                                <div class="form-body overflow-hide">
                                    <div class="form-group">
                                        <div class="checkbox checkbox-primary pr-10 pull-left">
                                            <input id="languageAvailability" value="1" name="is_active" type="checkbox" <?php if(old('is_active')): ?> checked <?php elseif($city->is_active == 1): ?> checked <?php endif; ?>>
                                            <label for="languageAvailability"> <?php echo e(__("general.available")); ?> </label>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>

                                    <div class="form-group <?php echo e($errors->has('city_name') ? ' has-error' : ''); ?>">
                                        <label class="control-label mb-10" for="exampleInputuname_01" ><?php echo e(__("general.city_name")); ?></label>
                                        <div class="input-group">

                                            <input type="text" maxlength="20" class="form-control " id="exampleInputuname_01" name="city_name" value=<?php if(old('city_name')): ?> "<?php echo e(old('city_name')); ?>" <?php else: ?> "<?php echo e($city->name); ?>" <?php endif; ?> required />
                                        </div>
                                        <?php if($errors->has('city_name')): ?>
                                        <span class="help-block">
                                            <strong><?php echo e($errors->first('city_name')); ?></strong>
                                        </span>
                                        <?php endif; ?>
                                    </div>
                                    <div class="form-group <?php echo e($errors->has('longitude') ? ' has-error' : ''); ?>">
                                        <label class="control-label mb-10" for="exampleInputuname_01" ><?php echo e(__("general.longitude")); ?></label>
                                        <div class="input-group">

                                            <input type="text" maxlength="20" class="form-control " id="exampleInputuname_01" name="longitude"  value=<?php if(old('longitude')): ?> "<?php echo e(old('longitude')); ?>" <?php else: ?> "<?php echo e($city->longitude); ?>" <?php endif; ?> required  />
                                        </div>
                                        <?php if($errors->has('longitude')): ?>
                                            <span class="help-block">
                                            <strong><?php echo e($errors->first('longitude')); ?></strong>
                                        </span>
                                        <?php endif; ?>
                                    </div>
                                    <div class="form-group <?php echo e($errors->has('latitudes') ? ' has-error' : ''); ?>">
                                        <label class="control-label mb-10" for="exampleInputuname_01" ><?php echo e(__("general.latitudes")); ?></label>
                                        <div class="input-group">

                                            <input type="text" maxlength="20" class="form-control " id="exampleInputuname_01"name="latitudes" value=<?php if(old('latitudes')): ?> "<?php echo e(old('latitudes')); ?>" <?php else: ?> "<?php echo e($city->latitudes); ?>" <?php endif; ?> required />
                                        </div>
                                        <?php if($errors->has('latitudes')): ?>
                                            <span class="help-block">
                                            <strong><?php echo e($errors->first('latitudes')); ?></strong>
                                        </span>
                                        <?php endif; ?>
                                    </div>
                                    <div class="form-group <?php echo e($errors->has('country_id') ? ' has-error' : ''); ?>">
                                        <label class="control-label mb-10"><?php echo e(__("general.Country")); ?></label>
                                        <select class="form-control select2" name="country_id" required>
                                            <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($country->id); ?>" <?php if(old('country_id')): ?> <?php if(old('country_id') == $country->id): ?> selected <?php endif; ?> <?php elseif( $city->country_id == $country->id ): ?> selected <?php endif; ?>><?php echo e($country->name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                        <?php if($errors->has('country_id')): ?>
                                        <span class="help-block">
                                            <strong><?php echo e($errors->first('country_id')); ?></strong>
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
                                        <div class="panel-heading">
                                            <?php echo e(__("general.Localization")); ?>

                                        </div>
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="form-body overflow-hide">
                                                        <div id="english-link" class="form-group <?php echo e($errors->has('en_name') ? ' has-error' : ''); ?>">
                                                            <label class="control-label mb-10" for="exampleInputuname_01" ><?php echo e(__("general.name_en")); ?></label>
                                                            <div class="input-group">

                                                                <input type="text" maxlength="20" class="form-control " id="exampleInputuname_01" name="en_name" value=<?php if(old('en_name')): ?> "<?php echo e(old('en_name')); ?>" <?php else: ?> "<?php echo e($city->translate('en')->name); ?>" <?php endif; ?> required   />
                                                            </div>
                                                            <?php if($errors->has('en_name')): ?>
                                                                <span class="help-block">
                                                                <strong><?php echo e($errors->first('en_name')); ?></strong>
                                                            </span>
                                                            <?php endif; ?>
                                                        </div>
                                                        <div id="arabic-link" class="form-group <?php echo e($errors->has('ar_name') ? ' has-error' : ''); ?>">
                                                            <label class="control-label mb-10" for="exampleInputuname_01" ><?php echo e(__("general.name_ar")); ?></label>
                                                            <div class="input-group">
                                                                <input type="text" maxlength="20" class="form-control " id="exampleInputuname_01" name="ar_name" value=<?php if(old('ar_name')): ?> "<?php echo e(old('ar_name')); ?>" <?php else: ?> "<?php echo e($city->translate('ar')->name); ?>" <?php endif; ?> required   />
                                                            </div>
                                                            <?php if($errors->has('name.')): ?>
                                                                <span class="help-block">
                                                                <strong><?php echo e($errors->first('ar_name')); ?></strong>
                                                            </span>
                                                            <?php endif; ?>
                                                        </div>

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
        $('#languagesTable').DataTable();

        /* Select2 Init*/
        $(".select2").select2();
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.adminlayout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>