<?php $__env->startSection('PageHeader'); ?>
<?php echo e(__("general.updateLoading")); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('PageLocation'); ?>
##parent-placeholder-beeb47ac6f60afc7d02ef05a32eb9384e933fbd3##

<li>
    <a href="<?php echo e(url('/provider/loading')); ?>">
        <?php echo e(__("general.providerLoading")); ?>

    </a>
</li>
<li>
    <a href="#">
        <?php echo e(__("general.updateLoading")); ?>

    </a>
</li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
##parent-placeholder-040f06fd774092478d450774f5ba30c5da78acc8##

<!-- Row -->
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-default card-view">
            <div class="panel-wrapper collapse in">
                <div class="panel-body">
                    <form action="<?php echo e(url('/provider/loading/' . $pro->id)); ?>"  method="POST">
                        <div class="row">
                            <h6 class="txt-dark capitalize-font"><i class="ti ti-location-pin mr-10"></i><?php echo e(__("general.LoadingInformation")); ?></h6>
                            <hr class="light-grey-hr"/>
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
                                    <?php echo e(method_field('PATCH')); ?>

                                    <?php echo e(csrf_field()); ?>


                                    <div class="row" style="padding: 6%;">

                                        <div class="form-body overflow-hide">
                                            <div class="form-group <?php echo e($errors->has('status') ? ' has-error' : ''); ?>">
                                                <div class="checkbox checkbox-primary pr-10 pull-left">
                                                    <input id="loadingAvailability" value="1" name="is_active" type="checkbox" <?php if(old('is_active')): ?> checked <?php elseif($pro->is_active == PRODUCT_ACTIVE): ?> checked <?php endif; ?>>
                                                    <label for="loadingAvailability"> <?php echo e(__("general.available")); ?> </label>
                                                </div>
                                                <?php if($errors->has('status')): ?>
                                                <span class="help-block">
                                                    <strong><?php echo e($errors->first('is_active')); ?></strong>
                                                </span>
                                                <?php endif; ?>
                                                <div class="clearfix"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="form-actions mt-10">
                                    <button type="submit" class="btn btn-success mr-10 mb-30"><?php echo e(__('general.Save')); ?></button>
                                </div>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('footer'); ?>
##parent-placeholder-d7eb6b340a11a367a1bec55e4a421d949214759f##
<script>
    var marker = null;
    function initAutocomplete() {
        var order_lat = document.getElementById('loadingLat').value;
        var order_long = document.getElementById('loadingLong').value;

        var map = new google.maps.Map(document.getElementById('googleMap'), {
            center: {lat: -33.8688, lng: 151.2195},
            zoom: 13,
            mapTypeId: 'roadmap'
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

        }else if (navigator.geolocation) {
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
            document.getElementById('loadingLat').value = event.latLng.lat();
            document.getElementById('loadingLong').value = event.latLng.lng();
        });
    }

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

                document.getElementById('loadingLat').value = position.coords.latitude;
                document.getElementById('loadingLong').value = position.coords.longitude;
            });
        });

    }

</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDgIKx-8qqL3I3a-cVETwnf2UbgVzm1zus&libraries=places&language=ar&callback=initAutocomplete" async defer></script>

<!-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAebJRBNVbamVKdVL5xcN9ShixlRGJHmO4"></script>-->
<script>
    $(document).ready(function() {
        "use strict";


        $("#pac-input").keypress(function(e){
            if(e.which == 13) {
                return false;
            }
        })


    });
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.providerlayout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>