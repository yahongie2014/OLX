@extends('layouts.providerlayout')

@section('PageHeader')
{{__("general.Orders")}}
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
@include('partials.orders.view', ['editRoute' => $editRoute  , 'loginType' => PROVIDER])
@endsection