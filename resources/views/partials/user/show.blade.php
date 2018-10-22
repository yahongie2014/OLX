
<div class="container-fluid pt-25">
    @if ($errors->any())
    <!--<div class="alert alert-danger alert-dismissable alert-style-1">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <i class="zmdi zmdi-alert-circle-o"></i>{{ __("general.error check fields") }}
    </div>-->
    @endif
    <!-- Row -->
    <div class="row">
        <div class="col-lg-3 col-xs-12">
            <div class="panel panel-default card-view  pa-0">
                <div class="panel-wrapper collapse in">
                    <div class="panel-body  pa-0">
                        <div class="profile-box">
                            <div class="profile-cover-pic">

                            </div>
                            <div class="profile-info text-center">
                                <div class="profile-img-wrap">
                                    <img class="inline-block mb-10" style="max-width: 100%;" src=@if($user->image){{asset($user->image)}} @else {{asset("dist/img/mock1.jpg")}} @endif alt="user"/>

                                </div>
                                <h5 class="block mt-10 mb-5 weight-500 capitalize-font txt-danger">{{$user->name}}</h5>
                                <h6 class="block capitalize-font pb-20">
                                    <div calss="row">
                                        @if($user->provider)
                                        <div class="col-lg-12 col-xs-12">
                                            <div class="col-lg-12 col-xs-12">

                                                <button class="btn btn-primary btn-icon-anim btn-circle">
                                                    <i class="fa fa-shopping-cart"></i>

                                                </button>
                                                <span>{{__("general.Provider")}}</span>

                                            </div>

                                            <div class="col-sm-12" style="margin-top: 2%">
                                                <div class="form-group">
                                                    <div>
                                                        <input id="provider_active" type="checkbox" data-off-text="{{__('general.inactive')}}" data-on-text="{{__('general.active')}}"  class="bs-switch" data-user-state="{{$user->provider->status}}" >

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="social-info">
                                            <div class="row">
                                                <div class="col-xs-4 text-center">
                                                    <span class="counts block head-font"><span class="counter-anim">{{$user->provider->dayOrders}}</span></span>
                                                    <span class="counts-text block">{{__("general.totalDayOrdersCount")}}</span>
                                                </div>

                                                <div class="col-xs-4 text-center">
                                                    <span class="counts block head-font"><span class="counter-anim">{{$user->provider->monthOrders}}</span></span>
                                                    <span class="counts-text block">{{__("general.totalMonthOrdersCount")}}</span>
                                                </div>

                                                <div class="col-xs-4 text-center">
                                                    <span class="counts block head-font"><span class="counter-anim">{{$user->provider->allOrders}}</span></span>
                                                    <span class="counts-text block">{{__("general.totalOrdersCount")}}</span>
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                        <div class="clearfix"></div>
                                        @if($user->delivery)
                                        <div class="col-lg-12 col-xs-12">
                                            <div class="col-lg-12 col-xs-12">

                                                <button class="btn btn-info btn-icon-anim btn-circle">
                                                    <i class="fa fa-car"></i>

                                                </button>
                                                {{__("general.Delivery")}}

                                            </div>

                                            <div class="col-sm-12" style="margin-top: 2%">
                                                <div class="form-group">
                                                    <div>
                                                        <input  id="delivery_active" type="checkbox" data-off-text="{{__('general.inactive')}}" data-on-text="{{__('general.active')}}"  class="bs-switch" data-user-state="{{$user->delivery->status}}">

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="social-info">
                                            <div class="row">
                                                <div class="col-xs-4 text-center">
                                                    <span class="counts block head-font"><span class="counter-anim">{{$user->delivery->dayOrders}}</span></span>
                                                    <span class="counts-text block">{{__("general.totalDayOrdersCount")}}</span>
                                                </div>

                                                <div class="col-xs-4 text-center">
                                                    <span class="counts block head-font"><span class="counter-anim">{{$user->delivery->monthOrders}}</span></span>
                                                    <span class="counts-text block">{{__("general.totalMonthOrdersCount")}}</span>
                                                </div>

                                                <div class="col-xs-4 text-center">
                                                    <span class="counts block head-font"><span class="counter-anim">{{$user->delivery->allOrders}}</span></span>
                                                    <span class="counts-text block">{{__("general.totalOrdersCount")}}</span>
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                        <div class="clearfix"></div>
                                    </div>
                                </h6>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-9 col-xs-12">
            <div class="panel panel-default card-view pa-0">
                <div class="panel-wrapper collapse in">
                    <div  class="panel-body pb-0">
                        <div  class="tab-struct custom-tab-1">
                            <ul role="tablist" class="nav nav-tabs nav-tabs-responsive" id="myTabs_8">
                                <li class="active" role="presentation">
                                    <a  data-toggle="tab" id="profile_tab_8" role="tab" href="#profile_8" aria-expanded="false">
                                        <span>{{__("general.Profile")}}</span>
                                    </a>
                                </li>
                                @if($user->provider)
                                <li  role="presentation" class="next">
                                    <a aria-expanded="true"  data-toggle="tab" role="tab" id="provider_tab_8" href="#provider_info">
                                        <span>{{__("general.Provider Info")}}</span>
                                    </a>
                                </li>
                                @endif
                                @if($user->delivery)
                                <li  role="presentation" class="next">
                                    <a aria-expanded="true"  data-toggle="tab" role="tab" id="dekivery_tab_8" href="#delivery">
                                        <span>{{__("general.Delivery Info")}}</span>
                                    </a>
                                </li>
                                @endif
                                @if($canUpdate)
                                <li  role="presentation" class="next">
                                    <a aria-expanded="true"  data-toggle="tab" role="tab" id="password_tab_8" href="#changePassword">
                                        <span>{{__("general.ChangePassword")}}</span>
                                    </a>
                                </li>
                                @endif
                            </ul>
                            <div class="tab-content" id="myTabContent_8">
                                <div  id="profile_8" class="tab-pane fade active in" role="tabpanel">
                                    <!-- Row -->
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="">
                                                <div class="panel-wrapper collapse in">
                                                    <div class="panel-body pa-0">
                                                        <div class="col-sm-12 col-xs-12">
                                                            <div class="form-wrap">
                                                                <form action="{{url($updateLink)}}" enctype="multipart/form-data"  method="POST">
                                                                    {{ method_field('PATCH') }}
                                                                    {{ csrf_field() }}
                                                                    <input name="user_id" value="{{$user->id}}" type="hidden" />
                                                                    <div class="form-body overflow-hide">
                                                                        @if($canUpdate)
                                                                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                                            <div class="form-group">

                                                                                @if ($errors->has('profileImage'))
                                                                                <span class="help-block" style="color : red">
                                                                                    <strong>{{ $errors->first('profileImage') }}</strong>
                                                                                </span>
                                                                                @endif

                                                                                <div class="mt-40">
                                                                                    <input type="file" name="profileImage" id="profileImage" class="dropify" data-default-file=@if($user->image)"{{asset($user->image)}}" @else "" @endif accept=".jpg,.jpeg,.png" />
                                                                                </div>
                                                                                <label class="control-label mb-10" for="exampleInputuname_01">{{__("general.profileImage")}}</label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                                            <div class="form-group">
                                                                                @if ($errors->has('coverImage'))
                                                                                <span class="help-block" style="color : red">
                                                                                    <strong>{{ $errors->first('coverImage') }}</strong>
                                                                                </span>
                                                                                @endif
                                                                                <div class="mt-40">
                                                                                    <input type="file" name="coverImage" id="coverImage" class="dropify" data-default-file=@if($user->cover_image)"{{asset($user->cover_image)}}" @else "" @endif accept=".jpg,.jpeg,.png" />
                                                                                </div>
                                                                                <label class="control-label mb-10" for="exampleInputuname_01">{{__("general.coverImage")}}</label>
                                                                            </div>
                                                                        </div>
                                                                        @endif

                                                                        <div class="col-xs-12">
                                                                            <div class="form-group {{ $errors->has('userName') ? ' has-error' : '' }}">
                                                                                <label class="control-label mb-10" for="exampleInputuname_01">{{__("general.Name")}}</label>
                                                                                <div class="input-group">
                                                                                    <div class="input-group-addon">
                                                                                        <i class="icon-user"></i>
                                                                                    </div>
                                                                                    <input type="text" class="form-control" id="exampleInputuname_01" name="userName" value="{{$user->name}}" required @if(!$canUpdate) disabled @endif />
                                                                                </div>
                                                                                @if ($errors->has('userName'))
                                                                                <span class="help-block">
                                                                                    <strong>{{ $errors->first('userName') }}</strong>
                                                                                </span>
                                                                                @endif
                                                                            </div>
                                                                            <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                                                                                <label class="control-label mb-10" for="exampleInputEmail_01">{{__("general.Email")}}</label>
                                                                                <div class="input-group">
                                                                                    <div class="input-group-addon">
                                                                                        <i class="icon-envelope-open"></i>
                                                                                    </div>
                                                                                    <input type="email" name="email" class="form-control" id="exampleInputEmail_01" value=@if(old('email')) {{old('email')}} @else "{{$user->email}}" @endif  @if(!$canUpdate) disabled @endif />
                                                                                </div>
                                                                                @if ($errors->has('email'))
                                                                                <span class="help-block">
                                                                                    <strong>{{ $errors->first('email') }}</strong>
                                                                                </span>
                                                                                @endif
                                                                            </div>
                                                                            <div class="form-group {{ $errors->has('phone') ? ' has-error' : '' }}">
                                                                                <label class="control-label mb-10" for="exampleInputContact_01">{{__("general.Phone")}}</label>
                                                                                <div class="input-group">
                                                                                    <div class="input-group-addon"><i class="icon-phone"></i></div>
                                                                                    <input type="text" class="form-control allownumericwithoutdecimal" name="phone" maxlength="15" id="exampleInputContact_01" value=@if(old('phone')) {{old('phone')}} @else "{{$user->phone}}" @endif @if(!$canUpdate) disabled @endif  />
                                                                                </div>

                                                                                @if ($errors->has('phone'))
                                                                                <span class="help-block">
                                                                                    <strong>{{ $errors->first('phone') }}</strong>
                                                                                </span>
                                                                                @endif
                                                                            </div>

                                                                            <div class="form-group {{ $errors->has('country_id') ? ' has-error' : '' }}">
                                                                                <label class="control-label mb-10">{{__("general.Country")}}</label>
                                                                                <select class="form-control select2" name="country_id" id="country_id"  @if(!$canUpdate) disabled @endif required>
                                                                                    @foreach($countries as $country)
                                                                                    <option value="{{$country->id}}" @if( $user->country_id == $country->id ) selected @endif>{{$country->name}}</option>
                                                                                    @endforeach
                                                                                </select>
                                                                                @if ($errors->has('country_id'))
                                                                                <span class="help-block">
                                                                                    <strong>{{ $errors->first('country_id') }}</strong>
                                                                                </span>
                                                                                @endif
                                                                            </div>
                                                                            <div class="form-group {{ $errors->has('city_id') ? ' has-error' : '' }}">
                                                                                <label class="control-label mb-10">{{__("general.City")}}</label>
                                                                                <select class="form-control select2" name="city_id" id="city_id" @if(!$canUpdate) disabled @endif required>
                                                                                    @foreach($cities as $city)
                                                                                    <option value="{{$city->id}}" @if( $user->city_id == $city->id ) selected @endif>{{$city->name}}</option>
                                                                                    @endforeach
                                                                                </select>
                                                                                @if ($errors->has('city_id'))
                                                                                <span class="help-block">
                                                                                    <strong>{{ $errors->first('city_id') }}</strong>
                                                                                </span>
                                                                                @endif
                                                                            </div>
                                                                            <div class="form-group {{ $errors->has('language_id') ? ' has-error' : '' }}">
                                                                                <label class="control-label mb-10">{{__("general.Language")}}</label>
                                                                                <select class="form-control select2" name="language_id" @if(!$canUpdate) disabled @endif required>
                                                                                    @foreach($languages as $language)
                                                                                    <option value="{{$language->id}}" @if( $user->language_id == $language->id ) selected @endif>{{$language->name}}</option>
                                                                                    @endforeach
                                                                                </select>
                                                                                @if ($errors->has('language_id'))
                                                                                <span class="help-block">
                                                                                    <strong>{{ $errors->first('language_id') }}</strong>
                                                                                </span>
                                                                                @endif
                                                                            </div>
                                                                            <div class="form-group {{ $errors->has('address') ? ' has-error' : '' }}">
                                                                                <label class="control-label mb-10 text-left">{{__("general.Address")}}</label>
                                                                                <textarea class="form-control" required @if(!$canUpdate) disabled @endif name="address" rows="5"  >{{ $user->address }}</textarea>
                                                                                @if ($errors->has('address'))
                                                                                <span class="help-block">
                                                                                    <strong>{{ $errors->first('address') }}</strong>
                                                                                </span>
                                                                                @endif
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    @if($canUpdate)
                                                                    <div class="form-actions mt-10">
                                                                        <button type="submit" class="btn btn-success mr-10 mb-30">{{__('general.Update profile')}}</button>
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
                                </div>
                                @if($user->provider)
                                <div  id="provider_info" class="tab-pane fade active in" role="tabpanel">
                                    <!-- Row -->
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="">
                                                <div class="panel-wrapper collapse in">
                                                    <div class="panel-body pa-0">

                                                        <div class="col-sm-12 col-xs-12">
                                                            @if($user->provider->loadings->count() > 0)
                                                            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                                                <img src="{{asset('/dist/img/loading-active.png')}}" style="width:30px;height:30px" />
                                                                {{__("general.active")}}
                                                            </div>
                                                            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                                                <img src="{{asset('/dist/img/loading-inactive.png')}}" style="width:30px;height:30px" />
                                                                {{__("general.inactive")}}
                                                            </div>
                                                            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                                                <img src="{{asset('/dist/img/loading-default.png')}}" style="width:30px;height:30px"/>
                                                                {{__("general.default")}}
                                                            </div>

                                                            <div class="clearfix"></div>

                                                            <div id="googleMap" style="width:100%;height:400px;"></div>
                                                            @else
                                                            <p class="text-warning mb-10"><code>{{__("general.providerDoseNotHaveLoadingPoints")}}</code></p>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endif
                                @if($user->delivery)
                                <div  id="delivery" class="tab-pane fade" role="tabpanel">
                                    <!-- Row -->
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="">
                                                <div class="panel-wrapper collapse in">
                                                    <div class="panel-body pa-0">
                                                        <div class="col-sm-12 col-xs-12">
                                                            <div class="form-wrap">
                                                                <form action="{{url('/delivery/info/' . $user->delivery->id)}}" enctype="multipart/form-data"  method="POST">
                                                                    {{ method_field('PATCH') }}
                                                                    {{ csrf_field() }}
                                                                    <input name="delivery_id" value="{{$user->delivery->id}}" type="hidden" />
                                                                    <div class="form-body overflow-hide">
                                                                        <div class="form-group">
                                                                            <div class="checkbox checkbox-primary pr-10 pull-left">
                                                                                <input id="checkbox_2" value="1" name="deliveryAvailability" type="checkbox" @if(!$canUpdate) disabled @endif @if($user->delivery->available == DELIVERY_AVAILABLE) checked @endif>
                                                                                <label for="checkbox_2"> {{__("general.available")}} </label>
                                                                            </div>
                                                                            <div class="clearfix"></div>
                                                                        </div>
                                                                        <div class="form-group {{ $errors->has('vehicle_id') ? ' has-error' : '' }}">
                                                                            <label class="control-label mb-10" for="exampleInputuname_01" >{{__("general.vehicle_id")}}</label>
                                                                            <div class="input-group">
                                                                                <div class="input-group-addon">
                                                                                    <i class="icon-user"></i>
                                                                                </div>
                                                                                <input type="text" class="form-control allownumericwithoutdecimal" id="exampleInputuname_01" name="vehicle_id" value="{{$user->delivery->vehicle_id}}" required  @if(!$canUpdate) disabled @endif />
                                                                            </div>
                                                                            @if ($errors->has('vehicle_id'))
                                                                            <span class="help-block">
                                                                                <strong>{{ $errors->first('vehicle_id') }}</strong>
                                                                            </span>
                                                                            @endif
                                                                        </div>
                                                                        <div class="form-group {{ $errors->has('license_id') ? ' has-error' : '' }}">
                                                                            <label class="control-label mb-10" for="exampleInputuname_01">{{__("general.license_id")}}</label>
                                                                            <div class="input-group">
                                                                                <div class="input-group-addon">
                                                                                    <i class="icon-user"></i>
                                                                                </div>
                                                                                <input type="text" class="form-control allownumericwithoutdecimal" id="exampleInputuname_01" name="license_id" value="{{$user->delivery->license_id}}" required @if(!$canUpdate) disabled @endif />
                                                                            </div>
                                                                            @if ($errors->has('license_id'))
                                                                            <span class="help-block">
                                                                                <strong>{{ $errors->first('license_id') }}</strong>
                                                                            </span>
                                                                            @endif
                                                                        </div>
                                                                        <div class="form-group {{ $errors->has('car_type_id') ? ' has-error' : '' }}">
                                                                            <label class="control-label mb-10">{{__("general.CarType")}}</label>
                                                                            <select class="form-control select2" name="car_type_id" @if(!$canUpdate) disabled @endif required>
                                                                                @foreach($carTypes as $carType)
                                                                                <option value="{{$carType->id}}" @if( $user->delivery->car_type_id == $carType->id ) selected @endif>{{$carType->name}}</option>
                                                                                @endforeach
                                                                            </select>
                                                                            @if ($errors->has('car_type_id'))
                                                                            <span class="help-block">
                                                                                    <strong>{{ $errors->first('car_type_id') }}</strong>
                                                                                </span>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                    @if($canUpdate && $loginType == DRIVER)
                                                                    <div class="form-actions mt-10">
                                                                        <button type="submit" class="btn btn-success mr-10 mb-30">{{__('general.Save')}}</button>
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
                                </div>
                                @endif
                                @if($canUpdate)
                                <div  id="changePassword" class="tab-pane fade active in" role="tabpanel">
                                    <!-- Row -->
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="">
                                                <div class="panel-wrapper collapse in">
                                                    <div class="panel-body pa-0">
                                                        <div class="col-sm-6 col-xs-6">
                                                            <div class="form-wrap">
                                                                <form action="{{url('/user/password')}}" method="POST">
                                                                    {{ csrf_field() }}
                                                                    <div class="form-group {{ $errors->has('oldPassword') ? ' has-error' : '' }}">
                                                                        <label class="control-label mb-10" >{{__("general.oldPassword")}}</label>
                                                                        <div class="input-group">
                                                                            <input type="password" class="form-control" name="oldPassword"/>
                                                                        </div>
                                                                        @if ($errors->has('oldPassword'))
                                                                        <span class="help-block">
                                                                                <strong>{{ $errors->first('oldPassword') }}</strong>
                                                                            </span>
                                                                        @endif
                                                                    </div>
                                                                    <div class="form-group {{ $errors->has('oldPassword') ? ' has-error' : '' }}">
                                                                        <label class="control-label mb-10" >{{__("general.newPassword")}}</label>
                                                                        <div class="input-group">
                                                                            <input type="password" class="form-control" name="password"/>
                                                                        </div>
                                                                        @if ($errors->has('password'))
                                                                        <span class="help-block">
                                                                                <strong>{{ $errors->first('password') }}</strong>
                                                                            </span>
                                                                        @endif
                                                                    </div>
                                                                    <div class="form-group {{ $errors->has('oldPassword') ? ' has-error' : '' }}">
                                                                        <label class="control-label mb-10" >{{__("general.newPasswordConfirm")}}</label>
                                                                        <div class="input-group">
                                                                            <input type="password" class="form-control" name="password_confirmation"/>
                                                                        </div>
                                                                        @if ($errors->has('password_confirmation'))
                                                                        <span class="help-block">
                                                                                <strong>{{ $errors->first('password_confirmation') }}</strong>
                                                                            </span>
                                                                        @endif
                                                                    </div>
                                                                    <div class="form-actions mt-10">
                                                                        <button type="submit" class="btn btn-success mr-10 mb-30">{{__('general.Save')}}</button>
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
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
    <!-- /Row -->


