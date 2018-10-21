@extends('layouts.providerlayout')


@section('PageHeader')
{{__("general.New Order")}}
@endsection

@section('PageLocation')
@parent

<li>
    <a href="{{url('/provider/orders')}}">
        {{__("general.Orders")}}
    </a>
</li>
<li>
    <a href="#">
        {{__("general.New Order")}}
    </a>
</li>
@endsection

@section('content')
@parent

@if ($errors->has('owner_provider'))
<div class="alert alert-danger alert-dismissable alert-style-1">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <i class="zmdi zmdi-alert-circle-o"></i>{{ __("general.No permission to create order") }}
</div>
@endif
<!-- Row -->
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default card-view">
            <div class="panel-wrapper collapse in">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-sm-12 col-xs-12">

                            <div class="form-wrap">
                                <form action="{{url('/provider/orders')}}" method="POST">
                                    {{ csrf_field() }}
                                    <div class="form-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <h6 class="txt-dark capitalize-font"><i class="zmdi zmdi-account mr-10"></i>{{__("general.Client Information")}}</h6>
                                                <hr class="light-grey-hr"/>
                                                <div class="form-group {{ $errors->has('city_id') ? ' has-error' : '' }}">
                                                    <label class="control-label mb-10">{{__("general.City")}}</label>
                                                    <select class="selectpicker" required data-style="form-control btn-default btn-outline" name="city_id">
                                                        <option >{{__("general.Select")}}</option>
                                                        @foreach($cities as $city)
                                                        <option value="{{$city->id}}" @if( old('city_id') == $city->id ) selected @endif>{{$city->name}}</option>
                                                        @endforeach
                                                    </select>
                                                    @if ($errors->has('city_id'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('city_id') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                                <div class="form-group {{ $errors->has('client_phone') ? ' has-error' : '' }}">
                                                    <label class="control-label mb-10">{{__("general.Phone")}}  </label>
                                                    <div class="input-group">
                                                        <div class="input-group-addon">
                                                            <i class="icon-envelope-open"></i>
                                                        </div>
                                                        <input type="text" required class="form-control allownumericwithoutdecimal" id="client_phone" name="client_phone" maxlength="15" placeholder="{{__('general.Phone Ex')}}" @if(old('client_phone')) value="{{old('client_phone')}}" @endif>
                                                        <div class="input-group-addon" id="client_phone_code">
                                                            {{substr($country->code,2)}}+
                                                        </div>
                                                    </div>
                                                    @if ($errors->has('client_phone'))
                                                    <span class="help-block">
                                                            <strong>{{ $errors->first('client_phone') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                                <div class="form-group {{ $errors->has('client_name') ? ' has-error' : '' }}">
                                                    <label class="control-label mb-10">{{__("general.Name")}}  </label>
                                                    <div class="input-group">
                                                        <div class="input-group-addon">
                                                            <i class="icon-user"></i>
                                                        </div>

                                                        <input type="text" class="form-control" required  name="client_name" id="client_name" placeholder="{{__('general.Full Name Ex')}}" @if(old('client_name')) value="{{old('client_name')}}" @endif>
                                                        @if ($errors->has('client_name'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('client_name') }}</strong>
                                                        </span>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="form-group {{ $errors->has('client_address') ? ' has-error' : '' }}">
                                                    <label class="control-label mb-10">{{__("general.Address")}}  </label>
                                                    <textarea class="form-control required" cols="20" id="client_address" name="client_address" >{{e(old('client_address'))}}</textarea>
                                                    @if ($errors->has('client_address'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('client_address') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>

                                            </div>
                                            <!--/span-->
                                            <div class="col-md-6">
                                                <h6 class="txt-dark capitalize-font"><i class="zmdi zmdi-account mr-10"></i>{{__("general.Order Info")}}</h6>
                                                <hr class="light-grey-hr"/>
                                                <div class="form-group {{ $errors->has('category_id') ? ' has-error' : '' }}">
                                                    <label class="control-label mb-10">{{__("general.Category")}}</label>
                                                    <select class="selectpicker" required data-style="form-control btn-default btn-outline" name="category_id">
                                                        <option >{{__("general.Select")}}</option>
                                                        @foreach($categories as $category)
                                                        <option value="{{$category->id}}" @if( old('category_id') == $category->id ) selected @endif>{{$category->name}}</option>
                                                        @endforeach
                                                    </select>
                                                    @if ($errors->has('category_id'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('category_id') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                                <div class="form-group {{ $errors->has('loading_id') ? ' has-error' : '' }}">
                                                    <label class="control-label mb-10">{{__("general.providerLoading")}}</label>
                                                    <select class="selectpicker" data-style="form-control btn-default btn-outline" id="loading_id" name="loading_id">
                                                        <option value="">{{__("general.Select")}}</option>
                                                        @foreach($providerLoadings as $loading)
                                                        <option value="{{$loading->id}}" data-loading-address="{{$loading->address}}" @if( old('loading_id') == $loading->id ) selected @endif>{{$loading->name}}</option>
                                                        @endforeach
                                                    </select>
                                                    <p class="text-primary mb-10" id="loading_address">

                                                    </p>
                                                    @if ($errors->has('loading_id'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('loading_id') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                                <div class="form-group {{ $errors->has('car_type_id') ? ' has-error' : '' }}">
                                                    <label class="control-label mb-10">{{__("general.CarType")}}</label>
                                                    <select class="selectpicker" data-style="form-control btn-default btn-outline" id="car_type_id" name="car_type_id">
                                                        <option value="">{{__("general.Select")}}</option>
                                                        @foreach($carTypes as $carType)
                                                        <option value="{{$carType->id}}" @if(old('car_type_id') == $carType->id ) selected @endif>{{$carType->name}}</option>
                                                        @endforeach
                                                    </select>

                                                    </p>
                                                    @if ($errors->has('car_type_id'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('car_type_id') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                                <div class="form-group {{ $errors->has('required_at') ? ' has-error' : '' }}">
                                                    <label class="control-label mb-10 text-left">{{__('general.Required at')}}</label>
                                                    <div class='input-group date' id='datetimepicker1'>
                                                        <input type='text' onkeydown="return false" required class="form-control" name="required_at" @if(old('required_at')) value="{{old('required_at')}}" @endif/>
                                                        <span class="input-group-addon">
                                                            <span class="fa fa-calendar"></span>
                                                        </span>
                                                    </div>
                                                    @if ($errors->has('required_at'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('required_at') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                            </div>
                                            <!--/span-->
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <h6 class="txt-dark capitalize-font"><i class="zmdi zmdi-account mr-10"></i>{{__("general.OrderServices")}}</h6>
                                                <hr class="light-grey-hr"/>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group {{ $errors->has('main_service_id') ? ' has-error' : '' }}">
                                                    <label class="control-label mb-10">{{__("general.Main Service")}}</label>
                                                    <select class="selectpicker" data-style="form-control btn-default btn-outline" name="main_service_id">
                                                        <option >{{__("general.Select")}}</option>
                                                        @foreach($services as $service)
                                                        @if($service->type == MAIN_SERVICE_TYPE)
                                                        <option value="{{$service->id}}" @if( old('main_service_id') == $service->id ) selected @endif>
                                                            {{$service->name}} @if($service->price != 0) <small style="color: gray"> + {{$service->price}} {{$country->currency_symbol}}  {{__('general.Per Order')}} </small> @endif
                                                        </option>
                                                        @endif
                                                        @endforeach
                                                    </select>
                                                    @if ($errors->has('main_service_id'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('main_service_id') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                                <div class="form-group {{ $errors->has('extra_service_id') ? ' has-error' : '' }}">
                                                    <label class="control-label mb-10">{{__("general.Extra Services")}}</label>
                                                    @foreach($services as $service)
                                                    @if($service->type == EXTRA_SERVICE_TYPE)
                                                    <div class="checkbox checkbox-success">
                                                        <input id="checkbox3-{{$service->id}}" type="checkbox" name="extra_service_id[]" value="{{$service->id}}" @if(old('extra_service_id') && in_array($service->id,old('extra_service_id'))) checked @endif>
                                                        <label for="checkbox3-{{$service->id}}"> {{$service->name}} @if($service->price != 0) <small style="color: gray"> + {{$service->price}} {{$country->currency_symbol}}  {{__('general.Per Order')}} </small> @endif</label>
                                                    </div>
                                                    @endif
                                                    @endforeach

                                                    @if ($errors->has('extra_service_id'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('extra_service_id') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group {{ $errors->has('payment_type_id') ? ' has-error' : '' }}">
                                                    <label class="control-label mb-10">{{__("general.Payment Type")}}</label>
                                                    <select class="selectpicker" data-style="form-control btn-default btn-outline" name="payment_type_id">
                                                        <option >{{__("general.Select")}}</option>
                                                        @foreach($paymentTypes as $paymentType)
                                                        <option value="{{$paymentType->id}}" @if( old('main_service_id') == $paymentType->id ) selected @endif>{{$paymentType->name}} @if($paymentType->price != 0) <small style="color: gray"> + {{$paymentType->price}} {{$country->currency_symbol}} {{__("general.Payment cost")}} </small> @endif</option>
                                                        @endforeach
                                                    </select>
                                                    @if ($errors->has('payment_type_id'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('payment_type_id') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                                <div class="form-group {{ $errors->has('order_price') ? ' has-error' : '' }}">
                                                    <label class="control-label mb-10">{{__("general.Order Price")}}  </label>
                                                    <div class="input-group">
                                                        <div class="input-group-addon">
                                                            <i class="icon-envelope-open"></i>
                                                        </div>
                                                        <input type="text" class="form-control allownumericwithdecimal" required id="exampleInputEmail" name="order_price" placeholder="0.00" @if(old('order_price')) value="{{old('order_price')}}" @endif />

                                                    </div>
                                                    @if ($errors->has('order_price'))
                                                    <span class="help-block">
                                                            <strong>{{ $errors->first('order_price') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <h6 class="txt-dark capitalize-font"><i class="zmdi zmdi-account mr-10"></i>{{__("general.Extra Info")}}</h6>
                                                <hr class="light-grey-hr"/>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group {{ $errors->has('details') ? ' has-error' : '' }}">
                                                    <label class="control-label mb-10">{{__("general.Details")}}  </label>
                                                    <textarea class="form-control required" cols="20" id="exampleInputAddress" name="details" >{{old('details')}}</textarea>
                                                    @if ($errors->has('details'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('details') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="hidden" id="orderLat" name="order_lat" />
                                                    <input type="hidden" id="orderLong" name="order_long" />

                                                    <label class="control-label mb-10">{{__("general.Order Location")}}  </label>

                                                    <input id="pac-input" class="controls form-control" type="text" placeholder="Search Box">
                                                    <div id="googleMap" style="width:100%;height:400px;"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-actions mt-10">
                                        <button type="submit" class="btn btn-success  mr-10"> {{__('general.Save')}}</button>
                                    </div>
                                </form>
                            </div>
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
<!--<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDgIKx-8qqL3I3a-cVETwnf2UbgVzm1zus"></script>-->

<script>
    marker = null;
    map = null;
    function initAutocomplete() {
        map = new google.maps.Map(document.getElementById('googleMap'), {
            center: {lat: 24.782765, lng: 46.782498},
            zoom: 15,
            mapTypeId: 'roadmap'
        });

        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function (position) {
                initialLocation = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
                map.setCenter(initialLocation);
            });
        }


        // Create the search box and link it to the UI element.
        var input = document.getElementById('pac-input');
        var searchBox = new google.maps.places.SearchBox(input);
        map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

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
                var icon = {
                    url: place.icon,
                    size: new google.maps.Size(71, 71),
                    origin: new google.maps.Point(0, 0),
                    anchor: new google.maps.Point(17, 34),
                    scaledSize: new google.maps.Size(25, 25)
                };


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
            clickOnMap(event.latLng.lat(), event.latLng.lng())

        });
    }
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDgIKx-8qqL3I3a-cVETwnf2UbgVzm1zus&libraries=places&language=ar&callback=initAutocomplete" async defer></script>
<script>

    $(document).ready(function() {
        "use strict";


        $('#datetimepicker1').datetimepicker({
            useCurrent: true,
            minDate: new Date(),
            format : "YYYY-MM-DD HH:mm:ss",
            icons: {
                time: "fa fa-clock-o",
                date: "fa fa-calendar",
                up: "fa fa-arrow-up",
                down: "fa fa-arrow-down"
            },

        });

        $("#pac-input").keypress(function(e){
            if(e.which == 13) {
                return false;
            }
        });

        $("#loading_id").change(function(){
            var selectedLoadingAddress = $(this).find(":selected").data('loading-address');

            $("#loading_address").text(selectedLoadingAddress);
        });

        $("#client_phone").change(function(){
            var postData = {_token: "{{ csrf_token() }}",client_phone:$(this).val()}
            $.ajax({
                url: '{{url("/provider/client")}}',
                type: 'POST',
                data: postData,
                dataType: 'JSON',
                success: function (data) {
                    console.log(data);
                    if(data.success){
                        $("#client_name").val(data.result.client_name);
                        $("#client_address").val(data.result.client_address);
                        if(data.result.order_lat && data.result.order_long)
                            clickOnMap(data.result.order_lat,data.result.order_long);
                    }

                },
                error: function(){
                    console.log("error");
                    console.log(data);
                }
            });
        })
    });
    function clickOnMap(lat, lng) {
        var initialLocation = new google.maps.LatLng(lat,lng);
        if (marker==null) {
            marker = new google.maps.Marker({
                position : initialLocation,
                map: map
            });
        } else {
            marker.setPosition(initialLocation);
        }

        document.getElementById('orderLat').value = lat;
        document.getElementById('orderLong').value = lng;

        map.setCenter(initialLocation);
    }
</script>

@endsection
