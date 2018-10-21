@extends('layouts.adminlayout')

@section('content')
    @parent
    @include('partials.orders.view', ['orders' => $orders])
@endsection