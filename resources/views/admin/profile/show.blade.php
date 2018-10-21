@extends('layouts.adminlayout')

@section('PageHeader')
{{__("general.Profile")}}
@endsection

@section('PageLocation')
@parent

<li>
    <a href="#">
        {{__("general.Profile")}}
    </a>
</li>
@endsection

@section('content')
@parent

@if($user->provider)
<div class="row">
    <div class="col-md-12">
        <div class="panel-group accordion-struct" id="accordion_1" role="tablist" aria-multiselectable="true">
            <div class="panel panel-default">
                <div class="panel-heading activestate" role="tab" id="heading_1">
                    <a role="button" data-toggle="collapse" data-parent="#accordion_1" href="#collapse_1" aria-expanded="false">{{__('general.ProviderPromoCode')}}</a>
                </div>
                <div id="collapse_1" class="panel-collapse collapse " role="tabpanel">
                    <div class="panel-body pa-15">
                        <div class="form-wrap">
                            <div class="form-body">
                                <form action="{{url('/admin/provider/' . $user->provider->id)}}" method="POST">
                                    {{ method_field('PATCH') }}
                                    {{ csrf_field() }}
                                    <input type="hidden" value="{{$user->provider->id}}" name="provider_id">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <!--<label class="control-label mb-10">{{__("general.ProviderPromoCode")}} : </label>-->
                                                @if($user->provider->promo_code)
                                                    <p class="text-success mb-10">{{$user->provider->promo_code}}</p>
                                                @else
                                                    <p class="text-danger mb-10">{{__("general.noProviderPromoCode")}}</p>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <h6 class="txt-dark capitalize-font"><i class="zmdi zmdi-card-giftcard mr-10"></i>{{__("general.servicesTypesDiscounts")}}</h6>
                                            <hr class="light-grey-hr"/>
                                            @foreach($services as $service)
                                            <div class="col-md-3">
                                                <div class="form-group {{ $errors->has('service.'. $service->id) ? ' has-error' : '' }}">
                                                    <label class="control-label mb-10" for="exampleInputuname_01" >{{$service->name}}</label>
                                                    <div class="input-group">

                                                        <input type="text" maxlength="20" class="form-control " id="exampleInputuname_01" name="service[{{$service->id}}]" value=@if(isset($serviceDiscount[$service->id])) "{{$serviceDiscount[$service->id]}}" @else 0  @endif  />
                                                        <div class="input-group-addon">
                                                            %
                                                        </div>
                                                    </div>
                                                    @if ($errors->has('service.'. $service->id))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('service.'. $service->id) }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                        <div class="col-md-12">
                                            <h6 class="txt-dark capitalize-font"><i class="fa fa-credit-card mr-10"></i>{{__("general.paymentTypesDiscounts")}}</h6>
                                            <hr class="light-grey-hr"/>
                                            @foreach($paymentTypes as $paymentType)
                                            <div class="col-md-3">
                                                <div class="form-group {{ $errors->has('paymentType.' . $paymentType->id) ? ' has-error' : '' }}">
                                                    <label class="control-label mb-10" for="exampleInputuname_01" >{{$paymentType->name}}</label>
                                                    <div class="input-group">

                                                        <input type="text" maxlength="20" class="form-control " id="exampleInputuname_01" name="paymentType[{{$paymentType->id}}]" value=@if(isset($paymentTypesDiscount[$paymentType->id])) "{{$paymentTypesDiscount[$paymentType->id]}}" @else 0  @endif  />
                                                        <div class="input-group-addon">
                                                            %
                                                        </div>
                                                    </div>
                                                    @if ($errors->has('paymentType.' . $paymentType->id))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('paymentType.' . $paymentType->id) }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
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
@include('partials.user.show', ['user' => $user , 'loginType' => ADMIN ])
@endsection