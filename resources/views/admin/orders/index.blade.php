@extends('layouts.adminlayout')

@section('PageHeader')
{{__("general.Orders")}}
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
@include('partials.orders.view', ['editRoute' => $editRoute , 'loginType' => ADMIN])
@endsection