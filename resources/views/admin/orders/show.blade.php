@extends('layouts.adminlayout')

@section('PageHeader')
{{__("general.Order")}}
@endsection

@section('PageLocation')
@parent

<li>
    <a href="{{url('/admin/orders')}}">
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
                                @if($order->admin_can_cancel)
                                <div class="col-md-12">
                                    <form action="{{url('/admin/orders/refuse')}}" method="POST">
                                        <input type="hidden" name="selected_order_id" value="{{$order->id}}" />
                                        {{ csrf_field() }}
                                        <div class="form-body">
                                            <div class="row">
                                                <div class="{{ $errors->has('selected_order_id') ? ' has-error' : '' }}">
                                                    <div class="form-group" >
                                                        <button type="submit" class="btn btn-warning btn-lable-wrap left-label"> <span class="btn-label"><i class="fa fa-exclamation-triangle"></i> </span><span class="btn-text">{{__('general.Refuse Order')}}</span></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                @endif
                                <div class="col-md-12">
                                    <form action="{{url('/admin/orders/assign')}}" method="POST">
                                        <input type="hidden" name="selected_order_id_to_assign" value="{{$order->id}}" />
                                        {{ csrf_field() }}
                                        <div class="form-body">
                                            <div class="row">
                                                @if(is_object($availableDelivery))
                                                <div class="col-md-9">
                                                    <div class="form-group {{ $errors->has('delivery_id') ? ' has-error' : '' }}">

                                                        <select class="form-control select2" name="delivery_id" >
                                                            <option value="">{{__("general.Assign Delivery")}}</option>
                                                            @foreach($availableDelivery as $delivery)
                                                            <option value="{{$delivery->id}}" >{{$delivery->user->name}}</option>
                                                            @endforeach
                                                        </select>
                                                        @if ($errors->has('delivery_id'))
                                                        <span class="help-block">
                                                        <strong>{{ $errors->first('delivery_id') }}</strong>
                                                    </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group" >
                                                        <button type="submit" class="btn btn-primary btn-lable-wrap">
                                                            <span class="btn-text">{{__('general.Assign Delivery')}}</span>
                                                        </button>
                                                    </div>
                                                </div>
                                                @endif
                                            </div>
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
</div>


@include('partials.orders.show', ['order' => $order , 'userType' => ADMIN])
@endsection