</div>

@section('footer')
@parent
@if($user->provider && $user->provider->loadings->count() > 0)
<script>
    var map;
    function initMap() {
        var infoWindow = new google.maps.InfoWindow;
        map = new google.maps.Map(document.getElementById('googleMap'), {
            zoom: 10,
            center: new google.maps.LatLng(24.782765, 46.782498),
            mapTypeId: 'roadmap'
        });

        var iconBase = 'https://maps.google.com/mapfiles/kml/shapes/';
        var icons = {
            active: {
                icon: "{{asset('/dist/img/loading-active.png')}}"
            },
            inactive:{
                icon: "{{asset('/dist/img/loading-inactive.png')}}"
            },
            default:{
                icon: "{{asset('/dist/img/loading-default.png')}}"
            }
        };

        var features = [
            @foreach($user->provider->loadings as $loading)
                {
                    position: new google.maps.LatLng("{{$loading->lat}}", "{{$loading->long}}"),
                    type: @if($loading->default == PROVIDER_LOADING_DEFAULT)
                        'default'
                            @elseif($loading->status == PROVIDER_LOADING_ACTIVE)
                        'active'
                            @else
                        'inactive'
                            @endif,
                    name: "{{$loading->name}}",
                    address: "{{$loading->address}}"

                },
            @endforeach

        ];

        var bounds = new google.maps.LatLngBounds();

        // Create markers.
        features.forEach(function(feature) {
            var marker = new google.maps.Marker({
                position: feature.position,
                icon: icons[feature.type].icon,
                map: map
            });

            var html = "<span style='margin-right: 20px;font-weight: bold'><br><b>" + feature.name + "</b><br><b>" + feature.address + "</b></span>";

            bindInfoWindow(marker, map, infoWindow, html);

            bounds.extend(marker.position);
        });
        map.fitBounds(bounds);

    }

    function bindInfoWindow(marker, map, infoWindow, html) {
        google.maps.event.addListener(marker, 'click', function() {
            infoWindow.setContent(html);
            infoWindow.open(map, marker);
        });
    }
