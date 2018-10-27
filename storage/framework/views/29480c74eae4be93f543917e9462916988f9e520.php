<div class="container-fluid pt-25">
    <?php if($errors->any()): ?>
        <div class="alert alert-danger alert-dismissable alert-style-1">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <i class="zmdi zmdi-alert-circle-o"></i><?php echo e(__("general.error check fields")); ?>

        </div>
<?php endif; ?>
<!-- Row -->
    <div class="row">
        <div class="col-lg-9 col-xs-12">
            <div class="panel panel-default card-view pa-0">
                <div class="panel-wrapper collapse in">
                    <div class="panel-body pb-0">
                        <div class="tab-struct custom-tab-1">
                            <ul role="tablist" class="nav nav-tabs nav-tabs-responsive" id="myTabs_8">
                                <li class="active" role="presentation">
                                    <a data-toggle="tab" id="profile_tab_8" role="tab" href="#profile_8"
                                       aria-expanded="false">
                                        <span><?php echo e(__("general.Profile")); ?></span>
                                    </a>
                                </li>
                            </ul>
                            <div class="tab-content" id="myTabContent_8">
                                <div id="profile_8" class="tab-pane fade active in" role="tabpanel">
                                    <!-- Row -->
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="">
                                                <div class="panel-wrapper collapse in">
                                                    <div class="panel-body pa-0">
                                                        <div class="col-sm-12 col-xs-12">
                                                            <div class="form-wrap">
                                                                <form method="POST"
                                                                      action="<?php echo e(url('admin/users/admin/')); ?>">
                                                                    <?php echo e(csrf_field()); ?>

                                                                    <div class="form-group <?php echo e($errors->has('name') ? ' has-error' : ''); ?> ">
                                                                        <label class="control-label mb-10 brand-text-white"
                                                                               for="exampleInputName_1"><?php echo e(__("general.Full Name")); ?></label>
                                                                        <input type="text" name="name"
                                                                               class="form-control"
                                                                               id="exampleInputName_1"
                                                                               placeholder="<?php echo e(__('general.Full Name Ex')); ?>"
                                                                               value="<?php echo e(old('name')); ?>" required>
                                                                        <?php if($errors->has('name')): ?>
                                                                            <span class="help-block">
                                                    <strong><?php echo e($errors->first('name')); ?></strong>
                                                </span>
                                                                        <?php endif; ?>
                                                                    </div>
                                                                    <div class="form-group <?php echo e($errors->has('email') ? ' has-error' : ''); ?>">
                                                                        <label class="control-label mb-10 brand-text-white"
                                                                               for="exampleInputEmail_2"><?php echo e(__("general.Email")); ?></label>
                                                                        <input type="email" name="email"
                                                                               value="<?php echo e(old('email')); ?>"
                                                                               class="form-control"
                                                                               id="exampleInputEmail_2"
                                                                               placeholder="<?php echo e(__('general.Email Ex')); ?>"
                                                                               required>
                                                                        <?php if($errors->has('email')): ?>
                                                                            <span class="help-block">
                                                    <strong><?php echo e($errors->first('email')); ?></strong>
                                                </span>
                                                                        <?php endif; ?>
                                                                    </div>
                                                                    <div class="form-group <?php echo e($errors->has('password') ? ' has-error' : ''); ?>">
                                                                        <label class="pull-left control-label mb-10 brand-text-white"
                                                                               for="exampleInputpwd_2"><?php echo e(__("general.Password")); ?></label>
                                                                        <input type="password" name="password"
                                                                               class="form-control"
                                                                               id="exampleInputpwd_2" required>
                                                                        <?php if($errors->has('password')): ?>
                                                                            <span class="help-block">
                                                    <strong><?php echo e($errors->first('password')); ?></strong>
                                                </span>
                                                                        <?php endif; ?>
                                                                    </div>
                                                                    <div class="form-group <?php echo e($errors->has('password_confirmation') ? ' has-error' : ''); ?>">
                                                                        <label class="pull-left control-label mb-10 brand-text-white"
                                                                               for="exampleInputpwd_3"><?php echo e(__("general.Confirm Password")); ?></label>
                                                                        <input type="password"
                                                                               name="password_confirmation"
                                                                               class="form-control"
                                                                               id="exampleInputpwd_3" required>
                                                                        <?php if($errors->has('password_confirmation')): ?>
                                                                            <span class="help-block">
                                                    <strong><?php echo e($errors->first('password_confirmation')); ?></strong>
                                                </span>
                                                                        <?php endif; ?>
                                                                    </div>
                                                                    <div class="form-group <?php echo e($errors->has('phone') ? ' has-error' : ''); ?>">
                                                                        <label class="control-label mb-10 brand-text-white"
                                                                               for="exampleInputName_1"><?php echo e(__("general.Phone")); ?></label>
                                                                        <input type="text" name="phone" maxlength="15"
                                                                               class="form-control allownumericwithoutdecimal"
                                                                               id="exampleInputName_1"
                                                                               placeholder="<?php echo e(__('general.Phone Ex')); ?>"
                                                                               value="<?php echo e(old('phone')); ?>" required>
                                                                        <?php if($errors->has('phone')): ?>
                                                                            <span class="help-block">
                                                    <strong><?php echo e($errors->first('phone')); ?></strong>
                                                </span>
                                                                        <?php endif; ?>
                                                                    </div>

                                                                    <div class="form-group <?php echo e($errors->has('language_id') ? ' has-error' : ''); ?>">
                                                                        <label class="control-label mb-10 brand-text-white"><?php echo e(__("general.Language")); ?></label>
                                                                        <select class="form-control select2"
                                                                                name="language_id">
                                                                            <option><?php echo e(__("general.Select")); ?></option>
                                                                            <?php $__currentLoopData = $languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                                <option value="<?php echo e($language->id); ?>"
                                                                                        <?php if( old("language_id") == $language->id ): ?> selected <?php endif; ?>><?php echo e($language->name); ?></option>
                                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                        </select>
                                                                        <?php if($errors->has('language_id')): ?>
                                                                            <span class="help-block">
                                                    <strong><?php echo e($errors->first('language_id')); ?></strong>
                                                </span>
                                                                        <?php endif; ?>
                                                                    </div>
                                                                    <div class="form-group <?php echo e($errors->has('country_id') ? ' has-error' : ''); ?>">
                                                                        <label class="control-label mb-10 brand-text-white"><?php echo e(__("general.Country")); ?></label>
                                                                        <select class="form-control select2"
                                                                                name="country_id" id="country_id"
                                                                                required>
                                                                            <option><?php echo e(__("general.Select")); ?></option>
                                                                            <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                                <option value="<?php echo e($country->id); ?>"
                                                                                        <?php if( old("country_id") == $country->id ): ?> selected <?php endif; ?>><?php echo e($country->name); ?></option>
                                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                        </select>
                                                                        <?php if($errors->has('country_id')): ?>
                                                                            <span class="help-block">
                                                    <strong><?php echo e($errors->first('country_id')); ?></strong>
                                                </span>
                                                                        <?php endif; ?>
                                                                    </div>
                                                                    <div class="form-group <?php echo e($errors->has('city_id') ? ' has-error' : ''); ?>">
                                                                        <label class="control-label mb-10 brand-text-white"><?php echo e(__("general.City")); ?></label>
                                                                        <select class="form-control select2"
                                                                                name="city_id" id="city_id" required>
                                                                            <option><?php echo e(__("general.Select")); ?></option>

                                                                        </select>
                                                                        <?php if($errors->has('city_id')): ?>
                                                                            <span class="help-block">
                                                    <strong><?php echo e($errors->first('city_id')); ?></strong>
                                                </span>
                                                                        <?php endif; ?>
                                                                    </div>
                                                                    <div class="form-group <?php echo e($errors->has('is_admin') ? ' has-error' : ''); ?>">
                                                                        <input hidden="hidden" name="is_admin"
                                                                               value="1">
                                                                        <?php if($errors->has('is_admin')): ?>
                                                                            <span class="help-block">
                                                    <strong><?php echo e($errors->first('is_admin')); ?></strong>
                                                                            </span>
                                                                        <?php endif; ?>
                                                                    </div>
                                                                    <div class="col-sm-12">
                                                                        <div class="form-group">

                                                                            <?php if($errors->has('image')): ?>
                                                                                <span class="help-block"
                                                                                      style="color : red">
                                                                                    <strong><?php echo e($errors->first('image')); ?></strong>
                                                                                </span>
                                                                            <?php endif; ?>

                                                                            <div class="mt-40">
                                                                                <input type="file"
                                                                                       name="image"
                                                                                       id="image"
                                                                                       class="dropify"
                                                                                       data-default-file=""
                                                                                       accept=".jpg,.jpeg,.png"/>
                                                                            </div>
                                                                            <label class="control-label mb-10"
                                                                                   for="exampleInputuname_01"><?php echo e(__("general.profileImage")); ?></label>
                                                                        </div>
                                                                    </div>

                                                                    <div class="form-group text-center">
                                                                        <button type="submit"
                                                                                class="btn btn-info btn-success btn-rounded"><?php echo e(__("general.Sign Up")); ?></button>
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
    <!-- /Row -->


