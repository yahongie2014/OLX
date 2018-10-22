<div class="container-fluid pt-25">
<?php if($errors->any()): ?>
    <!--<div class="alert alert-danger alert-dismissable alert-style-1">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <i class="zmdi zmdi-alert-circle-o"></i><?php echo e(__("general.error check fields")); ?>

            </div>-->
<?php endif; ?>
<!-- Row -->
    <div class="row">
        <div class="col-lg-3 col-xs-12">
            <div class="panel panel-default card-view  pa-0">
                <div class="panel-wrapper collapse in">
                    <div class="panel-body  pa-0">
                        <div class="profile-box">
                            <div class="profile-cover-pic">

                            </div>
                            <div class="profile-info text-center">
                                <div class="profile-img-wrap">
                                    <img class="inline-block mb-10" style="max-width: 100%;"
                                         src=<?php if($user->image): ?><?php echo e(asset($user->image)); ?> <?php else: ?> <?php echo e(asset("dist/img/mock1.jpg")); ?> <?php endif; ?> alt="user"/>

                                </div>
                                <h5 class="block mt-10 mb-5 weight-500 capitalize-font txt-danger"><?php echo e($user->name); ?></h5>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
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
                                <?php if($canUpdate): ?>
                                    <li role="presentation" class="next">
                                        <a aria-expanded="true" data-toggle="tab" role="tab" id="password_tab_8"
                                           href="#changePassword">
                                            <span><?php echo e(__("general.ChangePassword")); ?></span>
                                        </a>
                                    </li>
                                <?php endif; ?>
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
                                                                <form action="<?php echo e(url($updateLink)); ?>"
                                                                      enctype="multipart/form-data" method="POST">
                                                                    <?php echo e(method_field('PATCH')); ?>

                                                                    <?php echo e(csrf_field()); ?>

                                                                    <input name="user_id" value="<?php echo e($user->id); ?>"
                                                                           type="hidden"/>
                                                                    <div class="form-body overflow-hide">
                                                                        <?php if($canUpdate): ?>
                                                                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                                                <div class="form-group">

                                                                                    <?php if($errors->has('profileImage')): ?>
                                                                                        <span class="help-block"
                                                                                              style="color : red">
                                                                                    <strong><?php echo e($errors->first('profileImage')); ?></strong>
                                                                                </span>
                                                                                    <?php endif; ?>

                                                                                    <div class="mt-40">
                                                                                        <input type="file"
                                                                                               name="profileImage"
                                                                                               id="profileImage"
                                                                                               class="dropify"
                                                                                               data-default-file=<?php if($user->image): ?>"<?php echo e(asset($user->image)); ?>" <?php else: ?>
                                                                                            "" <?php endif; ?>
                                                                                        accept=".jpg,.jpeg,.png" />
                                                                                    </div>
                                                                                    <label class="control-label mb-10"
                                                                                           for="exampleInputuname_01"><?php echo e(__("general.profileImage")); ?></label>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                                                <div class="form-group">
                                                                                    <?php if($errors->has('coverImage')): ?>
                                                                                        <span class="help-block"
                                                                                              style="color : red">
                                                                                    <strong><?php echo e($errors->first('coverImage')); ?></strong>
                                                                                </span>
                                                                                    <?php endif; ?>
                                                                                    <div class="mt-40">
                                                                                        <input type="file"
                                                                                               name="coverImage"
                                                                                               id="coverImage"
                                                                                               class="dropify"
                                                                                               data-default-file=<?php if($user->cover_image): ?>"<?php echo e(asset($user->cover_image)); ?>" <?php else: ?>
                                                                                            "" <?php endif; ?>
                                                                                        accept=".jpg,.jpeg,.png" />
                                                                                    </div>
                                                                                    <label class="control-label mb-10"
                                                                                           for="exampleInputuname_01"><?php echo e(__("general.coverImage")); ?></label>
                                                                                </div>
                                                                            </div>
                                                                        <?php endif; ?>

                                                                        <div class="col-xs-12">
                                                                            <div class="form-group <?php echo e($errors->has('userName') ? ' has-error' : ''); ?>">
                                                                                <label class="control-label mb-10"
                                                                                       for="exampleInputuname_01"><?php echo e(__("general.Name")); ?></label>
                                                                                <div class="input-group">
                                                                                    <div class="input-group-addon">
                                                                                        <i class="icon-user"></i>
                                                                                    </div>
                                                                                    <input type="text"
                                                                                           class="form-control"
                                                                                           id="exampleInputuname_01"
                                                                                           name="userName"
                                                                                           value="<?php echo e($user->name); ?>"
                                                                                           required
                                                                                           <?php if(!$canUpdate): ?> disabled <?php endif; ?> />
                                                                                </div>
                                                                                <?php if($errors->has('userName')): ?>
                                                                                    <span class="help-block">
                                                                                    <strong><?php echo e($errors->first('userName')); ?></strong>
                                                                                </span>
                                                                                <?php endif; ?>
                                                                            </div>
                                                                            <div class="form-group <?php echo e($errors->has('email') ? ' has-error' : ''); ?>">
                                                                                <label class="control-label mb-10"
                                                                                       for="exampleInputEmail_01"><?php echo e(__("general.Email")); ?></label>
                                                                                <div class="input-group">
                                                                                    <div class="input-group-addon">
                                                                                        <i class="icon-envelope-open"></i>
                                                                                    </div>
                                                                                    <input type="email" name="email"
                                                                                           class="form-control"
                                                                                           id="exampleInputEmail_01"
                                                                                           value=<?php if(old('email')): ?> <?php echo e(old('email')); ?> <?php else: ?> "<?php echo e($user->email); ?>"
                                                                                           <?php endif; ?>  <?php if(!$canUpdate): ?> disabled <?php endif; ?> />
                                                                                </div>
                                                                                <?php if($errors->has('email')): ?>
                                                                                    <span class="help-block">
                                                                                    <strong><?php echo e($errors->first('email')); ?></strong>
                                                                                </span>
                                                                                <?php endif; ?>
                                                                            </div>
                                                                            <div class="form-group <?php echo e($errors->has('phone') ? ' has-error' : ''); ?>">
                                                                                <label class="control-label mb-10"
                                                                                       for="exampleInputContact_01"><?php echo e(__("general.Phone")); ?></label>
                                                                                <div class="input-group">
                                                                                    <div class="input-group-addon"><i
                                                                                                class="icon-phone"></i>
                                                                                    </div>
                                                                                    <input type="text"
                                                                                           class="form-control allownumericwithoutdecimal"
                                                                                           name="phone" maxlength="15"
                                                                                           id="exampleInputContact_01"
                                                                                           value=<?php if(old('phone')): ?> <?php echo e(old('phone')); ?> <?php else: ?> "<?php echo e($user->phone); ?>"
                                                                                           <?php endif; ?> <?php if(!$canUpdate): ?> disabled <?php endif; ?> />
                                                                                </div>

                                                                                <?php if($errors->has('phone')): ?>
                                                                                    <span class="help-block">
                                                                                    <strong><?php echo e($errors->first('phone')); ?></strong>
                                                                                </span>
                                                                                <?php endif; ?>
                                                                            </div>

                                                                            <div class="form-group <?php echo e($errors->has('country_id') ? ' has-error' : ''); ?>">
                                                                                <label class="control-label mb-10"><?php echo e(__("general.Country")); ?></label>
                                                                                <select class="form-control select2"
                                                                                        name="country_id"
                                                                                        id="country_id"
                                                                                        <?php if(!$canUpdate): ?> disabled
                                                                                        <?php endif; ?> required>
                                                                                    
                                                                                    
                                                                                    
                                                                                    
                                                                                </select>
                                                                                <?php if($errors->has('country_id')): ?>
                                                                                    <span class="help-block">
                                                                                    <strong><?php echo e($errors->first('country_id')); ?></strong>
                                                                                </span>
                                                                                <?php endif; ?>
                                                                            </div>
                                                                            <div class="form-group <?php echo e($errors->has('city_id') ? ' has-error' : ''); ?>">
                                                                                <label class="control-label mb-10"><?php echo e(__("general.City")); ?></label>
                                                                                <select class="form-control select2"
                                                                                        name="city_id" id="city_id"
                                                                                        <?php if(!$canUpdate): ?> disabled
                                                                                        <?php endif; ?> required>
                                                                                    
                                                                                    
                                                                                    
                                                                                    
                                                                                </select>
                                                                                <?php if($errors->has('city_id')): ?>
                                                                                    <span class="help-block">
                                                                                    <strong><?php echo e($errors->first('city_id')); ?></strong>
                                                                                </span>
                                                                                <?php endif; ?>
                                                                            </div>
                                                                            <div class="form-group <?php echo e($errors->has('language_id') ? ' has-error' : ''); ?>">
                                                                                <label class="control-label mb-10"><?php echo e(__("general.Language")); ?></label>
                                                                                <select class="form-control select2"
                                                                                        name="language_id"
                                                                                        <?php if(!$canUpdate): ?> disabled
                                                                                        <?php endif; ?> required>
                                                                                    
                                                                                    
                                                                                    
                                                                                    
                                                                                </select>
                                                                                <?php if($errors->has('language_id')): ?>
                                                                                    <span class="help-block">
                                                                                    <strong><?php echo e($errors->first('language_id')); ?></strong>
                                                                                </span>
                                                                                <?php endif; ?>
                                                                            </div>
                                                                            <div class="form-group <?php echo e($errors->has('address') ? ' has-error' : ''); ?>">
                                                                                <label class="control-label mb-10 text-left"><?php echo e(__("general.Address")); ?></label>
                                                                                <textarea class="form-control" required
                                                                                          <?php if(!$canUpdate): ?> disabled
                                                                                          <?php endif; ?> name="address"
                                                                                          rows="5"><?php echo e($user->address); ?></textarea>
                                                                                <?php if($errors->has('address')): ?>
                                                                                    <span class="help-block">
                                                                                    <strong><?php echo e($errors->first('address')); ?></strong>
                                                                                </span>
                                                                                <?php endif; ?>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <?php if($canUpdate): ?>
                                                                        <div class="form-actions mt-10">
                                                                            <button type="submit"
                                                                                    class="btn btn-success mr-10 mb-30"><?php echo e(__('general.Update profile')); ?></button>
                                                                        </div>
                                                                    <?php endif; ?>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php if($canUpdate): ?>
                                    <div id="changePassword" class="tab-pane fade active in" role="tabpanel">
                                        <!-- Row -->
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="">
                                                    <div class="panel-wrapper collapse in">
                                                        <div class="panel-body pa-0">
                                                            <div class="col-sm-6 col-xs-6">
                                                                <div class="form-wrap">
                                                                    <form action="<?php echo e(url('/user/password')); ?>"
                                                                          method="POST">
                                                                        <?php echo e(csrf_field()); ?>

                                                                        <div class="form-group <?php echo e($errors->has('oldPassword') ? ' has-error' : ''); ?>">
                                                                            <label class="control-label mb-10"><?php echo e(__("general.oldPassword")); ?></label>
                                                                            <div class="input-group">
                                                                                <input type="password"
                                                                                       class="form-control"
                                                                                       name="oldPassword"/>
                                                                            </div>
                                                                            <?php if($errors->has('oldPassword')): ?>
                                                                                <span class="help-block">
                                                                                <strong><?php echo e($errors->first('oldPassword')); ?></strong>
                                                                            </span>
                                                                            <?php endif; ?>
                                                                        </div>
                                                                        <div class="form-group <?php echo e($errors->has('oldPassword') ? ' has-error' : ''); ?>">
                                                                            <label class="control-label mb-10"><?php echo e(__("general.newPassword")); ?></label>
                                                                            <div class="input-group">
                                                                                <input type="password"
                                                                                       class="form-control"
                                                                                       name="password"/>
                                                                            </div>
                                                                            <?php if($errors->has('password')): ?>
                                                                                <span class="help-block">
                                                                                <strong><?php echo e($errors->first('password')); ?></strong>
                                                                            </span>
                                                                            <?php endif; ?>
                                                                        </div>
                                                                        <div class="form-group <?php echo e($errors->has('oldPassword') ? ' has-error' : ''); ?>">
                                                                            <label class="control-label mb-10"><?php echo e(__("general.newPasswordConfirm")); ?></label>
                                                                            <div class="input-group">
                                                                                <input type="password"
                                                                                       class="form-control"
                                                                                       name="password_confirmation"/>
                                                                            </div>
                                                                            <?php if($errors->has('password_confirmation')): ?>
                                                                                <span class="help-block">
                                                                                <strong><?php echo e($errors->first('password_confirmation')); ?></strong>
                                                                            </span>
                                                                            <?php endif; ?>
                                                                        </div>
                                                                        <div class="form-actions mt-10">
                                                                            <button type="submit"
                                                                                    class="btn btn-success mr-10 mb-30"><?php echo e(__('general.Save')); ?></button>
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
            $(".select2").select2();

            /* Basic Init*/
            $('.dropify').dropify();

            /* Bootstrap switch Init*/
            if ($('#provider_active').length > 0) {
                $('#provider_active').bootstrapSwitch('state', $('#provider_active').data('user-state'));
                $('#provider_active').bootstrapSwitch('toggleReadonly', true);
            }


            if ($('#delivery_active').length > 0) {
                $('#delivery_active').bootstrapSwitch('state', $('#delivery_active').data('user-state'));
                $('#delivery_active').bootstrapSwitch('toggleReadonly', true);
            }

            $("#country_id").change(function () {
                var postData = {_token: "<?php echo e(csrf_token()); ?>", country_id: $(this).val()}
                $.ajax({
                    url: '<?php echo e(url("/user/country/cities")); ?>',
                    type: 'GET',
                    data: postData,
                    dataType: 'JSON',
                    success: function (data) {
                        //console.log(data);
                        if (data.status) {
                            $("#city_id option").remove();
                            $.each(data.result.data, function (key, value) {
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