</script>
<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDgIKx-8qqL3I3a-cVETwnf2UbgVzm1zus&callback=initMap">
</script>
@endif
<script>
    $(document).ready(function() {
        /* Select2 Init*/
        $(".select2").select2();

        /* Basic Init*/
        $('.dropify').dropify();

        /* Bootstrap switch Init*/
        if($('#provider_active').length > 0){
            $('#provider_active').bootstrapSwitch('state', $('#provider_active').data('user-state'));
            $('#provider_active').bootstrapSwitch('toggleReadonly', true);
        }


        if($('#delivery_active').length > 0){
            $('#delivery_active').bootstrapSwitch('state', $('#delivery_active').data('user-state'));
            $('#delivery_active').bootstrapSwitch('toggleReadonly', true);
        }

        $("#country_id").change(function(){
            var postData = {_token: "{{ csrf_token() }}",country_id:$(this).val()}
            $.ajax({
                url: '{{url("/user/country/cities")}}',
                type: 'GET',
                data: postData,
                dataType: 'JSON',
                success: function (data) {
                    //console.log(data);
                    if(data.status){
                        $("#city_id option").remove();
                        $.each(data.result.data, function(key, value) {
                            $('#city_id')
                                .append($("<option></option>")
                                    .attr("value",value.id)
                                    .text(value.name));
                        });

                    }

                }
            });
        })
    })
</script>
@endsection