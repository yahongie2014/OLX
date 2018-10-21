<!-- Row -->
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default card-view">
            <div class="panel-wrapper collapse in">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-sm-12 col-xs-12">

                            <div class="form-wrap">
                                <form action="{{url('/admin/orders/refuse')}}" method="POST">
                                    <input type="hidden" name="selected_order_id" value="{{$order->id}}" />
                                    {{ csrf_field() }}
                                    <div class="form-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <h6 class="txt-dark capitalize-font"><i class="zmdi zmdi-account mr-10"></i>{{__("general.Order Status")}}</h6>
                                                <hr class="light-grey-hr"/>
                                                @if ($errors->has('order_id'))
                                                <div class="alert alert-danger alert-dismissable alert-style-1">
                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                    <i class="zmdi zmdi-alert-circle-o"></i>{{ $errors->first('order_id') }}
                                                </div>
                                                @endif
                                            </div>
                                            <div class="col-md-6">

                                                <div class="form-group">
                                                    <label class="control-label mb-10"></label>

                                                    <p class="text-primary mb-10">{{__("general.".StaticArray::$orderStatus[$order->status])}}</code></p>
                                                </div>
                                            </div>
                                            @if($userType == ADMIN)
                                            <div class="col-md-6 {{ $errors->has('selected_order_id') ? ' has-error' : '' }}">
                                                <div class="form-group" style="text-align: left;">
                                                    <button type="submit" class="btn btn-warning btn-lable-wrap left-label"> <span class="btn-label"><i class="fa fa-exclamation-triangle"></i> </span><span class="btn-text">{{__('general.Refuse Order')}}</span></button>
                                                </div>

                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                </form>
                            </div>
                            @if($userType != USER)
                            <div class="form-wrap">
                                <form action="{{url('/admin/orders/assign')}}" method="POST">
                                    <input type="hidden" name="selected_order_id_to_assign" value="{{$order->id}}" />
                                    {{ csrf_field() }}
                                    <div class="form-body">
                                        <div class="row">
                                            @if(is_object($availableDelivery))
                                            <div class="col-md-6">

                                                <div class="form-group {{ $errors->has('delivery_id') ? ' has-error' : '' }}">
                                                    <label class="control-label mb-10">{{__("general.Assign Delivery")}}</label>
                                                    <select class="form-control select2" name="delivery_id" >
                                                        <option value=""></option>
                                                        @foreach($availableDelivery as $delivery)
                                                        <option value="{{$delivery->id}}" >{{$delivery->user->name}}</option>
                                                        @endforeach
                                                    </select>
                                                    @if ($errors->has('delivery_id'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('delivery_id') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                                <div class="form-group" >
                                                    <button type="submit" class="btn btn-primary btn-lable-wrap left-label">

                                                        <span class="btn-text">{{__('general.Assign Delivery')}}</span></button>
                                                </div>
                                            </div>


                                            @else
                                            <div class="col-md-6">
                                                <div class="alert alert-danger alert-dismissable alert-style-1">
                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                    <i class="zmdi zmdi-alert-circle-o"></i>{{ $availableDelivery }}
                                                </div>
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                </form>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Row -->

<!-- Row -->
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="panel panel-default card-view">
                    <div class="panel-heading">
                        <div class="pull-left">
                            <h6 class="panel-title txt-dark">{{__("general.Order Info")}}</h6>
                        </div>

                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-wrapper collapse in">
                        <div class="panel-body">
                            <div>
                                <span class="pull-left inline-block capitalize-font txt-dark">
                                    {{__('general.Order ID')}}
                                </span>
                                <span class="label label-warning pull-right">&nbsp;&nbsp;{{$order->id}}&nbsp;&nbsp; </span>
                                <div class="clearfix"></div>
                                <hr class="light-grey-hr row mt-10 mb-10"/>

                                <span class="pull-left inline-block capitalize-font txt-dark">
                                    {{__('general.created_at')}}
                                </span>
                                <span class="label label-danger pull-right timefield">&nbsp;&nbsp;{{$order->created_at}}&nbsp;&nbsp; </span>
                                <div class="clearfix"></div>
                                <hr class="light-grey-hr row mt-10 mb-10"/>

                                <span class="pull-left inline-block capitalize-font txt-dark">
                                    {{__('general.updated_at')}}
                                </span>
                                <span class="label label-danger pull-right timefield">&nbsp;&nbsp;{{$order->updated_at}}&nbsp;&nbsp; </span>
                                <div class="clearfix"></div>
                                <hr class="light-grey-hr row mt-10 mb-10"/>

                                @if($order->required_at)
                                <span class="pull-left inline-block capitalize-font txt-dark">
                                    {{__('general.required_at')}}
                                </span>
                                <span class="label label-danger pull-right timefield">&nbsp;&nbsp;{{$order->required_at}}&nbsp;&nbsp; </span>
                                <div class="clearfix"></div>
                                <hr class="light-grey-hr row mt-10 mb-10"/>
                                @endif

                                @if($order->assigned_at)
                                <span class="pull-left inline-block capitalize-font txt-dark">
                                    {{__('general.assigned_at')}}
                                </span>
                                <span class="label label-danger pull-right timefield">&nbsp;&nbsp;{{$order->assigned_at}} &nbsp;&nbsp; </span>
                                <div class="clearfix"></div>
                                <hr class="light-grey-hr row mt-10 mb-10"/>
                                @endif

                                @if($order->loading_at)
                                <span class="pull-left inline-block capitalize-font txt-dark">
                                    {{__('general.loading_at')}}
                                </span>
                                <span class="label label-danger pull-right timefield">&nbsp;&nbsp;{{$order->loading_at}} &nbsp;&nbsp; </span>
                                <div class="clearfix"></div>
                                <hr class="light-grey-hr row mt-10 mb-10"/>
                                @endif

                                @if($order->delivered_at)
                                <span class="pull-left inline-block capitalize-font txt-dark">
                                    {{__('general.delivered_at')}}
                                </span>
                                <span class="label label-danger pull-right timefield">&nbsp;&nbsp;{{$order->delivered_at}} &nbsp;&nbsp; </span>
                                <div class="clearfix"></div>
                                <hr class="light-grey-hr row mt-10 mb-10"/>
                                @endif

                                <!--<span class="pull-left inline-block capitalize-font txt-dark">
                                    {{__('general.Client Information')}}
                                </span>

                                <div class="clearfix"></div>
                                <hr class="light-grey-hr row mt-10 mb-10"/>
-->

                                <span class="pull-left inline-block capitalize-font txt-dark">
                                    {{__('general.Client Name')}}
                                </span>
                                <span class="label label-danger pull-right">&nbsp;&nbsp;{{$order->client_name}}&nbsp;&nbsp; </span>
                                <div class="clearfix"></div>
                                <hr class="light-grey-hr row mt-10 mb-10"/>

                                <span class="pull-left inline-block capitalize-font txt-dark">
                                    {{__('general.Client Phone')}}
                                </span>
                                <span class="label label-danger pull-right">&nbsp;&nbsp;{{$order->client_phone}}&nbsp;&nbsp; </span>
                                <div class="clearfix"></div>
                                <hr class="light-grey-hr row mt-10 mb-10"/>

                                <span class="pull-left inline-block capitalize-font txt-dark">
                                    {{__('general.Category')}}
                                </span>
                                <span class="label label-danger pull-right">&nbsp;&nbsp;{{$order->category->name}}&nbsp;&nbsp; </span>
                                <div class="clearfix"></div>
                                <hr class="light-grey-hr row mt-10 mb-10"/>


                                <span class="pull-left inline-block capitalize-font txt-dark">
                                    {{__('general.Client Address')}}
                                </span>
                                <span class="label label-danger pull-right">&nbsp;&nbsp;{{$order->client_address}}&nbsp;&nbsp; </span>
                                <div class="clearfix"></div>
                                <hr class="light-grey-hr row mt-10 mb-10"/>



                                <span class="pull-left inline-block capitalize-font txt-dark">
                                    {{__('general.Details')}}
                                </span>
                                <span class="label label-danger pull-right">&nbsp;&nbsp;{{$order->details}}&nbsp;&nbsp; </span>
                                <div class="clearfix"></div>
                                <hr class="light-grey-hr row mt-10 mb-10"/>


                                <span class="pull-left inline-block capitalize-font txt-dark">
                                    {{__('general.Order Price')}}
                                </span>
                                <span class="label label-danger pull-right">&nbsp;&nbsp;{{$order->price}}&nbsp;&nbsp; </span>
                                <div class="clearfix"></div>
                                <hr class="light-grey-hr row mt-10 mb-10"/>

                                <span class="pull-left inline-block capitalize-font txt-dark">
                                    {{__('general.Order Paid')}}
                                </span>
                                <span class="label label-danger pull-right">&nbsp;&nbsp;{{$order->paid}}&nbsp;&nbsp; </span>
                                <div class="clearfix"></div>
                                <hr class="light-grey-hr row mt-10 mb-10"/>



                                <span class="pull-left inline-block capitalize-font txt-dark">
                                    {{__('general.Main Service')}}
                                </span>
                                <span class="label label-danger pull-right">&nbsp;&nbsp;{{$order->main_service_type_cost}}&nbsp;&nbsp; </span>&nbsp;&nbsp;
                                <span class="label label-danger pull-right">&nbsp;&nbsp;{{$order->main_service_type->name}}&nbsp;&nbsp; </span>

                                <div class="clearfix"></div>
                                <hr class="light-grey-hr row mt-10 mb-10"/>

                                <span class="pull-left inline-block capitalize-font txt-dark">
                                    {{__('general.Payment Type')}}
                                </span>
                                <span class="label label-danger pull-right">&nbsp;&nbsp;{{$order->payment_type_cost}}&nbsp;&nbsp; </span>&nbsp;&nbsp;
                                <span class="label label-danger pull-right">&nbsp;&nbsp;{{$order->payment_type->name}}&nbsp;&nbsp; </span>

                                <div class="clearfix"></div>
                                <hr class="light-grey-hr row mt-10 mb-10"/>

                                <span class="pull-left inline-block capitalize-font txt-dark">
                                    {{__('general.Extra Services')}}
                                </span>
                                @foreach($order->extra_service_type as $extraService)
                                    <span class="label label-danger pull-right">&nbsp;&nbsp;{{$extraService->pivot->price}}&nbsp;&nbsp; </span> &nbsp;&nbsp;
                                    <span class="label label-danger pull-right">&nbsp;&nbsp;{{$extraService->name}}&nbsp;&nbsp; </span>

                                    <div class="clearfix"></div>
                                @endforeach
                                <span class="label label-danger pull-right">&nbsp;&nbsp;{{$order->extra_service_type_cost}}&nbsp;&nbsp; </span>
                                <div class="clearfix"></div>
                                <hr class="light-grey-hr row mt-10 mb-10"/>

                                <span class="pull-left inline-block capitalize-font txt-dark">
                                    {{__('general.Order total cost')}}
                                </span>
                                <span class="label label-danger pull-right">&nbsp;&nbsp;{{$order->total_cost}}&nbsp;&nbsp; </span>
                                <div class="clearfix"></div>
                                <hr class="light-grey-hr row mt-10 mb-10"/>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="panel panel-success contact-card card-view">
                    <div class="panel-heading">
                        <div class="pull-left">
                            <div class="pull-left user-img-wrap mr-15">
                                <img class="card-user-img img-circle pull-left" src=@if($order->provider->user->image) "{{asset($order->provider->user->image)}}" @else "{{asset('dist/img/user1.png')}}" @endif alt="user"/>
                            </div>
                            <div class="pull-left user-detail-wrap">
											<span class="block card-user-name">
												{{$order->provider->user->name}}
											</span>
                                <span class="block card-user-desn">
												{{__('general.Provider')}}
											</span>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-wrapper collapse in">
                        <div class="panel-body row">
                            <div class="user-others-details pl-15 pr-15">
                                <div class="mb-15">
                                    <i class="zmdi zmdi-email-open inline-block mr-10"></i>
                                    <span class="inline-block txt-dark">{{$order->provider->user->email}}</span>
                                </div>

                                <div class="mb-15">
                                    <i class="zmdi zmdi-phone inline-block mr-10"></i>
                                    <span class="inline-block txt-dark">{{$order->provider->user->phone}}</span>
                                </div>
                                <div>
                                    <i class="zmdi zmdi zmdi-home inline-block mr-10"></i>
                                    <span class="inline-block txt-dark">{{$order->provider->user->address}}</span>
                                </div>
                            </div>
                            <hr class="light-grey-hr mt-20 mb-20"/>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="panel panel-primary contact-card card-view">
                    <div class="panel-heading">
                        <div class="pull-left">
                            <div class="pull-left user-img-wrap mr-15">
                                <img class="card-user-img img-circle pull-left" src="{{asset('dist/img/user1.png')}}" alt="user"/>
                            </div>
                            <div class="pull-left user-detail-wrap">

                                    @if($order->delivery)
                                        <span class="block card-user-name">
                                            {{$order->delivery->user->name}}
                                        </span>
                                        <span class="block card-user-desn">
                                            {{__('general.Delivery')}}
                                        </span>
                                    @else
                                        <span class="block card-user-name">
                                            {{__('general.no delivery assigned')}}
                                        </span>
                                    @endif
                            </div>
                        </div>
                        <div class="pull-right">
                            <div class="pull-left inline-block dropdown">
                                @if($userType == DRIVER)
                                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false" role="button">
                                        <i class="zmdi zmdi-more-vert txt-light"></i>
                                    </a>
                                    <ul class="dropdown-menu bullet dropdown-menu-right"  role="menu">
                                        @foreach($order->possible_steps as $possibleStep)
                                            <li role="presentation">
                                                <a href="{{url('/delivery/orders/status/' . $order->id . '/' . $possibleStep)}}" role="menuitem">
                                                    <i class="icon wb-reply" aria-hidden="true"></i>{{__("general.".StaticArray::$orderDeliverySteps[$possibleStep])}}
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-wrapper collapse in">
                        <div class="panel-body row">
                            <div class="user-others-details pl-15 pr-15">
                                @if($order->delivery)
                                    <div class="mb-15">
                                        <i class="zmdi zmdi-email-open inline-block mr-10"></i>
                                        <span class="inline-block txt-dark">{{@$order->delivery->user->email}}</span>
                                    </div>

                                    <div class="mb-15">
                                        <i class="zmdi zmdi-phone inline-block mr-10"></i>
                                        <span class="inline-block txt-dark">{{@$order->delivery->user->phone}}</span>
                                    </div>
                                @endif
                            </div>
                            <hr class="light-grey-hr mt-20 mb-20"/>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="panel panel-default card-view">
                    <div class="panel-wrapper collapse in">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <form action="{{url('/user/order/' . $order->id . '/' . $order->user_verification)}}" method="POST">
                                        {{ csrf_field() }}
                                        <div class="form-group">
                                            <input type="hidden" id="orderLat" name="order_lat" @if(old('order_lat')) value="{{old('order_lat')}}" @else value="{{$order->order_lat}}" @endif />
                                            <input type="hidden" id="orderLong" name="order_long" @if(old('order_long')) value="{{old('order_long')}}" @else value="{{$order->order_long}}" @endif/>
                                            <label class="control-label mb-10">{{__("general.Order Location")}}  </label>
                                            <div id="googleMap" style="width:100%;height:400px;"></div>
                                        </div>
                                        @if($userType == USER && $order->user_updated != USER_UPDATED_ORDER)
                                            <div class="form-actions mt-10">
                                                <button type="submit" class="btn btn-success  mr-10"> {{__('general.Save')}}</button>
                                            </div>
                                        @endif
                                    </form>
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
@if($userType != USER || $order->user_updated == USER_UPDATED_ORDER)
        <script>

            function myMap() {
                var myCenter = new google.maps.LatLng("{{$order->order_lat}}","{{$order->order_long}}");
                var mapCanvas = document.getElementById("googleMap");
                var mapOptions = {center: myCenter, zoom: 7};
                var map = new google.maps.Map(mapCanvas, mapOptions);
                var marker = new google.maps.Marker({position:myCenter});
                marker.setMap(map);
            }
        </script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDgIKx-8qqL3I3a-cVETwnf2UbgVzm1zus&callback=myMap"></script>
@elseif($userType == USER)
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDgIKx-8qqL3I3a-cVETwnf2UbgVzm1zus&callback"></script>
        <script>
            var order_lat = document.getElementById('orderLat').value && document.getElementById('orderLong').value ? document.getElementById('orderLat').value : 26.745610382199025;
            var order_long = document.getElementById('orderLat').value && document.getElementById('orderLong').value ? document.getElementById('orderLong').value : 43.9453125;

            console.log("lat : " + order_lat);
            console.log("long : " + order_long);

            var map,
                marker = null;

            function initialize() {

                var mapOptions = {
                    zoom: 7,
                    center: new google.maps.LatLng(order_lat,order_long),
                    /*mapTypeId: google.maps.MapTypeId.TERRAIN*/
                };

                marker = new google.maps.Marker({position:mapOptions.center});

                map = new google.maps.Map(document.getElementById('googleMap'), mapOptions);
                marker.setMap(map);

                google.maps.event.addListener(map, 'click', function(event) {
                    if (marker==null) {
                        marker = new google.maps.Marker({
                            position : event.latLng,
                            map: map
                        });

                    } else {
                        marker.setPosition(event.latLng);
                    }
                    document.getElementById('orderLat').value = event.latLng.lat();
                    document.getElementById('orderLong').value = event.latLng.lng();
                });
            }
            //initialize();
            google.maps.event.addDomListener(window, 'load', initialize);
        </script>
@endif
<script>
    $(document).ready(function(){
        "use strict";
        /* Select2 Init*/
        $(".select2").select2();

        $('.timefield').each(function(){
            if($(this).text())
                $(this).text(moment(moment.utc($(this).text()).toDate()).format('YYYY-MM-DD HH:mm:ss'));
        })
    });
</script>
@endsection