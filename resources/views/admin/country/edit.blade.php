@extends('layouts.adminlayout')

@section('PageHeader')
{{__("general.updateCountry")}}
@endsection

@section('PageLocation')
@parent

<li>
    <a href="{{url('/admin/countries')}}">
        {{__("general.Countries")}}
    </a>
</li>
<li>
    <a href="#">
        {{__("general.updateCountry")}}
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
                    <form action="{{url('/admin/countries/' . $country->id)}}" enctype="multipart/form-data"  method="POST">
                        <div class="row">
                            <div class="col-sm-6">
                                <h6 class="txt-dark capitalize-font"><i class="zmdi zmdi-flag mr-10"></i>{{__("general.CountryInformation")}}</h6>
                                <hr class="light-grey-hr"/>
                                {{ method_field('PATCH') }}
                                {{ csrf_field() }}
                                <input type="hidden" value="{{$country->id}}" name="country_id">
                                <div class="form-body overflow-hide">
                                    <div class="checkbox checkbox-primary pr-10 pull-left">
                                        <input id="languageAvailability" value="1" name="status" type="checkbox" @if(old('status')) checked @elseif($country->status == COUNTRY_ACTIVE) checked @endif>
                                        <label for="languageAvailability"> {{__("general.available")}} </label>
                                    </div>
                                    <div class="clearfix"></div>

                                    <div class="form-group {{ $errors->has('country_name') ? ' has-error' : '' }}">
                                        <label class="control-label mb-10" for="exampleInputuname_01" >{{__("general.country_name")}}</label>

                                            <input type="text" maxlength="20" class="form-control " id="exampleInputuname_01" name="country_name" value=@if(old('country_name')) "{{old('country_name')}}" @else "{{$country->name}}" @endif required />

                                        @if ($errors->has('country_name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('country_name') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                    <div class="form-group {{ $errors->has('currency_name') ? ' has-error' : '' }}">
                                        <label class="control-label mb-10" for="exampleInputuname_01">{{__("general.currency_name")}}</label>

                                            <input type="text" maxlength="20" class="form-control " id="exampleInputuname_01" name="currency_name" value=@if(old('currency_name')) "{{old('currency_name')}}" @else "{{$country->currency_name}}" @endif required />

                                        @if ($errors->has('currency_name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('currency_name') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                    <div class="form-group {{ $errors->has('currency_symbol') ? ' has-error' : '' }}">
                                        <label class="control-label mb-10" for="exampleInputuname_01">{{__("general.currency_symbol")}}</label>

                                            <input type="text" maxlength="20" class="form-control " id="exampleInputuname_01" name="currency_symbol" value=@if(old('currency_symbol')) "{{old('currency_symbol')}}" @else "{{$country->currency_symbol}}" @endif required />

                                        @if ($errors->has('currency_symbol'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('currency_symbol') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                    <div class="form-group {{ $errors->has('code') ? ' has-error' : '' }}">
                                        <label class="control-label mb-10" for="exampleInputuname_01">{{__("general.code")}}</label>


                                            <input type="text" maxlength="5" class="form-control allownumericwithoutdecimal" id="exampleInputuname_01" name="code" value=@if(old('code')) "{{old('code')}}" @else "{{$country->code}}" @endif required />

                                        @if ($errors->has('code'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('code') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                    <div class="form-group {{ $errors->has('time_zone') ? ' has-error' : '' }}">
                                        <label class="control-label mb-10" for="exampleInputuname_01">{{__("general.time_zone")}}</label>

                                            <select class="form-control select2" name="time_zone" required>

                                                @foreach(timezone_identifiers_list() as $time_zone)
                                                <option value="{{$time_zone}}" @if(old('time_zone')) @if(old('time_zone') == $time_zone) selected @endif @elseif( $country->time_zone == $time_zone ) selected @endif >{{$time_zone}}</option>
                                                @endforeach
                                            </select>

                                        @if ($errors->has('time_zone'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('time_zone') }}</strong>
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

                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="form-body overflow-hide">
                                                        @foreach($languages as $language)
                                                        <div class="form-group {{ $errors->has('language.'. $language->id) ? ' has-error' : '' }}">
                                                            <label class="control-label mb-10" for="exampleInputuname_01" >{{$language->name}}</label>
                                                            <div class="input-group">

                                                                <input type="text" maxlength="20" class="form-control " id="exampleInputuname_01" name="language[{{$language->id}}]" value=@if(old('language.'. $language->id)) {{old('language.'. $language->id)}} @elseif(isset($countryLanguages[$language->id])) "{{$countryLanguages[$language->id]->pivot->name}}" @else ""  @endif  />
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