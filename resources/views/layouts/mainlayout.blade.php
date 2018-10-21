<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0, minimum-scale=1, maximum-scale=1.0, user-scalable=no"/>
    <title>@yield('title')</title>
    <meta name="description" content="Delivery App - alpha 1.0"/>
    <meta name="keywords"
          content="admin, admin dashboard, admin template, cms, crm, Philbert Admin, Philbertadmin, premium admin templates, responsive admin, sass, panel, software, ui, visualization, web app, application"/>
    <meta name="author" content="hencework"/>

    <!-- Favicon -->
    <link rel="shortcut icon" href="favicon.ico">
    <link rel="icon" href="favicon.ico" type="image/x-icon">

    <!-- Custom Fonts -->
    <link href="{{asset('dist/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css">


    <!-- select2 CSS -->
    <link href="{{asset('vendors/bower_components/select2/dist/css/select2.min.css')}}" rel="stylesheet"
          type="text/css"/>

    <!-- bootstrap-select CSS -->
    <link href="{{asset('vendors/bower_components/bootstrap-select/dist/css/bootstrap-select.min.css')}}"
          rel="stylesheet" type="text/css"/>

    <!-- Bootstrap Datetimepicker CSS -->
    <link href="{{asset('vendors/bower_components/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css')}}"
          rel="stylesheet" type="text/css"/>

    <!-- Bootstrap Dropify CSS -->
    <link href="{{asset('vendors/bower_components/dropify/dist/css/dropify.min.css')}}" rel="stylesheet"
          type="text/css"/>

    <!-- Bootstrap Switches CSS -->
    <link href="{{asset('vendors/bower_components/bootstrap-switch/dist/css/bootstrap3/bootstrap-switch.min.css')}}"
          rel="stylesheet" type="text/css"/>


    <!-- Data table CSS -->
    <link href="{{asset('vendors/bower_components/datatables/media/css/jquery.dataTables.min.css')}}" rel="stylesheet"
          type="text/css"/>

    <!--alerts CSS -->
    <link href="{{asset('vendors/bower_components/sweetalert/dist/sweetalert.css')}}" rel="stylesheet" type="text/css">

    <!-- Fancy-Buttons CSS -->
    <link href="{{asset('dist/css/fancy-buttons.css')}}" rel="stylesheet" type="text/css">

    <!-- Custom CSS -->

    @if( session()->has('userLanguage') )
        <link href="{{asset('dist/css/style-' . session()->get('userLanguage.direction') . '.css')}}" rel="stylesheet"
              type="text/css">
    @else
        <link href="{{asset('dist/css/style-rtl.css')}}" rel="stylesheet" type="text/css">
    @endif
    <style>
        @font-face {
            font-family: 'Conv_JF_FLAT_REGULAR';
            src: url('{{asset('')}}fonts/29ltbukraregular.ttf');
            src: local('☺'), url('{{asset('')}}p0ublic/fonts/29ltbukrabold.ttf') format('woff'), url('{{asset('')}}fonts/29ltbukralight.ttf') format('truetype'), url('{{asset('')}}public/fonts/JF_FLAT_REGULAR.svg') format('svg');
            font-weight: normal;
            font-style: normal;
        }

        th {
            text-align: center;
        }

        .centerCol {
            text-align: center;
        }

        .pac-card {
            margin: 10px 10px 0 0;
            border-radius: 2px 0 0 2px;
            box-sizing: border-box;
            -moz-box-sizing: border-box;
            outline: none;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
            background-color: #fff;
            font-family: 'Conv_JF_FLAT_REGULAR';
        }

        #pac-container {
            padding-bottom: 12px;
            margin-right: 12px;
        }

        .pac-controls {
            display: inline-block;
            padding: 5px 11px;
        }

        .pac-controls label {
            font-family: Roboto;
            font-size: 13px;
            font-weight: 300;
        }

        #pac-input {
            background-color: #fff;
            font-family: Roboto;
            font-size: 15px;
            font-weight: 300;
            margin-left: 12px;
            padding: 0 11px 0 13px;
            text-overflow: ellipsis;
            /*width: 400px;*/
            width: 50%
        }

        #pac-input:focus {
            border-color: #4d90fe;

        }

        #title {
            color: #fff;
            background-color: #4d90fe;
            font-size: 25px;
            font-weight: 500;
            padding: 6px 12px;
        }

        #target {
            width: 345px;
        }

        body,
        a,
        h4 {
            font-family: 'Conv_JF_FLAT_REGULAR';
        }


    </style>
