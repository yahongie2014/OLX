@extends('layouts.adminlayout')

@section('PageHeader')
{{__("general.addNewCity")}}
@endsection

@section('PageLocation')
@parent

<li>
    <a href="{{url('/admin/cities')}}">
        {{__("general.Cities")}}
    </a>
</li>
<li>
    <a href="#">
        {{__("general.addNewCity")}}
    </a>
</li>
@endsection
@section('content')
@parent
<!-- Row -->
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-default card-view">
            <div class="panel-wrapper collapse in">
                <div class="panel-body">
                    <form action="{{url('/admin/cities/')}}" enctype="multipart/form-data"  method="POST">
                        <div class="row">
                            <div class="col-sm-6">
                                <h6 class="txt-dark capitalize-font"><i class="ti ti-location-pin mr-10"></i>{{__("general.CityInformation")}}</h6>
                                <hr class="light-grey-hr"/>
                                {{ csrf_field() }}

                                <div class="form-body overflow-hide">
                                    <div class="form-group">
                                        <div class="checkbox checkbox-primary pr-10 pull-left">
                                            <input id="cityAvailability" value="1" name="status" type="checkbox" @if(old('status')) checked @endif>
                                            <label for="cityAvailability"> {{__("general.available")}} </label>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>

                                    <div class="form-group {{ $errors->has('city_name') ? ' has-error' : '' }}">
                                        <label class="control-label mb-10" for="exampleInputuname_01" >{{__("general.city_name")}}</label>
                                        <div class="input-group">

                                            <input type="text" maxlength="90" class="form-control " id="exampleInputuname_01" name="city_name" value="{{old('city_name')}}" required />
                                        </div>
                                        @if ($errors->has('city_name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('city_name') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                    <div class="form-group {{ $errors->has('country_id') ? ' has-error' : '' }}">
                                        <label class="control-label mb-10">{{__("general.Country")}}</label>
                                        <select class="form-control select2" name="country_id" required>
                                            @foreach($countries as $country)
                                            <option value="{{$country->id}}" >{{$country->name}}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('country_id'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('country_id') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6 col-mx-auto">
                                <h6 class="txt-dark capitalize-font"><i class="zmdi zmdi-translate mr-10"></i>{{__("general.Localization")}}</h6>
                                <hr class="light-grey-hr"/>
                                <div class="panel panel-default card-view">
                                    <div class="panel-wrapper collapse in">
                                        <div class="panel-heading">
                                            {{__("general.Localization")}}
                                        </div>
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="form-body overflow-hide">
                                                        @foreach($languages as $language)
                                                        <div class="form-group {{ $errors->has('language.'. $language->id) ? ' has-error' : '' }}">
                                                            <label class="control-label mb-10" for="exampleInputuname_01" >{{$language->name}}</label>
                                                            <div class="input-group">

                                                                <input type="text" maxlength="20" class="form-control " id="exampleInputuname_01" name="language[{{$language->id}}]" value="{{old('language.'. $language->id)}}"  />
                                                            </div>
                                                            @if ($errors->has('language.'. $language->id))
                                                            <span class="help-block">
                                                                <strong>{{ $errors->first('language.'. $language->id) }}</strong>
                                                            </span>
                                                            @endif
                                                        </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-actions mt-10">
                                <button type="submit" class="btn btn-success mr-10 mb-30">{{__('general.Save')}}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">

</div>

@endsection

<!-- /Row -->
@section('footer')
@parent
<script>
    $(document).ready(function(){
        "use strict";

        /* Select2 Init*/
        $(".select2").select2();
    });
</script>
@endsection