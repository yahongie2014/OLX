@extends('layouts.providerlayout')

@section('PageHeader')
{{__("general.Profile")}}
@endsection

@section('PageLocation')
@parent

<li>
    <a href="{{url('/vendors/profile/' . Auth::user()->id)}}">
        {{__("general.Profile")}}
    </a>
</li>
@endsection

@section('content')
@parent
@include('partials.user.show', ['user' => $user , 'loginType' => 2])
@endsection