</head>

<body>
<!--Preloader-->
<div class="preloader-it">
    <div class="la-anim-1"></div>
</div>
<!--/Preloader-->
<div class="wrapper theme-1-active pimary-color-green">

    <!-- Top Menu Items -->
    <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="mobile-only-brand pull-left">
            <div class="nav-header pull-left">
                <div class="logo-wrap">
                    <a href="{{url('/')}}">
                        <img class="brand-img" src="{{asset('dist/img/logo.png')}}" alt="brand"/>
                        <span class="brand-text">{{ config('app.name', 'Laravel') }}</span>
                    </a>
                </div>
            </div>
            @if(\Auth::user())
                <a id="toggle_nav_btn" class="toggle-left-nav-btn inline-block ml-20 pull-left"
                   href="javascript:void(0);"><i class="zmdi zmdi-menu"></i></a>
            @endif
            <a id="toggle_mobile_search" data-toggle="collapse" data-target="#search_form" class="mobile-only-view"
               href="javascript:void(0);"><i class="zmdi zmdi-search"></i></a>
            <a id="toggle_mobile_nav" class="mobile-only-view" href="javascript:void(0);"><i class="zmdi zmdi-more"></i></a>
        </div>
        <div id="mobile_only_nav" class="mobile-only-nav pull-right">
            <ul class="nav navbar-right top-nav pull-right">
                <!--<li>
                    <a id="open_right_sidebar" href="#"><i class="zmdi zmdi-settings top-nav-icon"></i></a>
                </li>-->

                @if(session()->has('systemLanguages'))
                    <li class="dropdown auth-drp" style="line-height: 66px;">

                        <select class="selectpicker" id="setUserLanguage" data-style="btn-success btn-outline">
                            @foreach(session()->get('systemLanguages') as $language)

                                <option value="{{$language->id}}"
                                        @if($language->id == session()->get('userLanguage.id')) selected @endif>{{$language->name}}</option>

                            @endforeach

                        </select>
                    </li>
                @endif
                <li class="dropdown auth-drp">
                    @if(Auth::user())
                        <a href="#" class="dropdown-toggle pr-0" data-toggle="dropdown">
                            <img src=@if(Auth::user()->image) "{{asset(Auth::user()->image)}}"
                                 @else {{asset("dist/img/user1.png")}} @endif alt="user_auth"
                                 class="user-auth-img img-circle"/>
                            <span class="user-online-status"></span>
                        </a>
                    @endif
                    <ul class="dropdown-menu user-auth-dropdown" data-dropdown-in="flipInX"
                        data-dropdown-out="flipOutX">
                        @section('headerBar')


                        @show
                        <li class="divider"></li>
                        <li>
                            <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                <i class="zmdi zmdi-power">

                                </i>
                                <span>{{__("general.Log Out")}}</span>
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
    <!-- /Top Menu Items -->

@section('leftSideBar')

@show




