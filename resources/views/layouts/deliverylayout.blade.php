@extends('layouts.mainlayout')
@section('title', config('app.name', 'Laravel') . ' | Delivery Dashboard')

@section('headerBar')
<li>
    <a href="{{url('/delivery/profile/' . Auth::user()->id)}}"><i class="zmdi zmdi-account"></i><span>{{__("general.Profile")}}</span></a>
</li>
@endsection

@section('PageHeader')

@endsection

@section('PageLocation')

<li>
    <a href="{{url('/delivery')}}">{{__("general.Home")}}</a>
</li>

<li>
    <span></span>
</li>
@endsection


@section('leftSideBar')
<!-- Left Sidebar Menu -->
<div class="fixed-sidebar-left">
    <ul class="nav navbar-nav side-nav nicescroll-bar">
        <li class="navigation-header">
            <span></span>
            <i class="zmdi zmdi-more"></i>
        </li>
        <li>
            <a href="{{url('/delivery')}}">
                <div class="pull-left">
                    <i class="zmdi zmdi-home mr-20"></i>
                    <span class="right-nav-text">{{__("general.Home")}}</span>
                </div>
                <div class="clearfix">

                </div>
            </a>
        </li>
        <li>
            <a href="{{url('/delivery/profile/' . Auth::user()->id)}}">
                <div class="pull-left">
                    <i class="zmdi zmdi-account mr-20"></i>
                    <span class="right-nav-text">{{__("general.Profile")}}</span>
                </div>
                <div class="clearfix">

                </div>
            </a>
        </li>
        <li>
            <a href="{{url('/delivery/orders')}}">
                <div class="pull-left">
                    <i class="zmdi zmdi-labels mr-20"></i>
                    <span class="right-nav-text">{{__("general.Orders")}}</span>
                </div>
                <div class="clearfix">

                </div>
            </a>
        </li>
    </ul>
</div>
<!-- /Left Sidebar Menu -->

@endsection

@section('content')

@endsection