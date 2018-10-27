<?php $__env->startSection('PageHeader'); ?>
    <?php echo e(__("general.Providers")); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('PageLocation'); ?>
    ##parent-placeholder-beeb47ac6f60afc7d02ef05a32eb9384e933fbd3##

    <li>
        <a href="#">
            <?php echo e(__("general.Providers")); ?>

        </a>
    </li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    ##parent-placeholder-040f06fd774092478d450774f5ba30c5da78acc8##
    <div class="row">
        <div class="col-md-12">
            <div class="panel-group accordion-struct" id="accordion_1" role="tablist" aria-multiselectable="true">
                <div class="panel panel-default">
                    <div class="panel-heading activestate" role="tab" id="heading_1">
                        <a role="button" data-toggle="collapse" data-parent="#accordion_1" href="#collapse_1"
                           aria-expanded="false"><?php echo e(__('general.Search')); ?></a>
                    </div>
                    <div id="collapse_1" class="panel-collapse collapse " role="tabpanel">
                        <div class="panel-body pa-15">
                            <div class="form-wrap">
                                <div class="form-body">

                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="control-label mb-10"><?php echo e(__("general.Name")); ?>  </label>
                                                <input type="text" class="form-control searchInputText"
                                                       id="provider_name">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="control-label mb-10"><?php echo e(__("general.Status")); ?></label>
                                                <select class="selectpicker"
                                                        data-style="form-control btn-default btn-outline"
                                                        data-style="form-control btn-default btn-outline"
                                                        id="providerStatus">
                                                    <option value=""></option>
                                                    <option value="<?php echo e(PROVIDER_INACTIVE); ?>"><?php echo e(__("general.inactive")); ?></option>
                                                    <option value="<?php echo e(PROVIDER_ACTIVE); ?>"><?php echo e(__("general.active")); ?></option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-9">
                                            <div class="form-actions mt-10">
                                                <button id="doSearch"
                                                        class="btn btn-success  mr-10"> <?php echo e(__('general.Search')); ?></button>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-actions mt-10">
                                                <button id="doClear"
                                                        class="btn btn-warning  mr-10"> <?php echo e(__('general.Clear')); ?></button>
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
    <!-- Row -->
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default card-view">
                <div class="panel-wrapper collapse in">
                    <div class="panel-body row">
                        <div class="row">
                            <div class="col-sm-4">
                                <a href="<?php echo e(url('/admin/users/admin/create')); ?>" >
                                    <button class="btn btn-success btn-block btn-rounded btn-outline  btn-success">
                                        <?php echo e(__("general.Create_New_Admin")); ?>

                                    </button>
                                </a>
                            </div>
                        </div>

                        <div class="table-wrap">
                            <div class="table-responsive">
                                <table class="table display responsive product-overview mb-30" id="providersTable">
                                    <thead>
                                    <tr>
                                        <th><?php echo e(__("general.Provider_id")); ?></th>
                                        <th><?php echo e(__("general.Name")); ?></th>
                                        <th><?php echo e(__("general.Email")); ?></th>
                                        <th><?php echo e(__("general.Photo")); ?></th>
                                        <th><?php echo e(__("general.Status")); ?></th>
                                        <th><?php echo e(__("general.Change Status")); ?></th>
                                        <th><?php echo e(__("general.Show")); ?></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $__currentLoopData = $admins; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                        <td><?php echo e($user->id); ?></td>
                                        <td><?php echo e($user->name); ?></td>
                                        <td><?php echo e($user->email); ?></td>
                                        <td>
                                            <img src=<?php if($user->image): ?>
                                                    "<?php echo e(asset(\Storage::url('Avatar/'.$user->image))); ?>"
                                                 <?php else: ?> <?php echo e(asset("dist/img/user1.png")); ?>

                                                 <?php endif; ?> alt="user_auth"
                                                 class="user-auth-img img-circle"/>
                                        <td>
                                            <?php if($user->is_verify == 0): ?>
                                                <span class="label label-danger font-weight-100"><?php echo e(__("general.inactive")); ?></span>
                                            <?php else: ?>
                                                <span class="label label-success font-weight-100"><?php echo e(__("general.active")); ?></span>
                                                <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php if($user->is_verify == 0): ?>
                                                <a href="<?php echo e(url("admin/activation/$user->id")); ?>">
                                                    <button class="btn btn-success btn-outline fancy-button btn-0"><?php echo e(__("general.activate")); ?></button>
                                                </a>
                                            <?php else: ?>
                                                <a href="<?php echo e(url("admin/activation/$user->id")); ?>">
                                                    <button class="btn btn-danger btn-outline fancy-button btn-0"><?php echo e(__("general.deactivate")); ?></button>
                                                </a>

                                            <?php endif; ?>

                                        </td>
                                        <td>
                                            <a href="<?php echo e(url("admin/profile/$user->id")); ?>" class="text-inverse pr-10"
                                               title="Edit" data-toggle="tooltip">
                                                <i class="zmdi zmdi-file txt-danger"></i>
                                            </a>
                                        </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>

                                </table>
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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.adminlayout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>