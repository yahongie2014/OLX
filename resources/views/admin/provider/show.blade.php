@extends('layouts.adminlayout')

@section('PageHeader')
{{__("general.Providers")}}
@endsection

@section('PageLocation')
@parent

<li>
    <a href="#">
        {{__("general.Providers")}}
    </a>
</li>
@endsection

@section('content')
@parent
@include('partials.provider.view', ['providers' => $providers])
@endsection