<!DOCTYPE html>
@php
    App::setLocale('ar');
@endphp
<html lang="{{ app()->getLocale() }}">
<head>

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <title>{{ config('app.name', 'Laravel') }}</title>
    <meta name="description" content="Philbert is a Dashboard & Admin Site Responsive Template by hencework."/>
    <meta name="keywords"
          content="admin, admin dashboard, admin template, cms, crm, Philbert Admin, Philbertadmin, premium admin templates, responsive admin, sass, panel, software, ui, visualization, web app, application"/>
    <meta name="author" content="hencework"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Favicon -->
    <link rel="shortcut icon" href="favicon.ico">
    <link rel="icon" href="favicon.ico" type="image/x-icon">

    <!-- vector map CSS -->
    <link href="{{asset('vendors/bower_components/jasny-bootstrap/dist/css/jasny-bootstrap.min.css')}}" rel="stylesheet"
          type="text/css"/>

    <!-- Custom CSS -->
    <link href="{{asset('dist/css/style-rtl.css')}}" rel="stylesheet" type="text/css">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        #video_background {
            position: fixed;
            bottom: 0;
            right: 0;
            min-width: 100%;
            min-height: 100%;
            width: auto;
            height: auto;
            z-index: 0;
            overflow: hidden;
            -webkit-backface-visibility: hidden;
            -webkit-transform: translateZ(0);
        }

        .opacity-80 {
            opacity: 0.8;
        }

        .gradient-17 {
            background: linear-gradient(125.67deg, rgba(2, 199, 188, 1) 25.29%, rgba(12, 180, 182, 1) 34.08%, rgba(23, 160, 176, 1) 45.94%, rgba(29, 149, 172, 1) 58.05%, rgba(31, 145, 171, 1) 70.7%, rgba(33, 133, 151, 1) 95.54%, rgba(33, 131, 147, 1) 100%) !important;
        }

        .overlay {
            position: fixed;
            background: linear-gradient(125.67deg, rgba(2, 199, 188, 1) 25.29%, rgba(12, 180, 182, 1) 34.08%, rgba(23, 160, 176, 1) 45.94%, rgba(29, 149, 172, 1) 58.05%, rgba(31, 145, 171, 1) 70.7%, rgba(33, 133, 151, 1) 95.54%, rgba(33, 131, 147, 1) 100%) !important;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            opacity: 0.8;

            z-index: 2;
        }

        .brand-text-white {
            color: white !important;
            font-weight: bold !important;
        }
    </style>
</head>
<body>
<!--Preloader-->
<div class="preloader-it">
    <div class="la-anim-1"></div>
</div>
<!--/Preloader-->

<video id="video_background" class="video_bg" preload="auto" autoplay="true" loop="loop" muted="muted" volume="0">

    <source src="{{asset('dist/img/jibli.mp4')}}" type="video/mp4">
    <source src="{{asset('dist/img/jibli.ogg')}}" type="video/ogg">

</video>
<div class="wrapper pa-0 gradient-17 ">
    <header class="sp-header" style="z-index: 4;">
        <div class="sp-logo-wrap pull-left">
            <a href="{{url('/')}}">
                <img class="brand-img mr-10" src="{{asset('dist/img/logo3.png')}}" alt="brand"/>
                <span class="brand-text brand-text-white">{{ config('app.name', 'Laravel') }}</span>
            </a>
        </div>
        <div class="form-group mb-0 pull-right">
            <span class="inline-block pr-10 brand-text-white"
                  style="/*color:black*/">{{__("general.Don't have an account?")}}</span>
            <a class="inline-block btn btn-info btn-success btn-rounded brand-text-white"
               href="{{ route('register') }}">{{__("general.Sign Up")}}</a>
        </div>
        <div class="clearfix"></div>
    </header>

    <!-- Main Content -->
    <div class="page-wrapper pa-0 ma-0 auth-page overlay gradient-17">
        <div class="container-fluid">
            <!-- Row -->

            <div class="table-struct full-width full-height">
                <div class="table-cell vertical-align-middle auth-form-wrap">
                    <div class="auth-form  ml-auto mr-auto no-float">

                        <div class="overlay">
                            <div class="gradient-overlay gradient-17 opacity-80"></div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-xs-12" style="z-index: 3;">
                                <div class="mb-30">
                                    <h3 class="text-center txt-dark mb-10 brand-text-white">{{__("general.Sign in")}}</h3>
                                </div>
                                <div class="form-wrap ">
                                    <form method="POST" action="{{ route('login') }}">
                                        {{ csrf_field() }}
                                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }} ">
                                            <label class="control-label mb-10 brand-text-white"
                                                   for="exampleInputEmail_2">{{__("general.Email")}}</label>
                                            <input type="email" class="form-control" name="email"
                                                   value="{{ old('email') }}" required>
                                            @if ($errors->has('email'))
                                                <span class="help-block">
                                                            <strong>{{ $errors->first('email') }}</strong>
                                                        </span>
                                            @endif
                                        </div>
                                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                            <label class="pull-left control-label mb-10 brand-text-white"
                                                   for="exampleInputpwd_2">{{__("general.Password")}}</label>
                                            <a class="capitalize-font txt-primary block mb-10 pull-right font-12"
                                               style="color:white !important;"
                                               href="{{url('/reset/password')}}">{{__("general.forgot password ?")}}</a>
                                            <div class="clearfix"></div>
                                            <input type="password" class="form-control" name="password" required>
                                            @if ($errors->has('password'))
                                                <span class="help-block">
                                                            <strong>{{ $errors->first('password') }}</strong>
                                                        </span>
                                            @endif
                                        </div>

                                        <!--<div class="form-group">
                                            <div class="checkbox checkbox-primary pr-10 pull-left">
                                                <input id="checkbox_2" required="" type="checkbox">
                                                <label for="checkbox_2"> Keep me logged in</label>
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>-->
                                        <div class="form-group text-center">
                                            <button type="submit"
                                                    class="btn btn-info btn-success btn-rounded">{{__("general.sign in")}}</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Row -->
        </div>

    </div>
    <!-- /Main Content -->

</div>
<!-- /#wrapper -->

<!-- JavaScript -->

<!-- jQuery -->
<script src="{{asset('vendors/bower_components/jquery/dist/jquery.min.js')}}"></script>

<!-- Bootstrap Core JavaScript -->
<script src="{{asset('vendors/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<script src="{{asset('vendors/bower_components/jasny-bootstrap/dist/js/jasny-bootstrap.min.js')}}"></script>

<!-- Slimscroll JavaScript -->
<script src="{{asset('dist/js/jquery.slimscroll.js')}}"></script>

<!-- Init JavaScript -->
<script src="{{asset('dist/js/init.js')}}"></script>
</body>
</html>