<?php $__env->startSection('title', config('app.name', 'Laravel') . ' | Provider Dashboard'); ?>

<?php $__env->startSection('PageHeader'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('headerBar'); ?>
<li>
    <a href="<?php echo e(url('/provider/profile/' . Auth::user()->id)); ?>"><i class="zmdi zmdi-account"></i><span><?php echo e(__("general.Profile")); ?></span></a>
</li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('PageLocation'); ?>

<li>
    <a href="<?php echo e(url('/provider')); ?>"><?php echo e(__("general.Home")); ?></a>
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
            <a href="<?php echo e(url('/provider')); ?>">
                <div class="pull-left">
                    <i class="zmdi zmdi-home mr-20"></i>
                    <span class="right-nav-text"><?php echo e(__("general.Home")); ?></span>
                </div>
                <div class="clearfix">

                </div>
            </a>
        </li>
        <li>
            <a href="<?php echo e(url('/provider/profile/' . Auth::user()->id)); ?>">
                <div class="pull-left">
                    <i class="zmdi zmdi-account mr-20"></i>
                    <span class="right-nav-text"><?php echo e(__("general.Profile")); ?></span>
                </div>
                <div class="clearfix">

                </div>
            </a>
        </li>
        <li>
            <a href="<?php echo e(url('/provider/orders')); ?>">
                <div class="pull-left">
                    <i class="zmdi zmdi-labels mr-20"></i>
                    <span class="right-nav-text"><?php echo e(__("general.Orders")); ?></span>
                </div>
                <div class="clearfix">

                </div>
            </a>
        </li>
        <li>
            <a href="<?php echo e(url('/provider/orders/create')); ?>">
                <div class="pull-left">
                    <i class="glyphicon glyphicon-plus-sign mr-20"></i>
                    <span class="right-nav-text"><?php echo e(__("general.New Order")); ?></span>
                </div>
                <div class="clearfix">

                </div>
            </a>
        </li>
    </ul>
</div>
<!-- /Left Sidebar Menu -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.mainlayout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>