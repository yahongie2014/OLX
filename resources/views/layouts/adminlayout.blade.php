@extends('layouts.mainlayout')
@section('title', env('APP_NAME', 'At Time') . ' | Admin Dashboard')

@section('headerBar')
<li>
    <a href="{{url('/admin/profile/' . Auth::user()->id)}}"><i class="zmdi zmdi-account"></i><span>{{__("general.Profile")}}</span></a>
</li>
@endsection


@section('PageLocation')

<li>
    <a href="{{url('/admin')}}">{{__("general.Home")}}</a>
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
                <a href="{{url('/admin')}}">
                    <div class="pull-left">
                        <i class="zmdi zmdi-home mr-20"></i>
                        <span class="right-nav-text">{{__("general.Home")}}</span>
                    </div>
                    <div class="clearfix">

                    </div>
                </a>
            </li>
            <li>
                <a href="{{url('/admin/provider')}}">
                    <div class="pull-left">
                        <i class="zmdi zmdi-shopping-cart mr-20"></i>
                        <span class="right-nav-text">{{__("general.Providers")}}</span>
                    </div>
                    <div class="clearfix">

                    </div>
                </a>
            </li>

            <li>
            <li>
                <a href="{{url('/admin/orders')}}">
                    <div class="pull-left">
                        <i class="zmdi zmdi-labels mr-20"></i>
                        <span class="right-nav-text">{{__("general.Orders")}}</span>
                    </div>
                    <div class="clearfix">

                    </div>
                </a>
            </li>
            <li>
                <a href="javascript:void(0);" data-toggle="collapse" data-target="#dashboard_dr">
                    <div class="pull-left">
                        <i class="zmdi zmdi-settings mr-20"></i>
                        <span class="right-nav-text">{{__("general.Settings")}}</span>
                    </div>
                    <div class="pull-right">
                        <i class="zmdi zmdi-caret-down"></i>
                    </div>
                    <div class="clearfix">

                    </div>
                </a>
                <ul id="dashboard_dr" class="collapse collapse-level-1">

                    <li>
                        <a href="{{url('/admin/languages')}}">{{__("general.Languages")}}</a>
                    </li>
                    <li>
                        <a href="{{url('/admin/countries')}}">{{__("general.Countries")}}</a>
                    </li>
                    <li>
                        <a href="{{url('/admin/cities')}}">{{__("general.Cities")}}</a>
                    </li>
                    <li>
                        <a href="{{url('/admin/categories')}}">{{__("general.Categories")}}</a>
                    </li>
                    <li>
                        <a href="{{url('/admin/services')}}">{{__("general.Service Types")}}</a>
                    </li>
                    <li>
                        <a href="{{url('/admin/payment')}}">{{__("general.Payment Types")}}</a>
                    </li>
                    <li>
                        <a href="{{url('/admin/users/admin')}}">{{__("general.Admins")}}</a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
    <!-- /Left Sidebar Menu -->
@endsection

@section('content')

@endsection