<!-- Row -->
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default card-view">
            <div class="panel-heading">
                <div class="pull-left">
                    <h6 class="panel-title txt-dark"></h6>
                </div>
                <div class="pull-left">
                    <h6 class="txt-dark">{{__('general.Order ID')}} #&nbsp;{{$order->id}}&nbsp;</h6>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="panel-wrapper collapse in">
                <div class="panel-body">
                    <div class="row">
                        <!-- Client Information -->
                        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 text-right">
                            <span class="txt-dark head-font inline-block capitalize-font mb-5"><h5 class="text-primary">{{__('general.Client Information')}} : </h5></span>

                            <address class="mb-15">
                                <span class="address-head mb-5">{{$order->client_name}}</span>
                                <span class="txt-dark head-font inline-block capitalize-font mb-5"><h5 class="text-success">{{$order->city->name}}</h5></span><br>

                                <i class="zmdi zmdi-phone inline-block mr-10"></i>
                                <span class="inline-block">{{$order->client_phone}}</span><br>

                                <i class="zmdi zmdi zmdi-home inline-block mr-10"></i>
                                <span class="inline-block">{{$order->client_address}}</span>
                            </address>

                            <br/>
                        </div>
                        <!-- /Client -->

                        <!-- Provider Information -->
                        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 text-right">
                            <span class="txt-dark head-font inline-block capitalize-font mb-5"><h5 class="text-primary">{{__('general.Provider')}} : </h5></span>
                            <address class="mb-15">
                                <span class="address-head mb-5">{{$order->provider->user->name}}</span>

                                <i class="zmdi zmdi-email-open inline-block mr-10"></i>
                                <span class="inline-block">{{$order->provider->user->email}}</span> <br>

                                <i class="zmdi zmdi-phone inline-block mr-10"></i>
                                <span class="inline-block">{{$order->provider->user->phone}}</span><br>

                                <i class="zmdi zmdi zmdi-home inline-block mr-10"></i>
                                <span class="inline-block">{{$order->provider->user->address}}</span>
                            </address>
                        </div>
                        <!-- /Provider -->

                        <!-- Delivery Information if assigned -->
                        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 text-right">
                            <span class="txt-dark head-font inline-block capitalize-font mb-5"><h5 class="text-primary">{{__('general.Delivery')}} : </h5></span>
                            <address class="mb-15">
                                @if($order->delivery)
                                    <span class="address-head mb-5">{{$order->delivery->user->name}}</span>

                                    <i class="zmdi zmdi-email-open inline-block mr-10"></i>
                                    <span class="inline-block">{{$order->delivery->user->email}}</span> <br>

                                    <i class="zmdi zmdi-phone inline-block mr-10"></i>
                                    <span class="inline-block">{{$order->delivery->user->phone}}</span><br>

                                    <i class="zmdi zmdi zmdi-home inline-block mr-10"></i>
                                    <span class="inline-block">{{$order->delivery->user->address}}</span>
                                @else
                                <span class="address-head mb-5"><h5 class="text-danger"> {{__('general.no delivery assigned')}} </h5></span>
                                @endif
                            </address>
                        </div>
                        <!-- /Delivery -->
                    </div>

                    <div class="row">
                        <div class="col-lg-4 col-md-8 col-sm-6 col-xs-12">
                            <address>
                                <span class="txt-dark head-font capitalize-font mb-5">
                                    <h5 class="text-primary">
                                        {{__('general.Category')}} :
                                    </h5>
                                </span>

                                <span class="address-head mb-5">
                                    <h6>{{$order->category->name}}</h6>
                                </span><br>
                            </address>
                        </div>
                        @if($order->loading_id)
                        <div class="col-lg-4 col-md-8 col-sm-6 col-xs-12">
                            <address>
                                <span class="txt-dark head-font capitalize-font mb-5">
                                    <h5 class="text-primary">
                                        {{__('general.providerLoading')}} :
                                    </h5>
                                </span>

                                <span class="address-head mb-5">
                                    <h6>{{$order->loading->name}}</h6>
                                </span>
                                <address class="mb-15">
                                    {{$order->loading->address}}
                                </address>
                            </address>
                        </div>
                        @endif
                        @if($order->car_type)
                        <div class="col-lg-4 col-md-8 col-sm-6 col-xs-12">
                            <address>
                                <span class="txt-dark head-font capitalize-font mb-5">
                                    <h5 class="text-primary">
                                        {{__('general.CarType')}} :
                                    </h5>
                                </span>

                                <span class="address-head mb-5">
                                    <h6>{{$order->car_type->name}}</h6>
                                </span>

                            </address>
                        </div>
                        @endif
                    </div>
                    <div class="row">
                        <div class="col-lg-8 col-md-8 col-sm-6 col-xs-12 text-right">
                            <address>
                                <span class="txt-dark head-font capitalize-font mb-5">
                                    <h5 class="text-primary">
                                        {{__('general.Details')}} :
                                    </h5>
                                </span>

                                <span class="address-head mb-5">{{$order->details}}</span><br>
                            </address>
                        </div>
                    </div>

                    <div class="seprator-block"></div>

                    <div class="invoice-bill-table">
                        <div class="row">

                            <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <tbody>
                                        <tr class="txt-dark">
                                            <td>
                                                <h5>
                                                    {{__('general.Order Price')}}
                                                </h5>
                                            </td>

                                            <td class="centerCol">{{$order->price}}</td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <h5>
                                                    {{__('general.Main Service')}}
                                                </h5>
                                            </td>

                                            <td></td>
                                            <td>{{__("general.discount")}}</td>
                                        </tr>
                                        <tr>

                                            <td style="text-align: left">{{$order->main_service_type->name}}</td>
                                            <td class="centerCol">{{$order->main_service_type_cost}}</td>
                                            <td >{{$order->main_service_type_discount}}</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <h5>
                                                    {{__('general.Payment Type')}}
                                                </h5>
                                            </td>

                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>

                                            <td style="text-align: left">{{$order->payment_type->name}}</td>
                                            <td class="centerCol">{{$order->payment_type_cost}}</td>
                                            <td>{{$order->payment_type_discount}}</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <h5>
                                                    {{__('general.Extra Services')}}
                                                </h5>
                                            </td>

                                            <td></td>
                                            <td></td>
                                        </tr>
                                        @foreach($order->extra_service_type as $extraService)
                                        <tr>

                                            <td style="text-align: left">
                                                {{$extraService->name}}
                                            </td>
                                            <td class="centerCol">{{$extraService->pivot->price}}</td>
                                            <td>  {{$extraService->pivot->discount}}</td>
                                        </tr>
                                        @endforeach
                                        <tr style="background-color: ghostwhite;">

                                            <td style="text-align: left"><h5>{{__("general.totalExtraServiceCost")}}</h5></td>
                                            <td class="centerCol">{{$order->extra_service_type_cost}}</td>
                                            <td>{{$order->extra_services_type_discount}}</td>
                                        </tr>
                                        <tr style="background-color: gainsboro;">

                                            <td style="text-align: left">
                                                <h5>
                                                    {{__('general.Order total cost')}}
                                                </h5>
                                            </td>
                                            <td class="centerCol">{{$order->total_cost}}</td>
                                            <td>{{$order->total_discount}}</td>
                                        </tr>
                                        <tr style="background-color: gainsboro;">

                                            <td style="text-align: left">
                                                <h5>
                                                    {{__('general.total')}}
                                                </h5>
                                            </td>
                                            <td class="centerCol">{{floatval($order->total_cost) - floatval($order->total_discount)}}</td>
                                            <td></td>
                                        </tr>
                                        <tr>

                                            <td style="text-align: left">{{__('general.Order Paid')}}</td>
                                            <td class="centerCol">{{$order->currency}} {{$order->paid}}</td>
                                            <td class="centerCol"></td>
                                        </tr>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
                                <div class="pt-20">
                                    <div class="streamline user-activity">
                                        <div class="sl-item" style="line-height: 35px;">
                                            @foreach($order->time_line as $timeNode)
                                            <a href="javascript:void(0)">
                                                <div class="sl-avatar avatar avatar-sm avatar-circle">
                                                    <button class="btn btn-{{$timeNode['color']}} btn-icon-anim btn-circle"><i class="{{$timeNode['icon']}}"></i></button>
                                                </div>
                                                <div class="sl-content">
                                                    <p class="inline-block">{{$timeNode['name']}}</p>
                                                    <span class="block txt-grey font-12 capitalize-font timefield">{{$timeNode['time']}}</span>
                                                </div>
                                            </a>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="panel panel-default card-view">
                                    <div class="panel-wrapper collapse in">
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                    <input type="hidden" id="l_orderLat" value="{{$order->l_order_lat}}" />
                                                    <input type="hidden" id="l_orderLong" value="{{$order->l_order_long}}" />
                                                    <form action="{{url('/user/order/' . $order->id . '/' . $order->user_verification)}}" method="POST">
                                                        {{ csrf_field() }}
                                                        <div class="form-group">
                                                            <input type="hidden" id="orderLat" name="order_lat" @if(old('order_lat')) value="{{old('order_lat')}}" @else value="{{$order->order_lat}}" @endif />
                                                            <input type="hidden" id="orderLong" name="order_long" @if(old('order_long')) value="{{old('order_long')}}" @else value="{{$order->order_long}}" @endif/>
                                                            <label class="control-label mb-10">{{__("general.Order Location")}}  </label>
                                                            @if($userType == USER && $order->user_updated != USER_UPDATED_ORDER )
                                                            <input id="pac-input" class="controls form-control" type="text" placeholder="Search Box">

                                                            <p class="text-danger mb-10">{{__("general.dblClickToSetLocation")}}</p>
                                                            @endif
                                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                                <img src="{{asset('/dist/img/loading-default.png')}}" style="width:30px;height:30px"/>
                                                                {{__("general.providerLoading")}}
                                                            </div>
                                                            <div id="googleMap" style="width:100%;height:400px;"></div>
                                                        </div>
                                                        @if($userType == USER && $order->user_updated != USER_UPDATED_ORDER )
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
                        <!--<div class="button-list pull-right">
                            <button type="submit" class="btn btn-success mr-10">
                                Proceed to payment
                            </button>
                            <button type="button" class="btn btn-primary btn-outline btn-icon left-icon" onclick="javascript:window.print();">
                                <i class="fa fa-print"></i><span> Print</span>
                            </button>
                        </div>-->
                        <div class="clearfix"></div>
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
        var orderLat = "{{$order->order_lat}}";
        var orderLong = "{{$order->order_long}}";

        var l_orderLat = "{{$order->l_order_lat}}";
        var l_orderLong = "{{$order->l_order_long}}";

        var myCenter = new google.maps.LatLng(24.782765, 46.782498);
        var mapCanvas = document.getElementById("googleMap");
        var mapOptions = {center: myCenter, zoom: 13 , gestureHandling: "greedy"};
        var map = new google.maps.Map(mapCanvas, mapOptions);
        var infoWindow = new google.maps.InfoWindow;
        var bounds = new google.maps.LatLngBounds();
        var loading_html = "";

        if(orderLat && orderLong){
            var centerPosition = new google.maps.LatLng(orderLat, orderLong);
            var marker = new google.maps.Marker({position:centerPosition});
            marker.setMap(map);
            map.setCenter(centerPosition);
            map.setZoom(16);
            bounds.extend(marker.position);

        }

        if(l_orderLat && l_orderLong){
            var centerPosition = new google.maps.LatLng(l_orderLat, l_orderLong);
            var loading_marker = new google.maps.Marker({position:centerPosition,icon:"{{asset('/dist/img/loading-default.png')}}"});
            loading_marker.setMap(map);
            bounds.extend(loading_marker.position);
            loading_html = "/"  + l_orderLat + "," + l_orderLong ;
            /*map.setCenter(centerPosition);
            map.setZoom(16);*/
        }

        if(orderLat && orderLong && navigator.geolocation){
            var html ="";

            navigator.geolocation.getCurrentPosition(function (position) {
                html = "<span style='margin-right: 20px;font-weight: bold'><b>{{$order->client_name}}</b><br><b>{{$order->client_phone}}</b><br><u><a style='color: green;' href='https://www.google.com.eg/maps/dir/"+ position.coords.latitude +"," + position.coords.longitude + loading_html + "/" + orderLat + "," + orderLong + "'>Open Direction</a></u></span>";
                bindInfoWindow(marker, map, infoWindow, html, "test", "test2");
            });


        }else if((!orderLat || !orderLong) && navigator.geolocation){
            navigator.geolocation.getCurrentPosition(function (position) {
                map.setCenter(new google.maps.LatLng(position.coords.latitude, position.coords.longitude))
            });
        }

        map.fitBounds(bounds);

    }

    function bindInfoWindow(marker, map, infoWindow, html) {
        google.maps.event.addListener(marker, 'click', function() {
            infoWindow.setContent(html);
            infoWindow.open(map, marker);

        });
        new google.maps.event.trigger( marker, 'click' );
    }
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDgIKx-8qqL3I3a-cVETwnf2UbgVzm1zus&language=ar&callback=myMap"></script>
@elseif($userType == USER)
<script>
    var marker = null , map;
    function CenterControl(controlDiv, map) {

        // Set CSS for the control border.
        var controlUI = document.createElement('div');
        controlUI.style.backgroundColor = '#fff';
        controlUI.style.border = '2px solid #fff';
        controlUI.style.borderRadius = '3px';
        controlUI.style.boxShadow = '0 2px 6px rgba(0,0,0,.3)';
        controlUI.style.cursor = 'pointer';
        controlUI.style.marginBottom = '22px';
        controlUI.style.textAlign = 'center';
        controlUI.title = 'Click to recenter the map';
        controlDiv.appendChild(controlUI);

        // Set CSS for the control interior.
        var controlText = document.createElement('div');
        controlText.style.color = 'rgb(25,25,25)';
        controlText.style.fontFamily = 'Roboto,Arial,sans-serif';
        controlText.style.fontSize = '16px';
        controlText.style.lineHeight = '38px';
        controlText.style.paddingLeft = '5px';
        controlText.style.paddingRight = '5px';
        controlText.innerHTML = '<i class="zmdi zmdi-gps-dot"></i>';
        controlUI.appendChild(controlText);

        // Setup the click event listeners: simply set the map to Chicago.
        controlUI.addEventListener('click', function() {
            /*map.setCenter(chicago);*/
            navigator.geolocation.getCurrentPosition(function (position) {
                console.log(position.coords.latitude);
                initialMarkerLocation = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
                if (marker==null) {
                    marker = new google.maps.Marker({
                        position : initialMarkerLocation,
                        map: map
                    });
                } else {
                    marker.setPosition(initialMarkerLocation);
                }

                map.setCenter(initialMarkerLocation);
                map.setZoom(16);
                document.getElementById('orderLat').value = position.coords.latitude;
                document.getElementById('orderLong').value = position.coords.longitude;
            });
        });

    }

    function initAutocomplete() {
        var order_lat = document.getElementById('orderLat').value;
        var order_long = document.getElementById('orderLong').value;
        map = new google.maps.Map(document.getElementById('googleMap'), {
            center: {lat: 24.782765, lng: 46.782498},
            zoom: 13,
            mapTypeId: 'roadmap',
            gestureHandling: "greedy"
        });

        // Create the DIV to hold the control and call the CenterControl()
        // constructor passing in this DIV.
        var centerControlDiv = document.createElement('div');
        var centerControl = new CenterControl(centerControlDiv, map);

        centerControlDiv.index = 1;
        map.controls[google.maps.ControlPosition.BOTTOM_LEFT].push(centerControlDiv);

        if(order_lat && order_long){

            var position = new google.maps.LatLng(order_lat,order_long);
            marker = new google.maps.Marker({
                position : new google.maps.LatLng(order_lat,order_long),
                map: map
            });

            initialLocation = new google.maps.LatLng(order_lat, order_long);
            map.setCenter(initialLocation);
            map.setZoom(16);

        }/*else if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function (position) {
                initialLocation = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
                map.setCenter(initialLocation);
            });
        }*/


        // Create the search box and link it to the UI element.
        var input = document.getElementById('pac-input');
        var searchBox = new google.maps.places.SearchBox(input);
        map.controls[google.maps.ControlPosition.TOP_CENTER].push(input);

        // Bias the SearchBox results towards current map's viewport.
        map.addListener('bounds_changed', function() {
            searchBox.setBounds(map.getBounds());
        });

        var markers = [];
        // Listen for the event fired when the user selects a prediction and retrieve
        // more details for that place.
        searchBox.addListener('places_changed', function() {
            var places = searchBox.getPlaces();

            if (places.length == 0) {
                return;
            }

            // Clear out the old markers.
            markers.forEach(function(marker) {
                marker.setMap(null);
            });
            markers = [];



            // For each place, get the icon, name and location.
            var bounds = new google.maps.LatLngBounds();
            places.forEach(function(place) {
                if (!place.geometry) {
                    console.log("Returned place contains no geometry");
                    return;
                }


                if (place.geometry.viewport) {
                    // Only geocodes have viewport.
                    bounds.union(place.geometry.viewport);
                } else {
                    bounds.extend(place.geometry.location);
                }
            });
            map.fitBounds(bounds);
        });


        google.maps.event.addListener(map, 'dblclick', function(event) {
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

</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDgIKx-8qqL3I3a-cVETwnf2UbgVzm1zus&libraries=places&language=ar&callback=initAutocomplete" async defer></script>
@endif
<script>
    $(document).ready(function(){
        "use strict";
        /* Select2 Init*/
        $(".select2").select2();

        $('.timefield').each(function(){
            if($(this).text())
                $(this).text(moment(moment.utc($(this).text()).toDate()).fromNow());
        });

        $("#pac-input").keypress(function(e){
            if(e.which == 13) {
                return false;
            }
        })
    });
</script>
@endsection