@extends('layouts.adminlayout')

@section('PageHeader')
{{__("general.updatePaymentType")}}
@endsection

@section('PageLocation')
@parent

<li>
    <a href="{{url('/admin/paytypes')}}">
        {{__("general.Payment Types")}}
    </a>
</li>
<li>
    <a href="#">
        {{__("general.updatePaymentType")}}
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
                    <form action="{{url('/admin/paytypes/' . $paymentType->id)}}" enctype="multipart/form-data"  method="POST">
                        <div class="row">
                            <div class="col-sm-12">
                                <h6 class="txt-dark capitalize-font"><i class="fa fa-credit-card mr-10"></i>{{__("general.PaymentTypeInformation")}}</h6>
                                <hr class="light-grey-hr"/>
                                {{ method_field('PATCH') }}
                                {{ csrf_field() }}
                                <input type="hidden" value="{{$paymentType->id}}" name="payment_type_id">
                                <div class="form-body overflow-hide">
                                    <div class="form-group">
                                        <div class="checkbox checkbox-primary pr-10 pull-left">
                                            <input id="languageAvailability" value="1" name="status" type="checkbox" @if(old('status')) checked @elseif($paymentType->status == PAYMENT_TYPE_ACTIVE) checked @endif>
                                            <label for="languageAvailability"> {{__("general.available")}} </label>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>

                                    <div class="form-group {{ $errors->has('payment_type_name') ? ' has-error' : '' }}">
                                        <label class="control-label mb-10" for="exampleInputuname_01" >{{__("general.payment_type_name")}}</label>
                                        <div class="input-group">

                                            <input type="text" maxlength="100" class="form-control " id="exampleInputuname_01" name="payment_type_name" value=@if(old('payment_type_name')) "{{old('payment_type_name')}}" @else "{{$paymentType->name}}" @endif required />
                                        </div>
                                        @if ($errors->has('payment_type_name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('payment_type_name') }}</strong>
                                        </span>
                                        @endif
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
                                                        <div class="form-group {{ $errors->has('language.'. $language->id) ? ' has-error' : '' }}">
                                                            <label class="control-label mb-10" for="exampleInputuname_01" >{{$language->name}}</label>
                                                            <div class="input-group">

                                                                <input type="text" maxlength="100" class="form-control " id="exampleInputuname_01" name="language[{{$language->id}}]" value=@if(old('language.'. $language->id)) {{old('language.'. $language->id)}} @elseif(isset($paymentTypeLanguages[$language->id])) "{{$paymentTypeLanguages[$language->id]->pivot->name}}" @else ""  @endif  />
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
                                                        <div class="form-group {{ $errors->has('country.'. $country->id) ? ' has-error' : '' }}">
                                                            <label class="control-label mb-10" for="exampleInputuname_01" >{{$country->name}}</label>
                                                            <div class="input-group">

                                                                <input type="text" maxlength="100" class="form-control allownumericwithdecimal" id="exampleInputuname_01" name="country[{{$country->id}}]" value=@if(old('country.'. $country->id)) {{old('country.'. $country->id)}} @elseif(isset($paymentTypeCountries[$country->id])) "{{$paymentTypeCountries[$country->id]->pivot->price}}" @else "0.00"  @endif  />
                                                            </div>
                                                            @if ($errors->has('country.'. $country->id))
                                                            <span class="help-block">
                                                                <strong>{{ $errors->first('country.'. $country->id) }}</strong>
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