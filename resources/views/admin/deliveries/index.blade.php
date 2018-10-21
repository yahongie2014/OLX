@extends('layouts.adminlayout')

@section('PageHeader')
{{__("general.Deliveries")}}
@endsection

@section('PageLocation')
@parent

<li>
    <a href="#">
        {{__("general.Deliveries")}}
    </a>
</li>
@endsection

@section('content')
@parent
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
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="control-label mb-10">{{__("general.Name")}}  </label>
                                            <input type="text" class="form-control searchInputText"  id="delivery_name"   >
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="control-label mb-10">{{__("general.Status")}}</label>
                                            <select class="selectpicker" data-style="form-control btn-default btn-outline"  data-style="form-control btn-default btn-outline" id="deliveryStatus">
                                                <option value="" ></option>
                                                <option value="{{DELIVERY_INACTIVE}}" >{{__("general.inactive")}}</option>
                                                <option value="{{DELIVERY_ACTIVE}}" >{{__("general.active")}}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="control-label mb-10">{{__("general.available")}}</label>
                                            <select class="selectpicker" data-style="form-control btn-default btn-outline"  data-style="form-control btn-default btn-outline" id="deliveryAvailable">
                                                <option value="" ></option>
                                                <option value="{{DELIVERY_AVAILABLE}}" >{{__("general.available")}}</option>
                                                <option value="{{DELIVERY_UNAVAILABLE}}" >{{__("general.unavailable")}}</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="control-label mb-10">{{__("general.vehicle_id")}}  </label>
                                            <input type="text" class="form-control searchInputText"  id="delivery_vehicle_id"   >
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="control-label mb-10">{{__("general.license_id")}}  </label>
                                            <input type="text" class="form-control searchInputText"  id="delivery_license_id"   >
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
                            <table class="table display responsive product-overview mb-30" id="deliveriesTable">
                                <thead>
                                <tr>

                                    <th>{{__("general.delivery_id")}}</th>
                                    <th>{{__("general.Name")}}</th>
                                    <th>{{__("general.Photo")}}</th>
                                    <th>{{__("general.available")}}</th>
                                    <th>{{__("general.vehicle_id")}}</th>
                                    <th>{{__("general.license_id")}}</th>
                                    <th>{{__("general.Status")}}</th>
                                    <th>{{__("general.Change Status")}}</th>
                                    <th>{{__("general.Track")}}</th>
                                    <th>{{__("general.Show")}}</th>
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
<!-- /Row -->

@endsection

@section('footer')
@parent
<script>
    $(document).ready(function(){
        "use strict";
        var table = $('#deliveriesTable').DataTable({
            serverSide: true,
            processing: true,
            pageLength: 10,
            ajax: {

                "data": function(data){
                    var info = $('#deliveriesTable').DataTable().page.info();

                    data.delivery = $("#delivery_name").val();
                    data.deliveryStatus = $('#deliveryStatus').val();
                    data.vehicle_id = $("#delivery_vehicle_id").val();
                    data.license_id = $("#delivery_license_id").val();
                    data.deliveryAvailable = $("#deliveryAvailable").val();

                    $('#deliveriesTable').DataTable().ajax.url(
                        "{{url('/admin/delivery')}}?page="+(info.page + 1)
                    );
                },
                dataSrc: function ( json ) {
                    var result = json.result.data;
                    for ( var i=0, ien=result.length ; i<ien ; i++ ) {

                        /* Set provider user image in the table */
                        if(result[i].user.image && result[i].user.image.length > 0)
                            result[i].user.image = "{{asset('')}}" + result[i].user.image;
                        else
                            result[i].user.image = "{{asset('dist/img/user1.png')}}";
                        result[i].user.image = '<img src="' + result[i].user.image + '" alt="image" width="80" height="80" class="user-auth-img img-circle" />';



                        /* Activate or deactivate Option Should be before status parsing */
                        if(result[i].status == '{{DELIVERY_ACTIVE}}')
                            result[i].activation = '<button class="btn btn-danger btn-outline fancy-button btn-0">{{__("general.deactivate")}}</button>';
                        else
                            result[i].activation = '<button class="btn btn-success btn-outline fancy-button btn-0">{{__("general.activate")}}</button>'

                        result[i].activation = '<a href="{{url("admin/delivery/activation/")}}/' + result[i].id + '">'
                            +'<div class="form-group">'
                            + result[i].activation
                            +'</div></a>';

                        /* Set Provider Status*/

                        if(result[i].status == {{DELIVERY_ACTIVE}})
                            result[i].status = '<span class="label label-success font-weight-100">{{__("general.active")}}</span>';
                        else
                            result[i].status = '<span class="label label-danger font-weight-100">{{__("general.inactive")}}</span>'

                        /* Set the Show data Buttun */
                        result[i].profile = '<a href="{{url("admin/profile/")}}/' + result[i].user.id + '" class="text-inverse pr-10" title="Edit" data-toggle="tooltip">'
                            +'<i class="zmdi zmdi-file txt-danger"></i>'
                            +'</a>';

                        /* Set the Track data Buttun */
                        result[i].map = '<a href="{{url("admin/delivery")}}/' + result[i].id + '" class="text-inverse pr-10" target="_blank" title="Map" data-toggle="tooltip">'
                            +'<i class="zmdi zmdi-my-location txt-danger"></i>'
                            +'</a>';

                        /* Set delivery availability */
                        if(result[i].available == {{DELIVERY_AVAILABLE}})
                            result[i].available = '<span class="label label-success font-weight-100">{{__("general.available")}}</span>';
                        else
                            result[i].available = '<span class="label label-danger font-weight-100">{{__("general.unavailable")}}</span>'
                    }
                    return result;
                }
            },
            language: {
                "processing": "<img style='max-height: 40px;max-width: 40px' src='{{asset('/dist/img/waiting1.gif')}}' />" //add a loading image,simply putting <img src="loader.gif" /> tag.
            },
            columns: [
                {data: 'id' , className:"txt-dark centerCol"},
                {data: 'user.name' , className:"txt-dark centerCol"},
                {data: 'user.image' , className:"txt-dark centerCol"},
                {data: 'available' , className:"txt-dark centerCol"},
                {data: 'vehicle_id' , className:"txt-dark centerCol"},
                {data: 'license_id' , className:"txt-dark centerCol"},
                {data: 'status' , className:"txt-dark centerCol"},
                {data: 'activation' , className:"txt-dark centerCol"},
                {data: 'map' , className:"txt-dark centerCol"},
                {data: 'profile', orderable: false, searchable: false , className:"txt-dark centerCol"}
            ]
        });

        $("#doClear").click(function(){
            $(".searchInputText").val("");
            $("#providerStatus").val("").change();
        });

        $("#doSearch").click(function(){
            table.ajax.reload();
        });
    });
</script>
@endsection