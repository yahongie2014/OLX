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
                                <h6 class="block capitalize-font pb-20">
                                    <div calss="row">
                                        <?php if($user->provider): ?>
                                            <div class="col-lg-12 col-xs-12">
                                                <div class="col-lg-12 col-xs-12">

                                                    <button class="btn btn-primary btn-icon-anim btn-circle">
                                                        <i class="fa fa-shopping-cart"></i>

                                                    </button>
                                                    <span><?php echo e(__("general.Provider")); ?></span>

                                                </div>

                                                <div class="col-sm-12" style="margin-top: 2%">
                                                    <div class="form-group">
                                                        <div>
                                                            <input id="provider_active" type="checkbox"
                                                                   data-off-text="<?php echo e(__('general.inactive')); ?>"
                                                                   data-on-text="<?php echo e(__('general.active')); ?>"
                                                                   class="bs-switch"
                                                                   data-user-state="<?php echo e($user->provider->status); ?>">

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="social-info">
                                                <div class="row">
                                                    <div class="col-xs-4 text-center">
                                                        <span class="counts block head-font"><span
                                                                    class="counter-anim"><?php echo e($user->provider->dayOrders); ?></span></span>
                                                        <span class="counts-text block"><?php echo e(__("general.totalDayOrdersCount")); ?></span>
                                                    </div>

                                                    <div class="col-xs-4 text-center">
                                                        <span class="counts block head-font"><span
                                                                    class="counter-anim"><?php echo e($user->provider->monthOrders); ?></span></span>
                                                        <span class="counts-text block"><?php echo e(__("general.totalMonthOrdersCount")); ?></span>
                                                    </div>

                                                    <div class="col-xs-4 text-center">
                                                        <span class="counts block head-font"><span
                                                                    class="counter-anim"><?php echo e($user->provider->allOrders); ?></span></span>
                                                        <span class="counts-text block"><?php echo e(__("general.totalOrdersCount")); ?></span>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                        <div class="clearfix"></div>
                                        <?php if($user->delivery): ?>
                                            <div class="col-lg-12 col-xs-12">
                                                <div class="col-lg-12 col-xs-12">

                                                    <button class="btn btn-info btn-icon-anim btn-circle">
                                                        <i class="fa fa-car"></i>

                                                    </button>
                                                    <?php echo e(__("general.Delivery")); ?>


                                                </div>

                                                <div class="col-sm-12" style="margin-top: 2%">
                                                    <div class="form-group">
                                                        <div>
                                                            <input id="delivery_active" type="checkbox"
                                                                   data-off-text="<?php echo e(__('general.inactive')); ?>"
                                                                   data-on-text="<?php echo e(__('general.active')); ?>"
                                                                   class="bs-switch"
                                                                   data-user-state="<?php echo e($user->delivery->status); ?>">

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="social-info">
                                                <div class="row">
                                                    <div class="col-xs-4 text-center">
                                                        <span class="counts block head-font"><span
                                                                    class="counter-anim"><?php echo e($user->delivery->dayOrders); ?></span></span>
                                                        <span class="counts-text block"><?php echo e(__("general.totalDayOrdersCount")); ?></span>
                                                    </div>

                                                    <div class="col-xs-4 text-center">
                                                        <span class="counts block head-font"><span
                                                                    class="counter-anim"><?php echo e($user->delivery->monthOrders); ?></span></span>
                                                        <span class="counts-text block"><?php echo e(__("general.totalMonthOrdersCount")); ?></span>
                                                    </div>

                                                    <div class="col-xs-4 text-center">
                                                        <span class="counts block head-font"><span
                                                                    class="counter-anim"><?php echo e($user->delivery->allOrders); ?></span></span>
                                                        <span class="counts-text block"><?php echo e(__("general.totalOrdersCount")); ?></span>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                        <div class="clearfix"></div>
                                    </div>
                                </h6>
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
                                <?php if($user->provider): ?>
                                    <li role="presentation" class="next">
                                        <a aria-expanded="true" data-toggle="tab" role="tab" id="provider_tab_8"
                                           href="#provider_info">
                                            <span><?php echo e(__("general.Provider Info")); ?></span>
                                        </a>
                                    </li>
                                <?php endif; ?>
                                <?php if($user->delivery): ?>
                                    <li role="presentation" class="next">
                                        <a aria-expanded="true" data-toggle="tab" role="tab" id="dekivery_tab_8"
                                           href="#delivery">
                                            <span><?php echo e(__("general.Delivery Info")); ?></span>
                                        </a>
                                    </li>
                                <?php endif; ?>
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
                                <?php if($user->provider): ?>
                                    <div id="provider_info" class="tab-pane fade active in" role="tabpanel">
                                        <!-- Row -->
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="">
                                                    <div class="panel-wrapper collapse in">
                                                        <div class="panel-body pa-0">

                                                            <div class="col-sm-12 col-xs-12">
                                                                <?php if($user->provider->loadings->count() > 0): ?>
                                                                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                                                        <img src="<?php echo e(asset('/dist/img/loading-active.png')); ?>"
                                                                             style="width:30px;height:30px"/>
                                                                        <?php echo e(__("general.active")); ?>

                                                                    </div>
                                                                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                                                        <img src="<?php echo e(asset('/dist/img/loading-inactive.png')); ?>"
                                                                             style="width:30px;height:30px"/>
                                                                        <?php echo e(__("general.inactive")); ?>

                                                                    </div>
                                                                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                                                        <img src="<?php echo e(asset('/dist/img/loading-default.png')); ?>"
                                                                             style="width:30px;height:30px"/>
                                                                        <?php echo e(__("general.default")); ?>

                                                                    </div>

                                                                    <div class="clearfix"></div>

                                                                    <div id="googleMap"
                                                                         style="width:100%;height:400px;"></div>
                                                                <?php else: ?>
                                                                    <p class="text-warning mb-10">
                                                                        <code><?php echo e(__("general.providerDoseNotHaveLoadingPoints")); ?></code>
                                                                    </p>
                                                                <?php endif; ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                <?php if($user->delivery): ?>
                                    <div id="delivery" class="tab-pane fade" role="tabpanel">
                                        <!-- Row -->
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="">
                                                    <div class="panel-wrapper collapse in">
                                                        <div class="panel-body pa-0">
                                                            <div class="col-sm-12 col-xs-12">
                                                                <div class="form-wrap">
                                                                    <form action="<?php echo e(url('/delivery/info/' . $user->delivery->id)); ?>"
                                                                          enctype="multipart/form-data" method="POST">
                                                                        <?php echo e(method_field('PATCH')); ?>

                                                                        <?php echo e(csrf_field()); ?>

                                                                        <input name="delivery_id"
                                                                               value="<?php echo e($user->delivery->id); ?>"
                                                                               type="hidden"/>
                                                                        <div class="form-body overflow-hide">
                                                                            <div class="form-group">
                                                                                <div class="checkbox checkbox-primary pr-10 pull-left">
                                                                                    <input id="checkbox_2" value="1"
                                                                                           name="deliveryAvailability"
                                                                                           type="checkbox"
                                                                                           <?php if(!$canUpdate): ?> disabled
                                                                                           <?php endif; ?> <?php if($user->delivery->available == DELIVERY_AVAILABLE): ?> checked <?php endif; ?>>
                                                                                    <label for="checkbox_2"> <?php echo e(__("general.available")); ?> </label>
                                                                                </div>
                                                                                <div class="clearfix"></div>
                                                                            </div>
                                                                            <div class="form-group <?php echo e($errors->has('vehicle_id') ? ' has-error' : ''); ?>">
                                                                                <label class="control-label mb-10"
                                                                                       for="exampleInputuname_01"><?php echo e(__("general.vehicle_id")); ?></label>
                                                                                <div class="input-group">
                                                                                    <div class="input-group-addon">
                                                                                        <i class="icon-user"></i>
                                                                                    </div>
                                                                                    <input type="text"
                                                                                           class="form-control allownumericwithoutdecimal"
                                                                                           id="exampleInputuname_01"
                                                                                           name="vehicle_id"
                                                                                           value="<?php echo e($user->delivery->vehicle_id); ?>"
                                                                                           required
                                                                                           <?php if(!$canUpdate): ?> disabled <?php endif; ?> />
                                                                                </div>
                                                                                <?php if($errors->has('vehicle_id')): ?>
                                                                                    <span class="help-block">
                                                                                <strong><?php echo e($errors->first('vehicle_id')); ?></strong>
                                                                            </span>
                                                                                <?php endif; ?>
                                                                            </div>
                                                                            <div class="form-group <?php echo e($errors->has('license_id') ? ' has-error' : ''); ?>">
                                                                                <label class="control-label mb-10"
                                                                                       for="exampleInputuname_01"><?php echo e(__("general.license_id")); ?></label>
                                                                                <div class="input-group">
                                                                                    <div class="input-group-addon">
                                                                                        <i class="icon-user"></i>
                                                                                    </div>
                                                                                    <input type="text"
                                                                                           class="form-control allownumericwithoutdecimal"
                                                                                           id="exampleInputuname_01"
                                                                                           name="license_id"
                                                                                           value="<?php echo e($user->delivery->license_id); ?>"
                                                                                           required
                                                                                           <?php if(!$canUpdate): ?> disabled <?php endif; ?> />
                                                                                </div>
                                                                                <?php if($errors->has('license_id')): ?>
                                                                                    <span class="help-block">
                                                                                <strong><?php echo e($errors->first('license_id')); ?></strong>
                                                                            </span>
                                                                                <?php endif; ?>
                                                                            </div>
                                                                            <div class="form-group <?php echo e($errors->has('car_type_id') ? ' has-error' : ''); ?>">
                                                                                <label class="control-label mb-10"><?php echo e(__("general.CarType")); ?></label>
                                                                                <select class="form-control select2"
                                                                                        name="car_type_id"
                                                                                        <?php if(!$canUpdate): ?> disabled
                                                                                        <?php endif; ?> required>
                                                                                    <?php $__currentLoopData = $carTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $carType): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                                        <option value="<?php echo e($carType->id); ?>"
                                                                                                <?php if( $user->delivery->car_type_id == $carType->id ): ?> selected <?php endif; ?>><?php echo e($carType->name); ?></option>
                                                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                                </select>
                                                                                <?php if($errors->has('car_type_id')): ?>
                                                                                    <span class="help-block">
                                                                                    <strong><?php echo e($errors->first('car_type_id')); ?></strong>
                                                                                </span>
                                                                                <?php endif; ?>
                                                                            </div>
                                                                        </div>
                                                                        <?php if($canUpdate && $loginType == DRIVER): ?>
                                                                            <div class="form-actions mt-10">
                                                                                <button type="submit"
                                                                                        class="btn btn-success mr-10 mb-30"><?php echo e(__('general.Save')); ?></button>
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
                                <?php endif; ?>
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
    <?php if($user->provider && $user->provider->loadings->count() > 0): ?>
        <script>
            var map;

            function initMap() {
                var infoWindow = new google.maps.InfoWindow;
                map = new google.maps.Map(document.getElementById('googleMap'), {
                    zoom: 10,
                    center: new google.maps.LatLng(24.782765, 46.782498),
                    mapTypeId: 'roadmap'
                });

                var iconBase = 'https://maps.google.com/mapfiles/kml/shapes/';
                var icons = {
                    active: {
                        icon: "<?php echo e(asset('/dist/img/loading-active.png')); ?>"
                    },
                    inactive: {
                        icon: "<?php echo e(asset('/dist/img/loading-inactive.png')); ?>"
                    },
                    default: {
                        icon: "<?php echo e(asset('/dist/img/loading-default.png')); ?>"
                    }
                };

                var features = [
                        <?php $__currentLoopData = $user->provider->loadings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $loading): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    {
                        position: new google.maps.LatLng("<?php echo e($loading->lat); ?>", "<?php echo e($loading->long); ?>"),
                        type: <?php if($loading->default == PROVIDER_LOADING_DEFAULT): ?>
                            'default'
                        <?php elseif($loading->status == PROVIDER_LOADING_ACTIVE): ?>
                        'active'
                                <?php else: ?>
                                    'inactive'
                        <?php endif; ?>,
                        name: "<?php echo e($loading->name); ?>",
                        address: "<?php echo e($loading->address); ?>"

                    },
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                ];

                var bounds = new google.maps.LatLngBounds();

                // Create markers.
                features.forEach(function (feature) {
                    var marker = new google.maps.Marker({
                        position: feature.position,
                        icon: icons[feature.type].icon,
                        map: map
                    });

                    var html = "<span style='margin-right: 20px;font-weight: bold'><br><b>" + feature.name + "</b><br><b>" + feature.address + "</b></span>";

                    bindInfoWindow(marker, map, infoWindow, html);

                    bounds.extend(marker.position);
                });
                map.fitBounds(bounds);

            }

            function bindInfoWindow(marker, map, infoWindow, html) {
                google.maps.event.addListener(marker, 'click', function () {
                    infoWindow.setContent(html);
                    infoWindow.open(map, marker);
                });
            }
        </script>
        <script async defer
                src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDgIKx-8qqL3I3a-cVETwnf2UbgVzm1zus&callback=initMap">
        </script>
    <?php endif; ?>
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