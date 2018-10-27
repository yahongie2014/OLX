<?php $__env->startSection('PageHeader'); ?>
<?php echo e(__("general.editLanguage")); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('PageLocation'); ?>
##parent-placeholder-beeb47ac6f60afc7d02ef05a32eb9384e933fbd3##

<li>
    <a href="<?php echo e(url('/admin/languages')); ?>">
        <?php echo e(__("general.Languages")); ?>

    </a>
</li>
<li>
    <a href="#">
        <?php echo e(__("general.editLanguage")); ?>

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
                        <div class="col-sm-12">
                            <h6 class="txt-dark capitalize-font"><i class="zmdi zmdi-translate mr-10"></i><?php echo e(__("general.LanguageInformation")); ?></h6>
                            <hr class="light-grey-hr"/>
                            <form action="<?php echo e(url('/admin/languages/' . $language->id)); ?>" enctype="multipart/form-data"  method="POST">
                                <?php echo e(method_field('PATCH')); ?>

                                <?php echo e(csrf_field()); ?>

                                <input type="hidden" name="language_id" value="<?php echo e($language->id); ?>"/>
                                <div class="form-body overflow-hide">
                                    <div class="form-group">
                                        <div class="checkbox checkbox-primary pr-10 pull-left">
                                            <input id="languageAvailability" value="1" name="languageAvailability" type="checkbox" <?php if(old('languageAvailability')): ?> checked <?php elseif($language->status == LANGUAGE_ACTIVE): ?>  checked <?php endif; ?>>
                                            <label for="languageAvailability"> <?php echo e(__("general.available")); ?> </label>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                    <!--<div class="form-group">
                                        <div class="checkbox checkbox-primary pr-10 pull-left">
                                            <input id="languageDefault"  value="1" name="languageDefault" type="checkbox" <?php if(old('languageDefault')): ?> checked <?php elseif($language->default == DEFAULT_LANGUAGE): ?> <?php endif; ?> >
                                            <label for="languageDefault"> <?php echo e(__("general.defaultLanguage")); ?> </label>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>-->

                                    <div class="form-group <?php echo e($errors->has('language_name') ? ' has-error' : ''); ?>">
                                        <label class="control-label mb-10" for="exampleInputuname_01" ><?php echo e(__("general.language_name")); ?></label>
                                        <div class="input-group">

                                            <input type="text" class="form-control " id="exampleInputuname_01" name="language_name" value=<?php if(old('language_name')): ?> "<?php echo e(old('language_name')); ?>" <?php else: ?> "<?php echo e($language->name); ?>" <?php endif; ?> required />
                                        </div>
                                        <?php if($errors->has('language_name')): ?>
                                        <span class="help-block">
                                            <strong><?php echo e($errors->first('language_name')); ?></strong>
                                        </span>
                                        <?php endif; ?>
                                    </div>
                                    <div class="form-group <?php echo e($errors->has('language_symbol') ? ' has-error' : ''); ?>">
                                        <label class="control-label mb-10" for="exampleInputuname_01"><?php echo e(__("general.language_symbol")); ?></label>
                                        <div class="input-group">

                                            <input type="text" maxlength="2" class="form-control " id="exampleInputuname_01" name="language_symbol" value=<?php if(old('language_symbol')): ?> "<?php echo e(old('language_symbol')); ?>" <?php else: ?> "<?php echo e($language->symbol); ?>" <?php endif; ?> required />
                                        </div>
                                        <?php if($errors->has('language_symbol')): ?>
                                        <span class="help-block">
                                            <strong><?php echo e($errors->first('language_symbol')); ?></strong>
                                        </span>
                                        <?php endif; ?>
                                    </div>
                                    <div class="form-group <?php echo e($errors->has('language_direction') ? ' has-error' : ''); ?>">
                                        <div class="radio-list">
                                            <label class="control-label mb-10"> <?php echo e(__("general.languageDirection")); ?> </label>
                                            <div class="radio-inline pl-0">
                                                <span class="radio radio-success">
                                                    <input type="radio" name="language_direction" id="radio_5" value="ltr" <?php if($language->direction == 'ltr'): ?> checked <?php endif; ?>>
                                                    <label for="radio_5"><?php echo e(__("general.ltr")); ?></label>
                                                </span>
                                            </div>
                                            <div class="radio-inline">
                                                <span class="radio radio-success">
                                                    <input type="radio" name="language_direction" id="radio_6" value="rtl" <?php if($language->direction == 'rtl'): ?> checked <?php endif; ?>>
                                                    <label for="radio_6"><?php echo e(__("general.rtl")); ?></label>
                                                </span>
                                            </div>
                                            <?php if($errors->has('language_direction')): ?>
                                            <span class="help-block">
                                                <strong><?php echo e($errors->first('language_direction')); ?></strong>
                                            </span>
                                            <?php endif; ?>
                                        </div>
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