@extends('layouts.adminlayout')

@section('PageHeader')
{{__("general.updateService")}}
@endsection

@section('PageLocation')
@parent

<li>
    <a href="{{url('/admin/services')}}">
        {{__("general.Service Types")}}
    </a>
</li>
<li>
    <a href="#">
        {{__("general.updateService")}}
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
                    <form action="{{url('/admin/services/' . $service->id)}}" enctype="multipart/form-data"  method="POST">
                        <div class="row">
                            <div class="col-sm-12">
                                <h6 class="txt-dark capitalize-font"><i class="zmdi zmdi-card-giftcard mr-10"></i>{{__("general.ServiceInformation")}}</h6>
                                <hr class="light-grey-hr"/>
                                {{ method_field('PATCH') }}
                                {{ csrf_field() }}
                                <input type="hidden" value="{{$service->id}}" name="service_type_id">
                                <div class="form-body overflow-hide">
                                    <div class="form-group">
                                        <div class="checkbox checkbox-primary pr-10 pull-left">
                                            <input id="languageAvailability" value="1" name="status" type="checkbox" @if(old('status')) checked @elseif($service->status == SERVICE_TYPE_ACTIVE) checked @endif>
                                            <label for="languageAvailability"> {{__("general.available")}} </label>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>

                                    <div class="form-group {{ $errors->has('service_type_name') ? ' has-error' : '' }}">
                                        <label class="control-label mb-10" for="exampleInputuname_01" >{{__("general.service_type_name")}}</label>
                                        <div class="input-group">

                                            <input type="text" maxlength="100" class="form-control " id="exampleInputuname_01" name="service_type_name" value=@if(old('service_type_name')) "{{old('service_type_name')}}" @else "{{$service->name}}" @endif required />
                                        </div>
                                        @if ($errors->has('service_type_name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('service_type_name') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                    <div class="form-group {{ $errors->has('min_time_deliver') ? ' has-error' : '' }}">
                                        <label class="control-label mb-10" for="exampleInputuname_01" >{{__("general.minTimeToDeliver")}}</label>
                                        <div class="input-group">

                                            <input type="text" maxlength="100" class="form-control allownumericwithdecimal" id="exampleInputuname_01" name="min_time_deliver" value=@if(old('min_time_deliver')) "{{old('min_time_deliver')}}" @else "{{$service->min_time}}" @endif required />
                                        </div>
                                        @if ($errors->has('min_time_deliver'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('min_time_deliver') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                    <div class="form-group {{ $errors->has('service_type_type') ? ' has-error' : '' }}">
                                        <div class="radio-list">
                                            <!--<label class="control-label mb-10"> {{__("general.ServiceTypeType")}} </label>-->
                                            <div class="radio-inline pl-0">
                                                <span class="radio radio-success">
                                                    <input type="radio"  id="radio_5" value="{{MAIN_SERVICE_TYPE}}" @if(old('service_type_type') == MAIN_SERVICE_TYPE) @elseif($service->type == MAIN_SERVICE_TYPE) checked @endif>
                                                    <label for="radio_5">{{__("general.mainServiceType")}}</label>
                                                </span>
                                            </div>
                                            <div class="radio-inline">
                                                <span class="radio radio-success">
                                                    <input type="radio"  id="radio_6" value="{{EXTRA_SERVICE_TYPE}}" @if(old('service_type_type') == EXTRA_SERVICE_TYPE) checked @elseif($service->type == EXTRA_SERVICE_TYPE) @endif>
                                                    <label for="radio_6">{{__("general.extraServiceType")}}</label>
                                                </span>
                                            </div>
                                            @if ($errors->has('service_type_type'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('service_type_type') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6 col-mx-auto">
                                <h6 class="txt-dark capitalize-font"><i class="zmdi zmdi-translate mr-10"></i>{{__("general.Localization")}}</h6>
                                <hr class="light-grey-hr"/>
                                <div class="panel panel-default card-view">
                                    <div class="panel-wrapper collapse in">

                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="form-body overflow-hide">
                                                        @foreach($languages as $language)
                                                        <div class="form-group {{ $errors->has('language['. $language->id .']') ? ' has-error' : '' }}">
                                                            <label class="control-label mb-10" for="exampleInputuname_01" >{{$language->name}}</label>
                                                            <div class="input-group">

                                                                <input type="text" maxlength="100" class="form-control " id="exampleInputuname_01" name="language[{{$language->id}}]" value=@if(isset($serviceLanguages[$language->id])) "{{$serviceLanguages[$language->id]->pivot->name}}" @else ""  @endif  />
                                                            </div>
                                                            @if ($errors->has('language['. $language->id .']'))
                                                            <span class="help-block">
                                                                <strong>{{ $errors->first('language['. $language->id .']') }}</strong>
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
                            <div class="col-sm-6 col-mx-auto">
                                <h6 class="txt-dark capitalize-font"><i class="fa fa-money mr-10"></i>{{__("general.Pricing")}}</h6>
                                <hr class="light-grey-hr"/>
                                <div class="panel panel-default card-view">
                                    <div class="panel-wrapper collapse in">

                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="form-body overflow-hide">
                                                        @foreach($countries as $country)
                                                        <div class="form-group {{ $errors->has('country['. $country->id .']') ? ' has-error' : '' }}">
                                                            <label class="control-label mb-10" for="exampleInputuname_01" >{{$country->name}}</label>
                                                            <div class="input-group">

                                                                <input type="text" maxlength="100" class="form-control allownumericwithdecimal" id="exampleInputuname_01" name="country[{{$country->id}}]" value=@if(isset($serviceCountries[$country->id])) "{{$serviceCountries[$country->id]->pivot->price}}" @else "0.00"  @endif  />
                                                            </div>
                                                            @if ($errors->has('country['. $country->id .']'))
                                                            <span class="help-block">
                                                                <strong>{{ $errors->first('country['. $country->id .']') }}</strong>
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
        $('#languagesTable').DataTable();
    });
</script>
@endsection