<!-- Right Sidebar Backdrop -->
    <div class="right-sidebar-backdrop"></div>
    <!-- /Right Sidebar Backdrop -->

    <!-- Main Content -->
    <div class="page-wrapper">
        <div class="container-fluid">
            <div class="panel panel-default card-view  pa-0" style="margin-left: -31px;margin-right: -33px;">
                <div class="panel-wrapper collapse in">
                    <div class="panel-body  pa-0">
                        <div class="profile-box">
                            <div class="profile-cover-pic" style="min-height: 296px;max-height: 296px;">
                                @if(Auth::user())
                                    <img src=@if(Auth::user()->cover_image) "{{asset(Auth::user()->cover_image)}}"
                                         @else {{asset("dist/img/cropper.jpg")}} @endif  style="height: 296px;width:100%;"/>
                                    <!--<div class="profile-image-overlay"></div>-->
                                @elseif($order)
                                    @if($order->provider->user->cover_image)
                                        <img src=@if($order->provider->user->cover_image) "{{asset($order->provider->user->cover_image)}}" @else
                                        "" @endif  style="height: 296px;width:100%;"/>
                                @endif

                                @endif
                            </div>
                            <div class="profile-info">
                                <div class="profile-img-wrap" style="width: 90%;padding: 1%">

                                    <!-- Title -->
                                    <div class="row heading-bg">

                                        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                                            <h5 class="txt-dark">
                                                @section('PageHeader')

                                                @show
                                            </h5>
                                        </div>

                                        <!-- Breadcrumb -->
                                        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                                            <ol class="breadcrumb">
                                                @section('PageLocation')
                                                    <li><a href="index.html">Dashboard</a></li>
                                                    <li><a href="#"><span>speciality pages</span></a></li>
                                                    <li class="active"><span>blank page</span></li>
                                                @show
                                            </ol>
                                        </div>
                                        <!-- /Breadcrumb -->
                                    </div>
                                    <!-- /Title -->
                                    @if(session()->has('messageSuccess'))
                                        <div class="alert alert-success alert-dismissable alert-style-1">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                                                &times;
                                            </button>
                                            <i class="zmdi zmdi-check"></i>{{ session()->get('messageSuccess') }}
                                        </div>
                                    @endif
                                    @if(session()->has('messageDanger'))
                                        <div class="alert alert-danger alert-dismissable alert-style-1">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                                                &times;
                                            </button>
                                            <i class="zmdi zmdi-alert-circle-o"></i>{{ session()->get('messageDanger') }}
                                        </div>
                                    @endif
                                    @if ($errors->any())
                                        <div class="alert alert-danger alert-dismissable alert-style-1">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                                                &times;
                                            </button>
                                            <i class="zmdi zmdi-alert-circle-o"></i>{{ __("general.error check fields") }}
                                        </div>
                                    @endif

                                    @yield('content')

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Footer -->
            <footer class="footer container-fluid pl-30 pr-30">
                <div class="row">
                    <div class="col-sm-12">
                        <p>2017 &copy; Delivery. Itsmart</p>
                    </div>
                </div>
            </footer>
            <!-- /Footer -->
        </div>

    </div>
    <!-- /Main Content -->

</div>
<!-- /#wrapper -->

