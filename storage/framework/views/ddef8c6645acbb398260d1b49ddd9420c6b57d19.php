<?php $__env->startSection('PageHeader'); ?>
<?php echo e(__("general.updateCategory")); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('PageLocation'); ?>
##parent-placeholder-beeb47ac6f60afc7d02ef05a32eb9384e933fbd3##

<li>
    <a href="<?php echo e(url('/admin/categories')); ?>">
        <?php echo e(__("general.Categories")); ?>

    </a>
</li>
<li>
    <a href="#">
        <?php echo e(__("general.updateCategory")); ?>

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
                    <form action="<?php echo e(url('/admin/categories/' . $category->id)); ?>" enctype="multipart/form-data"  method="POST">
                        <div class="row">
                            <div class="col-sm-6">
                                <h6 class="txt-dark capitalize-font"><i class="zmdi zmdi-account mr-10"></i><?php echo e(__("general.CategoryInformation")); ?></h6>
                                <hr class="light-grey-hr"/>
                                <?php echo e(method_field('PATCH')); ?>

                                <?php echo e(csrf_field()); ?>

                                <input type="hidden" value="<?php echo e($category->id); ?>" name="category_id">
                                <div class="form-body overflow-hide">
                                    <div class="form-group">
                                        <div class="checkbox checkbox-primary pr-10 pull-left">
                                            <input id="languageAvailability" value="1" name="is_active" type="checkbox" <?php if(old('is_active')): ?> checked <?php elseif($category->is_active == CATEGORY_ACTIVE): ?> checked <?php endif; ?>>
                                            <label for="languageAvailability"> <?php echo e(__("general.available")); ?> </label>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>

                                </div>
                                <div class="form-group <?php echo e($errors->has('longitude') ? ' has-error' : ''); ?>">
                                    <label class="control-label mb-10" for="exampleInputuname_01" ><?php echo e(__("general.longitude")); ?></label>
                                    <div class="input-group">

                                        <input type="text" maxlength="20" class="form-control " id="exampleInputuname_01" name="longitude" value="<?php echo e($category->longitude); ?>" required />
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

                                        <input type="text" maxlength="20" class="form-control " id="exampleInputuname_01"name="latitudes"  value="<?php echo e($category->latitudes); ?>" required />
                                    </div>
                                    <?php if($errors->has('latitudes')): ?>
                                        <span class="help-block">
                                            <strong><?php echo e($errors->first('latitudes')); ?></strong>
                                        </span>
                                    <?php endif; ?>
                                </div>

                                <div class="form-group <?php echo e($errors->has('icon') ? ' has-error' : ''); ?>">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <div class="mt-40">
                                                <input type="file"
                                                       name="icon"
                                                       id="icon"
                                                       class="dropify"
                                                       data-default-file="<?php echo e(asset(\Storage::url('Services/'.$category->icon))); ?>"
                                                       accept=".jpg,.jpeg,.png" />
                                            </div>
                                            <?php if($errors->has('icon')): ?>
                                                <span class="help-block"
                                                      style="color : red">
                                                <strong><?php echo e($errors->first('icon')); ?></strong>
                                            </span>
                                            <?php endif; ?>

                                            <label class="control-label mb-10" for="exampleInputuname_01"><?php echo e(__("general.Service")); ?></label>
                                        </div>
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

                                                                <input type="text" maxlength="20" class="form-control " id="exampleInputuname_01" name="en_name" value=<?php if(old('en_name')): ?> "<?php echo e(old('en_name')); ?>" <?php else: ?> "<?php echo e($category->translate('en')->name); ?>" <?php endif; ?> required   />
                                                            </div>
                                                            <?php if($errors->has('en_name')): ?>
                                                                <span class="help-block">
                                                                <strong><?php echo e($errors->first('en_name')); ?></strong>
                                                            </span>
                                                            <?php endif; ?>
                                                        </div>
                                                        <div id="english-link"
                                                             class="form-group <?php echo e($errors->has('en_desc') ? ' has-error' : ''); ?>">
                                                            <label class="control-label mb-10"
                                                                   for="exampleInputuname_01"><?php echo e(__("general.en_desc")); ?></label>
                                                            <div class="input-group">

                                                                <textarea class="form-control"
                                                                          id="exampleInputuname_01" name="en_desc"
                                                                          value="<?php echo e(old('en_desc')); ?>"><?php echo e($category->translate("en")->desc); ?></textarea>

                                                            </div>
                                                            <?php if($errors->has('en_desc')): ?>
                                                                <span class="help-block">
                                                                <strong><?php echo e($errors->first('en_desc')); ?></strong>
                                                            </span>
                                                            <?php endif; ?>
                                                        </div>

                                                        <div id="arabic-link" class="form-group <?php echo e($errors->has('ar_name') ? ' has-error' : ''); ?>">
                                                            <label class="control-label mb-10" for="exampleInputuname_01" ><?php echo e(__("general.name_ar")); ?></label>
                                                            <div class="input-group">
                                                                <input type="text" maxlength="20" class="form-control " id="exampleInputuname_01" name="ar_name" value=<?php if(old('ar_name')): ?> "<?php echo e(old('ar_name')); ?>" <?php else: ?> "<?php echo e($category->translate('ar')->name); ?>"  <?php endif; ?> required   />
                                                            </div>
                                                            <?php if($errors->has('name.')): ?>
                                                                <span class="help-block">
                                                                <strong><?php echo e($errors->first('ar_name')); ?></strong>
                                                            </span>
                                                            <?php endif; ?>
                                                        </div>
                                                        <div id="arabic-link"
                                                             class="form-group <?php echo e($errors->has('ar_desc') ? ' has-error' : ''); ?>">
                                                            <label class="control-label mb-10"
                                                                   for="exampleInputuname_01"><?php echo e(__("general.ar_desc")); ?></label>
                                                            <div class="input-group">

                                                                <textarea class="form-control"
                                                                          id="exampleInputuname_01" name="ar_desc"
                                                                          value="<?php echo e(old('ar_desc')); ?>"><?php echo e($category->translate("ar")->desc); ?></textarea>

                                                            </div>
                                                            <?php if($errors->has('ar_desc')): ?>
                                                                <span class="help-block">
                                                                <strong><?php echo e($errors->first('ar_desc')); ?></strong>
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



                        </div>
                        <div class="row">
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
        $('.dropify').dropify();

    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.adminlayout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>