</div>

<?php $__env->startSection('footer'); ?>
    ##parent-placeholder-d7eb6b340a11a367a1bec55e4a421d949214759f##
    <script>
        $(document).ready(function () {
            /* Select2 Init*/
            /* Select2 Init*/
            $(".select2").select2();

            /* Basic Init*/
            $('.dropify').dropify();

            // allow user only to type numbers only
            $(".allownumericwithoutdecimal").on("keypress keyup blur", function (event) {
                $(this).val($(this).val().replace(/[^\d].+/, ""));
                if ((event.which < 48 || event.which > 57)) {
                    event.preventDefault();
                }
            });

            $("#country_id").change(function () {
                var postData = {_token: "<?php echo e(csrf_token()); ?>", country_id: $(this).val()}
                $.ajax({
                    url: '<?php echo e(url("/user/country/cities")); ?>',
                    type: 'GET',
                    data: postData,
                    dataType: 'JSON',
                    success: function (result) {
                        //console.log(data);
                        if (result.status) {
                            $("#city_id option").remove();
                            $.each(result.result, function (key, value) {
                                $('#city_id')
                                    .append($("<option></option>")
                                        .attr("value", value.id)
                                        .text(value.name));
                            });


                        }

                    }
                });
            })

        })
    </script>



<?php $__env->stopSection(); ?>