@section('footer')
    <!-- JavaScript -->

    <!-- jQuery -->
    <script src="{{asset('vendors/bower_components/jquery/dist/jquery.min.js')}}"></script>



    <!-- Bootstrap Core JavaScript -->
    <script src="{{asset('vendors/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('vendors/bower_components/jasny-bootstrap/dist/js/jasny-bootstrap.min.js')}}"></script>


    <!-- Moment JavaScript -->
    <script type="text/javascript"
            src="{{asset('vendors/bower_components/moment/min/moment-with-locales.min.js')}}"></script>

    <!-- Bootstrap Datetimepicker JavaScript -->
    <script type="text/javascript"
            src="{{asset('vendors/bower_components/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js')}}"></script>

    <!-- Bootstrap Daterangepicker JavaScript -->
    <script src="{{asset('vendors/bower_components/bootstrap-daterangepicker/daterangepicker.js')}}"></script>

    <!-- Bootstrap Select JavaScript -->
    <script src="{{asset('vendors/bower_components/bootstrap-select/dist/js/bootstrap-select.min.js')}}"></script>

    <!-- Data table JavaScript -->
    <script src="{{asset('vendors/bower_components/datatables/media/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('dist/js/dataTables-data.js')}}"></script>

    <!-- Counter Animation JavaScript -->
    <script src="{{asset('vendors/bower_components/waypoints/lib/jquery.waypoints.min.js')}}"></script>
    <script src="{{asset('vendors/bower_components/jquery.counterup/jquery.counterup.min.js')}}"></script>

    <!-- Slimscroll JavaScript -->
    <script src="{{asset('dist/js/jquery.slimscroll.js')}}"></script>

    <!-- Owl JavaScript -->
    <script src="{{asset('vendors/bower_components/owl.carousel/dist/owl.carousel.min.js')}}"></script>

    <!-- Switchery JavaScript -->
    <script src="{{asset('vendors/bower_components/switchery/dist/switchery.min.js')}}"></script>

    <!-- Bootstrap Switch JavaScript -->
    <script src="{{asset('vendors/bower_components/bootstrap-switch/dist/js/bootstrap-switch.min.js')}}"></script>

    <!-- Fancy Dropdown JS -->
    <script src="{{asset('dist/js/dropdown-bootstrap-extended.js')}}"></script>

    <!-- Select2 JavaScript -->
    <script src="{{asset('vendors/bower_components/select2/dist/js/select2.full.min.js')}}"></script>

    <!-- Bootstrap Daterangepicker JavaScript -->
    <script src="{{asset('vendors/bower_components/dropify/dist/js/dropify.min.js')}}"></script>


    <!-- Fancy Dropdown JS -->
    <script src="{{asset('dist/js/dropdown-bootstrap-extended.js')}}"></script>

    <!-- ChartJS JavaScript -->
    <script src="{{asset('vendors/chart.js/Chart.min.js')}}"></script>

    <script src="{{asset('vendors/bower_components/jquery-toast-plugin/dist/jquery.toast.min.js')}}"></script>

    <!-- Sweet-Alert  -->
    <script src="{{asset('vendors/bower_components/sweetalert/dist/sweetalert.min.js')}}"></script>

    <!-- Init JavaScript -->
    <script src="{{asset('dist/js/init.js')}}"></script>


    <script src="https://www.gstatic.com/firebasejs/4.9.1/firebase.js"></script>
    <script>
        // Initialize Firebase
        var config = {
            apiKey: "AIzaSyAo6xNZ6cxf1UhK7hd6pis-bpx5yR_gKg0",
            authDomain: "delivery-51579.firebaseapp.com",
            databaseURL: "https://delivery-51579.firebaseio.com",
            projectId: "delivery-51579",
            storageBucket: "",
            messagingSenderId: "471408711217"
        };
        firebase.initializeApp(config);


        const messaging = firebase.messaging();
        navigator.serviceWorker.register('{{url("/")}}/firebase-messaging-sw.js')
            .then((registration) => {


                messaging.useServiceWorker(registration);
                // Request permission and get token.....
                messaging.requestPermission()
                    .then(function () {
                        console.log('Notification permission granted.');
                        return messaging.getToken();
                    })
                    .then(function (token) {
                        console.log(token); // Display user token
                        var postData = {_token: "{{ csrf_token() }}", firebase_token: token, login_type:{{WEB}}}
                        $.ajax({
                            url: '{{url("user/token")}}',
                            type: 'POST',
                            data: postData,
                            dataType: 'JSON',
                            success: function (data) {
                                console.log(data);


                            }
                        });
                    })
                    .catch(function (err) { // Happen if user deney permission
                        console.log('Unable to get permission to notify.', err);
                    });


            });

        messaging.onMessage(function (payload) {
            //window.webkitNotifications.createNotification('icon.png', 'Notification Title', 'Notification content...');
            console.log('onMessage', payload);
            console.log(payload.notification.body);
            var e = new Notification(payload.notification.title, {
                body: payload.notification.body,
                icon: "{{asset('dist/img/logo.png')}}",
                data: payload.notification.click_action
            })

            e.onclick = function (n) {
                window.location.href = n.target.data;
            }
        })

    </script>

    <script>
        $(document).ready(function () {
            moment.locale('{{app()->getLocale()}}');

            $('#setUserLanguage').change(function () {
                window.location.href = "{{url('/language')}}/" + $(this).val();
            });
            $.extend($.fn.dataTable.defaults, {
                "language": {
                    @if(app()->getLocale() == 'ar')
                    "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Arabic.json",
                    @else
                    "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/English.json",
                    @endif

                    "processing": "<img style='max-height: 5px;max-width: 5px' src='{{asset('/dist/img/waiting1.gif')}}' />" //add a loading image,simply putting <img src="loader.gif" /> tag.
                },
                "bFilter": false,
                "bLengthChange": false,
            });

            $(".allownumericwithdecimal").on("keypress keyup blur", function (event) {
                //this.value = this.value.replace(/[^0-9\.]/g,'');
                $(this).val($(this).val().replace(/[^0-9\.]/g, ''));
                if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
                    event.preventDefault();
                }
            });

            $(".allownumericwithoutdecimal").on("keypress keyup blur", function (event) {
                $(this).val($(this).val().replace(/[^\d].+/, ""));
                if ((event.which < 48 || event.which > 57)) {
                    event.preventDefault();
                }
            });
        });
    </script>
@show

</body>

</html>
