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
@include('partials.orders.show', ['order' => $order , 'userType' => ADMIN])
@endsection