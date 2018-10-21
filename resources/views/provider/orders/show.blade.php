@extends('layouts.providerlayout')

@section('PageHeader')
{{__("general.Order")}}
@endsection

@section('PageLocation')
@parent

<li>
    <a href="{{url('/provider/orders')}}">
        {{__("general.Orders")}}
    </a>
</li>
@endsection

@section('content')
@parent
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default card-view">
            <div class="panel-wrapper collapse in">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-sm-12 col-xs-12" style="text-align: center">

                            <div class="form-wrap">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label mb-10"></label>
                                        <p class="text-primary mb-10">{{__("general.".StaticArray::$orderStatus[$order->status])}}</code></p>
                                    </div>
                                </div>
                                @if($order->provider_can_cancel)
                                <form action="{{url('/provider/orders/cancel')}}" method="POST">
                                    <input type="hidden" name="order_id" value="{{$order->id}}" />
                                    {{ csrf_field() }}
                                    <div class="form-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                @if ($errors->has('order_id'))
                                                <div class="alert alert-warning alert-dismissable alert-style-1">
                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                    <i class="zmdi zmdi-alert-circle-o"></i>{{ $errors->first('order_id') }}
                                                </div>
                                                @endif
                                            </div>

                                            <div class="col-md-12 {{ $errors->has('order_id') ? ' has-error' : '' }}">
                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-danger btn-lable-wrap left-label"> <span class="btn-label"><i class="fa fa-exclamation-triangle"></i> </span><span class="btn-text">{{__('general.Cancel Order')}}</span></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('partials.orders.show', ['order' => $order , 'userType' => PROVIDER])
@endsection