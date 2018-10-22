<?php $__env->startSection('PageHeader'); ?>
<?php echo e(__("general.Profile")); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('PageLocation'); ?>
##parent-placeholder-beeb47ac6f60afc7d02ef05a32eb9384e933fbd3##

<li>
    <a href="<?php echo e(url('/vendors/profile/' . Auth::user()->id)); ?>">
        <?php echo e(__("general.Profile")); ?>

    </a>
</li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
##parent-placeholder-040f06fd774092478d450774f5ba30c5da78acc8##
<?php echo $__env->make('partials.user.show', ['user' => $user , 'loginType' => 2], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.providerlayout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>