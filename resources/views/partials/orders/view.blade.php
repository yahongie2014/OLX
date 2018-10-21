<div class="row">
    <div class="col-md-12">
        <div class="panel-group accordion-struct" id="accordion_1" role="tablist" aria-multiselectable="true">
            <div class="panel panel-default">
                <div class="panel-heading activestate" role="tab" id="heading_1">
                    <a role="button" data-toggle="collapse" data-parent="#accordion_1" href="#collapse_1" aria-expanded="false">{{__('general.Search')}}</a>
                </div>
                <div id="collapse_1" class="panel-collapse collapse " role="tabpanel">
                    <div class="panel-body pa-15">
                        <div class="form-wrap">
                            <div class="form-body">
                                <div class="row">
                                    @if($loginType != PROVIDER)
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="control-label mb-10">{{__("general.Provider Name")}}  </label>
                                            <input type="text" class="form-control searchInputText"  id="provider_name"   >
                                        </div>
                                    </div>
                                    @endif
                                    @if($loginType != DRIVER)
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="control-label mb-10">{{__("general.Delivery Name")}}  </label>
                                            <input type="text" class="form-control searchInputText"  id="delivery_name" >
                                        </div>
                                    </div>
                                    @endif
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="control-label mb-10">{{__("general.Client Name")}}  </label>
                                            <input type="text" class="form-control searchInputText"  id="client_name"  >
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="control-label mb-10">{{__("general.Client Phone")}}  </label>
                                            <input type="text" class="form-control searchInputTextsearchInputText"  id="client_phone" >
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="control-label mb-10">{{__("general.Category")}}</label>
                                            <select class="selectpicker" multiple data-style="form-control btn-default btn-outline" id="category_id">
                                                @foreach($categories as $category)
                                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="control-label mb-10">{{__("general.Main Service")}}</label>
                                            <select class="selectpicker" data-style="form-control btn-default btn-outline" multiple data-style="form-control btn-default btn-outline" id="main_service_id">
                                                @foreach($services as $service)
                                                    @if($service->type == MAIN_SERVICE_TYPE)
                                                        <option value="{{$service->id}}" >{{$service->name}}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="control-label mb-10">{{__("general.Extra Services")}}</label>
                                            <select class="selectpicker" data-style="form-control btn-default btn-outline" multiple data-style="form-control btn-default btn-outline" id="extra_service_id">
                                                @foreach($services as $service)
                                                    @if($service->type == EXTRA_SERVICE_TYPE)
                                                        <option value="{{$service->id}}" >{{$service->name}}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="control-label mb-10">{{__("general.Payment Type")}}</label>
                                            <select class="selectpicker" data-style="form-control btn-default btn-outline" data-placeholder="Choose" multiple data-style="form-control btn-default btn-outline" id="payment_type_id">
                                                @foreach($paymentTypes as $paymentType)
                                                <option value="{{$paymentType->id}}" >{{$paymentType->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="control-label mb-10">{{__("general.Status")}}</label>
                                            <select class="selectpicker" data-style="form-control btn-default btn-outline" data-placeholder="Choose" multiple data-style="form-control btn-default btn-outline" id="order_status">
                                                @foreach($orderStatuses as $orderStatus)
                                                <option value="{{$loop->index}}" @if(in_array($loop->index,$selectedStatuses)) selected @endif >{{__("general." . $orderStatus)}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="control-label mb-10 text-left">{{__('general.Required at from')}}</label>
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
                                            <label class="control-label mb-10 text-left">{{__('general.Required at to')}}</label>
                                            <div class='input-group date datePickerInput' id='datetimepicker1'>
                                                <input type='text' class="form-control searchInputText" id="required_at_to"/>
                                                <span class="input-group-addon">
                                                    <span class="fa fa-calendar"></span>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="control-label mb-10">{{__("general.Order Location")}}</label>
                                            <select class="selectpicker" data-style="form-control btn-default btn-outline" id="order_location">

                                                <option value="-1"></option>
                                                <option value="{{USER_UPDATED_ORDER}}" @if(USER_UPDATED_ORDER == $selectedWithLocation) selected @endif >{{__("general.ordersWithLocation")}}</option>
                                                <option value="{{USER_NOT_UPDATED_ORDER}}" @if(USER_NOT_UPDATED_ORDER == $selectedWithLocation)) selected @endif >{{__("general.ordersWithOutLocation")}}</option>

                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-9">
                                        <div class="form-actions mt-10">
                                            <button id="doSearch" class="btn btn-success  mr-10"> {{__('general.Search')}}</button>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-actions mt-10">
                                            <button id="doClear" class="btn btn-warning  mr-10"> {{__('general.Clear')}}</button>
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
                                            <th>{{__("general.Order ID")}}</th>
                                            <th>{{__("general.Provider Name")}}</th>
                                            <th>{{__("general.Client Name")}}</th>
                                            <th>{{__("general.Delivery Name")}}</th>
                                            <th>{{__("general.Required at")}}</th>
                                            <th>{{__("general.Status")}}</th>
                                            <th>{{__("general.LastUpdatedAt")}}</th>
                                            <th>{{__("general.Edit")}}</th>
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
@section('footer')
    @parent
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
                            "{{url($editRoute)}}?page="+(info.page + 1)
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
                                result[i].delivery = { name : "{{__('general.no delivery assigned')}}"};

                            /* pase required at date time to users time zone */
                            result[i].required_at = moment(moment.utc(result[i].required_at).toDate()).format('YYYY-MM-DD HH:mm:ss');

                            /* actions */
                            result[i].action = "";
                            @if($loginType == PROVIDER)
                                result[i].action = '<a href="{{url($editRoute)}}/'+ result[i].id+'/edit" class="text-inverse pr-10" title="Edit" data-toggle="tooltip"><i class="zmdi zmdi-edit txt-warning"></i></a>';

                            @endif

                            // parse updated at to human readable
                            result[i].updated_at = moment(moment.utc(result[i].updated_at.date).toDate()).fromNow();

                            result[i].action = result[i].action
                                + '<a href="{{url($editRoute)}}/'+ result[i].id+'" class="text-inverse pr-10" title="Show" data-toggle="tooltip"><i class="zmdi zmdi-file txt-danger"></i></a>';


                            result[i].statusStyle = orderStatusRender(result[i].status);
                            result[i].status = '<span class="label label-'+result[i].statusStyle.color+' font-weight-100">'+result[i].statusStyle.name+'</span>';

                        }
                        return result;
                    }
                },
                language: {
                    "processing": "<img style='max-height: 40px;max-width: 40px' src='{{asset('/dist/img/waiting1.gif')}}' />" //add a loading image,simply putting <img src="loader.gif" /> tag.
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
                    return {name:"{{__('general.ORDER_STATUS_NEW')}}" , color:"primary"};
                    break;
                case 1:
                    return {name:"{{__('general.ORDER_STATUS_PROVIDER_CANCELLED')}}", color:"danger"};
                    break;
                case 2:
                    return {name:"{{__('general.ORDER_STATUS_DELIVERY_CANCELLED')}}", color:"danger"};
                    break;
                case 3:
                    return {name:"{{__('general.ORDER_STATUS_DELIVERY_ASSIGNED')}}", color:"primary"};
                    break;
                case 4:
                    return {name:"{{__('general.ORDER_STATUS_DELIVERY_ACCEPTED')}}", color:"warning"};
                    break;
                case 5:
                    return {name:"{{__('general.ORDER_STATUS_DELIVERY_LOADING')}}", color:"warning"};
                    break;
                case 6:
                    return {name:"{{__('general.ORDER_STATUS_DELIVERY_CONFIRMED')}}", color:"success"};
                    break;
                case 7:
                    return {name:"{{__('general.ORDER_STATUS_DELIVERY_USER_REFUSE')}}" , color:"danger"};
                    break;
                case 8:
                    return {name:"{{__('general.ORDER_STATUS_ADMIN_REFUSE')}}", color:"danger"};
                    break;
                case 9:
                    return {name:"{{__('general.ORDER_STATUS_DELIVERY_STARTED')}}", color:"success"};
                    break;
            }
        }


    </script>
@endsection