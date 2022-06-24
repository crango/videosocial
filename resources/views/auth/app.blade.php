<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="">

    <title>{{ config('app.name') }}</title>

    <link rel="apple-touch-icon" href="{{ asset('dashboard/img/apple.png') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('dashboard/img/favicon.png') }}">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard/vendor/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard/vendor/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard/vendor/owl-carousel/owl.carousel.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard/vendor/owl-carousel/owl.theme.css') }}">
    <!-- END: Vendor CSS-->
    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard/css/osahan.css') }}">
    <link rel="stylesheet" type="text/css"href="{{ asset('css/toastr.min.css') }}">
    <!-- END: Custom CSS-->
</head>
<!-- END: Head-->
<!-- BEGIN: Body-->

<body class="login-main-body">
    <input type="hidden" id="domainHost" value="{{ config('app.url') }}">
    <input type="hidden" id="route_web" value="{{ route('web') }}">
    <section class="login-main-wrapper">
        <div class="container-fluid pl-0 pr-0">
            <div class="row no-gutters">
                <div class="col-md-5 p-5 bg-white full-height">
                    <div class="login-main-left">
                        <div class="text-center mb-5 login-main-left-header pt-4">
                            <img src="{{ asset('dashboard/img/favicon.png') }}" class="img-fluid" alt="LOGO">
                            <h5 class="mt-3 mb-3">{{ $title }}</h5>
                            <p>{{ $description }}</p>
                        </div>
                        <!-- Login-->
                        @yield('content')
                        <!-- /Login-->
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="login-main-right bg-white p-5 mt-5 mb-5">
                        {{-- @yield('carousel') --}}
                        <div class="owl-carousel owl-carousel-login">
                            <div class="item">
                                <div class="carousel-login-card text-center">
                                    <img src="{{ asset('dashboard/img/login.png') }}" class="img-fluid"
                                        alt="LOGO">
                                    <h5 class="mt-5 mb-3">​Watch videos offline</h5>
                                    <p class="mb-4">when an unknown printer took a galley of type and
                                        scrambled<br> it to make a type specimen book. It has survived not <br>only five
                                        centuries</p>
                                </div>
                            </div>
                            <div class="item">
                                <div class="carousel-login-card text-center">
                                    <img src="{{ asset('dashboard/img/login.png') }}" class="img-fluid"
                                        alt="LOGO">
                                    <h5 class="mt-5 mb-3">Download videos effortlessly</h5>
                                    <p class="mb-4">when an unknown printer took a galley of type and
                                        scrambled<br> it to make a type specimen book. It has survived not <br>only five
                                        centuries</p>
                                </div>
                            </div>
                            <div class="item">
                                <div class="carousel-login-card text-center">
                                    <img src="{{ asset('dashboard/img/login.png') }}" class="img-fluid"
                                        alt="LOGO">
                                    <h5 class="mt-5 mb-3">Create GIFs</h5>
                                    <p class="mb-4">when an unknown printer took a galley of type and
                                        scrambled<br> it to make a type specimen book. It has survived not <br>only five
                                        centuries</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="{{ url('') . mix('js/app.js') }}"></script>
    @if (isset($jsControllers))
        @foreach ($jsControllers as $jsController)
            <script src='{!! asset($jsController) . '?v=' . mt_rand(100000, 999999) !!}'></script>
        @endforeach
    @endif
</body>

</html>
