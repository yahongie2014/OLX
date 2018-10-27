<div class="row">
    <div class="col-md-12">
        <div class="panel-group accordion-struct" id="accordion_1" role="tablist" aria-multiselectable="true">
            <div class="panel panel-default">
                <div class="panel-heading activestate" role="tab" id="heading_1">
                    <a role="button" data-toggle="collapse" data-parent="#accordion_1" href="#collapse_1" aria-expanded="false"><?php echo e(__('general.Search')); ?></a>
                </div>
                <div id="collapse_1" class="panel-collapse collapse " role="tabpanel">
                    <div class="panel-body pa-15">
                        <div class="form-wrap">
                            <div class="form-body">
                                <div class="row">
                                    <?php if(Auth::user()->is_vendor != 1): ?>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="control-label mb-10"><?php echo e(__("general.Provider Name")); ?>  </label>
                                            <input type="text" class="form-control searchInputText"  id="provider_name"   >
                                        </div>
                                    </div>
                                    <?php endif; ?>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="control-label mb-10"><?php echo e(__("general.Client Name")); ?>  </label>
                                            <input type="text" class="form-control searchInputText"  id="client_name"  >
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="control-label mb-10"><?php echo e(__("general.Client Phone")); ?>  </label>
                                            <input type="text" class="form-control searchInputTextsearchInputText"  id="client_phone" >
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="control-label mb-10"><?php echo e(__("general.Category")); ?></label>
                                            <select class="selectpicker" multiple data-style="form-control btn-default btn-outline" id="category_id">
                                                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($category->id); ?>"><?php echo e($category->name); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="control-label mb-10"><?php echo e(__("general.Main Service")); ?></label>
                                            <select class="selectpicker" data-style="form-control btn-default btn-outline" multiple data-style="form-control btn-default btn-outline" id="main_service_id">
                                                <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php if($service->type == MAIN_SERVICE_TYPE): ?>
                                                        <option value="<?php echo e($service->id); ?>" ><?php echo e($service->name); ?></option>
                                                    <?php endif; ?>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="control-label mb-10"><?php echo e(__("general.Extra Services")); ?></label>
                                            <select class="selectpicker" data-style="form-control btn-default btn-outline" multiple data-style="form-control btn-default btn-outline" id="extra_service_id">
                                                <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php if($service->is_active == 1): ?>
                                                        <option value="<?php echo e($service->id); ?>" ><?php echo e($service->name); ?></option>
                                                    <?php endif; ?>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="control-label mb-10"><?php echo e(__("general.Payment Type")); ?></label>
                                            <select class="selectpicker" data-style="form-control btn-default btn-outline" data-placeholder="Choose" multiple data-style="form-control btn-default btn-outline" id="payment_type_id">
                                                <?php $__currentLoopData = $paymentTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $paymentType): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($paymentType->id); ?>" ><?php echo e($paymentType->name); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>
                                    </div>
                                    
                                        
                                            
                                            
                                                
                                                
                                                
                                            
                                        
                                    
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="control-label mb-10 text-left"><?php echo e(__('general.Required at from')); ?></label>
                                            <div class='input-group date datePickerInput' id='datetimepicker1'>
                                                <input type='text'   class="form-control searchInputText" id="required_at_from"/>
                                                <span class="input-group-addon">
                                                    <span class="fa fa-calendar"></span>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="control-label mb-10 text-left"><?php echo e(__('general.Required at to')); ?></label>
                                            <div class='input-group date datePickerInput' id='datetimepicker1'>
                                                <input type='text' class="form-control searchInputText" id="required_at_to"/>
                                                <span class="input-group-addon">
                                                    <span class="fa fa-calendar"></span>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-9">
                                        <div class="form-actions mt-10">
                                            <button id="doSearch" class="btn btn-success  mr-10"> <?php echo e(__('general.Search')); ?></button>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-actions mt-10">
                                            <button id="doClear" class="btn btn-warning  mr-10"> <?php echo e(__('general.Clear')); ?></button>
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
                    <div class="table-wrap">
                        <div class="table-responsive">
                            <div class="row">
                                <div class="col-sm-12">
                                    <table class="table display responsive product-overview mb-30" id="myTable">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th><?php echo e(__("general.Order ID")); ?></th>
                                            <th><?php echo e(__("general.Provider Name")); ?></th>
                                            <th><?php echo e(__("general.Client Name")); ?></th>
                                            <th><?php echo e(__("general.Required at")); ?></th>
                                            <th><?php echo e(__("general.Status")); ?></th>
                                            <th><?php echo e(__("general.LastUpdatedAt")); ?></th>
                                            <th><?php echo e(__("general.Edit")); ?></th>
                                        </tr>
                                        </thead>
                                    </table>
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
<?php $__env->startSection('footer'); ?>
    ##parent-placeholder-d7eb6b340a11a367a1bec55e4a421d949214759f##
    <script>
        $(document).ready(function(){
            "use strict";
            //$('#order_status').selectpicker('val', ['Mustard','Relish']);
            $("#doClear").click(function(){

                $(".selectpicker").selectpicker('deselectAll');
                $(".searchInputText").val("");
                $("#order_location").val("-1").change();
            });
            $('.datePickerInput').datetimepicker({
                useCurrent: false,
                format : "YYYY-MM-DD HH:mm:ss",
                icons: {
                    time: "fa fa-clock-o",
                    date: "fa fa-calendar",
                    up: "fa fa-arrow-up",
                    down: "fa fa-arrow-down"
                },

            })

            var table = $('#myTable').DataTable({
                serverSide: true,
                processing: true,
                pageLength: 10,
                ajax: {
                    /*"error": function (xhr, error, thrown) {
                        console.log(error);
                        return false;
                        //alert( 'You are not logged in' );
                    },*/
                    "data": function( data ){
                        var info = $('#myTable').DataTable().page.info();

                        data.provider = $("#provider_name").val();
                        data.delivery = $("#delivery_name").val();
                        data.client_name = $("#client_name").val();
                        data.client_phone = $("#client_phone").val();

                        data.category_id = $("select#category_id").val();
                        data.required_at_from = $("#required_at_from").val();
                        data.required_at_to = $("#required_at_to").val();
                        data.extra_service_id = $("select#extra_service_id").val();
                        data.main_service_id = $("select#main_service_id").val();
                        data.payment_type_id = $("select#payment_type_id").val();
                        data.order_status = $("select#order_status").val();

                        if($('#order_location').val() != -1){
                            data.order_location = $('#order_location').val();
                        }
                        $('#myTable').DataTable().ajax.url(
                            "<?php echo e(url($editRoute)); ?>?page="+(info.page + 1)
                        );
                    },
                    dataSrc: function ( json ) {
                        if(json.error)
                            return false;

                        var result = json.result.data;
                        for ( var i=0, ien=result.length ; i<ien ; i++ ) {

                            /* serial No */
                            result[i].sn = i +1 ;

                            /* DELIVERY NAME IF ASSIGNED ONE*/
                            if(result[i].delivery == null)
                                result[i].delivery = { name : "<?php echo e(__('general.no delivery assigned')); ?>"};

                            /* pase required at date time to users time zone */
                            result[i].required_at = moment(moment.utc(result[i].required_at).toDate()).format('YYYY-MM-DD HH:mm:ss');

                            /* actions */
                            result[i].action = "";
                            <?php if($loginType == PROVIDER): ?>
                                result[i].action = '<a href="<?php echo e(url($editRoute)); ?>/'+ result[i].id+'/edit" class="text-inverse pr-10" title="Edit" data-toggle="tooltip"><i class="zmdi zmdi-edit txt-warning"></i></a>';

                            <?php endif; ?>

                            // parse updated at to human readable
                            result[i].updated_at = moment(moment.utc(result[i].updated_at.date).toDate()).fromNow();

                            result[i].action = result[i].action
                                + '<a href="<?php echo e(url($editRoute)); ?>/'+ result[i].id+'" class="text-inverse pr-10" title="Show" data-toggle="tooltip"><i class="zmdi zmdi-file txt-danger"></i></a>';


                            result[i].statusStyle = orderStatusRender(result[i].status);
                            result[i].status = '<span class="label label-'+result[i].statusStyle.color+' font-weight-100">'+result[i].statusStyle.name+'</span>';

                        }
                        return result;
                    }
                },
                language: {
                    "processing": "<img style='max-height: 40px;max-width: 40px' src='<?php echo e(asset('/dist/img/waiting1.gif')); ?>' />" //add a loading image,simply putting <img src="loader.gif" /> tag.
                },
                columns: [
                    {data: 'sn' , className:"txt-dark centerCol"},
                    {data: 'id' , className:"txt-dark centerCol" },
                    {data: 'provider.name' , className:"txt-dark centerCol"  },
                    {data: 'client_name' , className:"txt-dark centerCol"  },
                    {data: 'delivery.name' , className:"txt-dark centerCol" },
                    {data: 'required_at' , className:"txt-dark centerCol"  },
                    {data: 'status' , className:"txt-dark centerCol"},
                    {data: 'updated_at' , className:"txt-dark centerCol"},
                    {data: 'action', orderable: false, searchable: false , className:"txt-dark centerCol"}
                ]
            });

            $("#doSearch").click(function(){
                table.ajax.reload();
            });

        });

        function orderStatusRender(statusKey){
            switch (statusKey){
                case 0:
                    return {name:"<?php echo e(__('general.ORDER_STATUS_NEW')); ?>" , color:"primary"};
                    break;
                case 1:
                    return {name:"<?php echo e(__('general.ORDER_STATUS_PROVIDER_CANCELLED')); ?>", color:"danger"};
                    break;
                case 2:
                    return {name:"<?php echo e(__('general.ORDER_STATUS_DELIVERY_CANCELLED')); ?>", color:"danger"};
                    break;
                case 3:
                    return {name:"<?php echo e(__('general.ORDER_STATUS_DELIVERY_ASSIGNED')); ?>", color:"primary"};
                    break;
                case 4:
                    return {name:"<?php echo e(__('general.ORDER_STATUS_DELIVERY_ACCEPTED')); ?>", color:"warning"};
                    break;
                case 5:
                    return {name:"<?php echo e(__('general.ORDER_STATUS_DELIVERY_LOADING')); ?>", color:"warning"};
                    break;
                case 6:
                    return {name:"<?php echo e(__('general.ORDER_STATUS_DELIVERY_CONFIRMED')); ?>", color:"success"};
                    break;
                case 7:
                    return {name:"<?php echo e(__('general.ORDER_STATUS_DELIVERY_USER_REFUSE')); ?>" , color:"danger"};
                    break;
                case 8:
                    return {name:"<?php echo e(__('general.ORDER_STATUS_ADMIN_REFUSE')); ?>", color:"danger"};
                    break;
                case 9:
                    return {name:"<?php echo e(__('general.ORDER_STATUS_DELIVERY_STARTED')); ?>", color:"success"};
                    break;
            }
        }


    </script>
<?php $__env->stopSection(); ?>