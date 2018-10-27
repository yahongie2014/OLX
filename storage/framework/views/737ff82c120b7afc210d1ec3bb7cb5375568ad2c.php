<!DOCTYPE html>
<?php
    App::setLocale('ar');
$languages = \App\Language::all();
$countries = \App\Models\Country::all();
?>

<html lang="<?php echo e(app()->getLocale()); ?>">
<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <title><?php echo e(config('app.name', 'Laravel')); ?></title>
    <meta name="description" content="Philbert is a Dashboard & Admin Site Responsive Template by hencework."/>
    <meta name="keywords"
          content="admin, admin dashboard, admin template, cms, crm, Philbert Admin, Philbertadmin, premium admin templates, responsive admin, sass, panel, software, ui, visualization, web app, application"/>
    <meta name="author" content="hencework"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Favicon -->
    <link rel="shortcut icon" href="favicon.ico">
    <link rel="icon" href="favicon.ico" type="image/x-icon">

    <!-- vector map CSS -->
    <link href="<?php echo e(asset('vendors/bower_components/jasny-bootstrap/dist/css/jasny-bootstrap.min.css')); ?>" rel="stylesheet"
          type="text/css"/>

    <!-- select2 CSS -->
    <link href="<?php echo e(asset('vendors/bower_components/select2/dist/css/select2.min.css')); ?>" rel="stylesheet"
          type="text/css"/>

    <!-- bootstrap-select CSS -->
    <link href="<?php echo e(asset('vendors/bower_components/bootstrap-select/dist/css/bootstrap-select.min.css')); ?>"
          rel="stylesheet" type="text/css"/>
    <!-- Custom CSS -->
    <link href="<?php echo e(asset('dist/css/style-rtl.css')); ?>" rel="stylesheet" type="text/css">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <style>
        #video_background {
            position: fixed;
            bottom: 0;
            right: 0;
            min-width: 100%;
            min-height: 100%;
            width: auto;
            height: auto;
            z-index: 0;
            overflow: hidden;
            -webkit-backface-visibility: hidden;
            -webkit-transform: translateZ(0);
        }

        .opacity-80 {
            opacity: 0.8;
        }

        .gradient-17 {
            background: linear-gradient(125.67deg, rgba(2, 199, 188, 1) 25.29%, rgba(12, 180, 182, 1) 34.08%, rgba(23, 160, 176, 1) 45.94%, rgba(29, 149, 172, 1) 58.05%, rgba(31, 145, 171, 1) 70.7%, rgba(33, 133, 151, 1) 95.54%, rgba(33, 131, 147, 1) 100%) !important;
        }

        .overlay {
            position: fixed;
            background: linear-gradient(125.67deg, rgba(2, 199, 188, 1) 25.29%, rgba(12, 180, 182, 1) 34.08%, rgba(23, 160, 176, 1) 45.94%, rgba(29, 149, 172, 1) 58.05%, rgba(31, 145, 171, 1) 70.7%, rgba(33, 133, 151, 1) 95.54%, rgba(33, 131, 147, 1) 100%) !important;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            opacity: 0.8;

            z-index: 2;
        }

        .brand-text-white {
            color: white !important;
            /*font-size: 18pt;*/
            font-weight: bold !important;
        }
    </style>
</head>
<body>
<!--Preloader-->
<div class="preloader-it">
    <div class="la-anim-1"></div>
</div>
<!--/Preloader-->

