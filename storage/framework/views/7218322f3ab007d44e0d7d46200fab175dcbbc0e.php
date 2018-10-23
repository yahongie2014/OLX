<?php $__env->startSection('title', env('APP_NAME', 'At Time') . ' | Admin Dashboard'); ?>

<?php $__env->startSection('headerBar'); ?>
<li>
    <a href="<?php echo e(url('/admin/profile/' . Auth::user()->id)); ?>"><i class="zmdi zmdi-account"></i><span><?php echo e(__("general.Profile")); ?></span></a>
</li>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('PageLocation'); ?>

<li>
    <a href="<?php echo e(url('/admin')); ?>"><?php echo e(__("general.Home")); ?></a>
</li>

<li>
    <span></span>
</li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('leftSideBar'); ?>
    <!-- Left Sidebar Menu -->
    <div class="fixed-sidebar-left">
        <ul class="nav navbar-nav side-nav nicescroll-bar">
            <li class="navigation-header">
                <span></span>
                <i class="zmdi zmdi-more"></i>
            </li>
            <li>
                <a href="<?php echo e(url('/admin')); ?>">
                    <div class="pull-left">
                        <i class="zmdi zmdi-home mr-20"></i>
                        <span class="right-nav-text"><?php echo e(__("general.Home")); ?></span>
                    </div>
                    <div class="clearfix">

                    </div>
                </a>
            </li>
            <li>
                <a href="<?php echo e(url('/admin/provider')); ?>">
                    <div class="pull-left">
                        <i class="zmdi zmdi-shopping-cart mr-20"></i>
                        <span class="right-nav-text"><?php echo e(__("general.Providers")); ?></span>
                    </div>
                    <div class="clearfix">

                    </div>
                </a>
            </li>

            <li>
                <a href="<?php echo e(url('/admin/delivery')); ?>">
                    <div class="pull-left">
                        <i class="zmdi zmdi-car mr-20"></i>
                        <span class="right-nav-text"><?php echo e(__("general.Deliveries")); ?></span>
                    </div>
                    <div class="clearfix">

                    </div>
                </a>
            </li>
            <li>
                <a href="<?php echo e(url('/admin/orders')); ?>">
                    <div class="pull-left">
                        <i class="zmdi zmdi-labels mr-20"></i>
                        <span class="right-nav-text"><?php echo e(__("general.Orders")); ?></span>
                    </div>
                    <div class="clearfix">

                    </div>
                </a>
            </li>
            <li>
                <a href="javascript:void(0);" data-toggle="collapse" data-target="#dashboard_dr">
                    <div class="pull-left">
                        <i class="zmdi zmdi-settings mr-20"></i>
                        <span class="right-nav-text"><?php echo e(__("general.Settings")); ?></span>
                    </div>
                    <div class="pull-right">
                        <i class="zmdi zmdi-caret-down"></i>
                    </div>
                    <div class="clearfix">

                    </div>
                </a>
                <ul id="dashboard_dr" class="collapse collapse-level-1">

                    <li>
                        <a href="<?php echo e(url('/admin/languages')); ?>"><?php echo e(__("general.Languages")); ?></a>
                    </li>
                    <li>
                        <a href="<?php echo e(url('/admin/countries')); ?>"><?php echo e(__("general.Countries")); ?></a>
                    </li>
                    <li>
                        <a href="<?php echo e(url('/admin/cities')); ?>"><?php echo e(__("general.Cities")); ?></a>
                    </li>
                    <li>
                        <a href="<?php echo e(url('/admin/categories')); ?>"><?php echo e(__("general.Categories")); ?></a>
                    </li>
                    <li>
                        <a href="<?php echo e(url('/admin/services')); ?>"><?php echo e(__("general.Service Types")); ?></a>
                    </li>
                    <li>
                        <a href="<?php echo e(url('/admin/paytypes')); ?>"><?php echo e(__("general.Payment Types")); ?></a>
                    </li>
                    <li>
                        <a href="<?php echo e(url('/admin/cartypes')); ?>"><?php echo e(__("general.Car Types")); ?></a>
                    </li>
                    <!--<li>
                        <a href="#"><?php echo e(__("general.Admins")); ?></a>
                    </li>-->
                </ul>
            </li>
        </ul>
    </div>
    <!-- /Left Sidebar Menu -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.mainlayout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>