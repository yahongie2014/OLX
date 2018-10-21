@extends('layouts.adminlayout')

@section('PageHeader')
{{__("general.Tracking")}}
@endsection

@section('PageLocation')
@parent



@endsection
@section('content')
@parent

<div class="row">
    <div class="col-md-12">
        {{__('general.trackingDriver')}} : </br> </br>
        <p class="text-success mb-10">
        {{$driver_name}}
        </p>
    </div>
    <div class="col-md-12">
        <div class="form-group">

            <div id="googleMap" style="width:100%;height:400px;"></div>
        </div>
    </div>
</div>
@endsection

<!-- /Row -->
@section('footer')
@parent
<script src="https://jiibli.sa/node/socket.io/socket.io.js"></script>
<!--<script src="http://localhost:3000/socket.io/socket.io.js"></script>-->
<script>
    socket = null;
    marker = tracker = null;
    map = null;
    function initAutocomplete() {
        var order_lat = "{{$last_lat}}";
        var order_long = "{{$last_long}}";
        map = new google.maps.Map(document.getElementById('googleMap'), {
            center: {lat: 24.782765, lng: 46.782498},
            zoom: 15,
            mapTypeId: 'roadmap'
        });

        if(order_lat && order_long){

            var position = new google.maps.LatLng(order_lat,order_long);
            marker = new google.maps.Marker({
                position : new google.maps.LatLng(order_lat,order_long),
                map: map,
                icon : "{{asset('/dist/img/loading-default.png')}}"
            });

            initialLocation = new google.maps.LatLng(order_lat, order_long);
            map.setCenter(initialLocation);

        }else if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function (position) {
                initialLocation = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
                map.setCenter(initialLocation);
            });
        }


    }

</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDgIKx-8qqL3I3a-cVETwnf2UbgVzm1zus&libraries=places&language=ar&callback=initAutocomplete" async defer></script>
<script>
    var token = "{{$user_token}}";
    console.log(token);
    var socket = null;
    $(document).ready(function(){
        socket = io('wss://jiibli.sa' , {secure:true, query:"user_token=" + token ,transports :['websocket'] });
        /*socket = io('localhost:3000' , {secure:true, query:"user_token=" + token ,transports :['websocket'] });
*/
        socket.on('connecting', function(data) {
            console.log(data);
            socket.emit('listen_to_user',{user_id:"{{$delivery_user_id}}"});
        });


        socket.on('listen_user_location', function(data) {
            console.log(data);
            trackLocation(data);
        });
        socket.on('disconnect', function() {
            console.log("sssss");
        });


    });

    function trackLocation(coordinates){
        initialMarkerLocation = new google.maps.LatLng(coordinates.lat, coordinates.long);
        if (marker==null) {
            marker = new google.maps.Marker({
                position : initialMarkerLocation,
                map: map,
                icon : "{{asset('/dist/img/loading-default.png')}}"
            });
        } else {
            marker.setPosition(initialMarkerLocation);
        }

        map.setCenter(initialMarkerLocation);

    }
</script>

@endsection