<div class="wrapper pa-0">
    <header class="sp-header" style="z-index: 4;">
        <div class="sp-logo-wrap pull-left">
            <a href="<?php echo e(url('/')); ?>">
                <img class="brand-img mr-10" src="<?php echo e(asset('dist/img/logo3.png')); ?>" style="width: 70px;" alt="brand"/>
                <span class="brand-text brand-text-white"><?php echo e(config('app.name', 'Laravel')); ?></span>
            </a>
        </div>
        <div class="form-group mb-0 pull-right">
            <span class="inline-block pr-10 brand-text-white"><?php echo e(__("general.Already have an account?")); ?></span>
            <a class="inline-block btn btn-info btn-success btn-rounded brand-text-white"
               href="<?php echo e(route('login')); ?>"><?php echo e(__("general.Sign In")); ?></a>
        </div>
        <div class="clearfix"></div>
    </header>

    <!-- Main Content -->
    <div class="page-wrapper pa-0 ma-0 auth-page">
        <div class="container-fluid">
            <!-- Row -->
            <div class="table-struct full-width full-height">
                <div class="table-cell vertical-align-middle auth-form-wrap">
                    <div class="auth-form  ml-auto mr-auto no-float">
                        <video id="video_background" class="video_bg" preload="auto" autoplay="true" loop="loop"
                               muted="muted" volume="0">
                            <source src="<?php echo e(asset('dist/img/jibli.mp4')); ?>" type="video/mp4">
                            <source src="<?php echo e(asset('dist/img/jibli.ogg')); ?>" type="video/ogg">
                        </video>
                        <div class="overlay">
                            <div class="gradient-overlay gradient-17 opacity-80"></div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-xs-12" style="z-index: 3;">
                                <div class="mb-30">
                                    <h3 class="text-center txt-dark mb-10 brand-text-white"><?php echo e(__("general.Sign up")); ?></h3>

                                </div>

                                <div class="form-wrap">
                                    <form method="POST" action="<?php echo e(route('register')); ?>">
                                        <?php echo e(csrf_field()); ?>

                                        <div class="form-group <?php echo e($errors->has('name') ? ' has-error' : ''); ?> ">
                                            <label class="control-label mb-10 brand-text-white"
                                                   for="exampleInputName_1"><?php echo e(__("general.Full Name")); ?></label>
                                            <input type="text" name="name" class="form-control" id="exampleInputName_1"
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
                                            <input type="email" name="email" value="<?php echo e(old('email')); ?>"
                                                   class="form-control" id="exampleInputEmail_2"
                                                   placeholder="<?php echo e(__('general.Email Ex')); ?>" required>
                                            <?php if($errors->has('email')): ?>
                                                <span class="help-block">
                                                    <strong><?php echo e($errors->first('email')); ?></strong>
                                                </span>
                                            <?php endif; ?>
                                        </div>
                                        <div class="form-group <?php echo e($errors->has('password') ? ' has-error' : ''); ?>">
                                            <label class="pull-left control-label mb-10 brand-text-white"
                                                   for="exampleInputpwd_2"><?php echo e(__("general.Password")); ?></label>
                                            <input type="password" name="password" class="form-control"
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
                                            <input type="password" name="password_confirmation" class="form-control"
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
                                                   id="exampleInputName_1" placeholder="<?php echo e(__('general.Phone Ex')); ?>"
                                                   value="<?php echo e(old('phone')); ?>" required>
                                            <?php if($errors->has('phone')): ?>
                                                <span class="help-block">
                                                    <strong><?php echo e($errors->first('phone')); ?></strong>
                                                </span>
                                            <?php endif; ?>
                                        </div>

                                        <div class="form-group <?php echo e($errors->has('language_id') ? ' has-error' : ''); ?>">
                                            <label class="control-label mb-10 brand-text-white"><?php echo e(__("general.Language")); ?></label>
                                            <select class="form-control select2" name="language_id">
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
                                            <select class="form-control select2" name="country_id" id="country_id"
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
                                            <select class="form-control select2" name="city_id" id="city_id" required>
                                                <option><?php echo e(__("general.Select")); ?></option>

                                            </select>
                                            <?php if($errors->has('city_id')): ?>
                                                <span class="help-block">
                                                    <strong><?php echo e($errors->first('city_id')); ?></strong>
                                                </span>
                                            <?php endif; ?>
                                        </div>
                                        <div class="form-group <?php echo e($errors->has('is_vendor') ? ' has-error' : ''); ?>">
                                            <input hidden="hidden" name="is_vendor" value="1">
                                            <?php if($errors->has('is_vendor')): ?>
                                                <span class="help-block">
                                                    <strong><?php echo e($errors->first('is_vendor')); ?></strong>
                                                </span>
                                            <?php endif; ?>
                                        </div>

                                        <div class="form-group">
                                            <div class=" checkbox-primary pr-10 pull-left">
                                                <input id="checkbox_2" required="" type="checkbox">
                                                <label for="checkbox_2 "
                                                       class="brand-text-white"> <?php echo e(__("general.I agree to all")); ?> <span
                                                            class="txt-primary"
                                                            style="color:#00cbbd !important;"><?php echo e(__("general.Terms")); ?></span></label>
                                            </div>
                                            <div class="clearfix"></div>
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
            <!-- /Row -->
        </div>

    </div>
    <!-- /Main Content -->

</div>
<!-- /#wrapper -->

<!-- JavaScript -->

<!-- jQuery -->

<script src="<?php echo e(asset('vendors/bower_components/jquery/dist/jquery.min.js')); ?>"></script>

<!-- Bootstrap Core JavaScript -->
<script src="<?php echo e(asset('vendors/bower_components/bootstrap/dist/js/bootstrap.min.js')); ?>"></script>
<script src="<?php echo e(asset('vendors/bower_components/jasny-bootstrap/dist/js/jasny-bootstrap.min.js')); ?>"></script>

<!-- Slimscroll JavaScript -->
<script src="<?php echo e(asset('dist/js/jquery.slimscroll.js')); ?>"></script>

<!-- Select2 JavaScript -->
<script src="<?php echo e(asset('vendors/bower_components/select2/dist/js/select2.full.min.js')); ?>"></script>

<!-- Init JavaScript -->
<script src="<?php echo e(asset('dist/js/init.js')); ?>"></script>
<script>
    $(document).ready(function () {
        /* Select2 Init*/
        $(".select2").select2();

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
</body>
</html>