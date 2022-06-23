<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="loaded">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Askbootstrap">
    <meta name="author" content="Askbootstrap">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name') }}</title>
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('dashboard') }}/img/favicon.png">

    <link href="{{ url('') . mix('css/app.css') }}" rel="stylesheet">
    @if (isset($cssStyles))
        @foreach ($cssStyles as $css_style)
            <link href="{{ asset($css_style) }}" rel="stylesheet">
        @endforeach
    @endif
</head>

<body id="page-top">
    @csrf
    <input type="hidden" id="domainHost" value="{{ config('app.url') }}">
    @auth
        @include('layouts.app-header')
    @endauth
    <div id="wrapper">
        @auth
            @include('layouts.app-menu')
        @endauth
        <div id="content-wrapper">
            @yield('content')
            @include('layouts.app-footer')
        </div>
        <!-- /.content-wrapper -->
    </div>
    <!-- /#wrapper -->
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="{{-- route('logout') --}}">Logout</a>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ url('') . mix('js/app.js') }}"></script>
    @if (isset($jsControllers))
        @foreach ($jsControllers as $jsController)
            <script src='{!! asset($jsController) . '?v=' . mt_rand(100000, 999999) !!}'></script>
        @endforeach
    @endif
    <script>
        $(window).on('load', function() {
            /*             if (feather) {
                            feather.replace({
                                width: 14,
                                height: 14
                            });
                        } */
            @if (Session::has('success'))
                $(document).ready(function() {
                    Core.showToast('success', '{{ Session::get('success') }}');
                });
            @endif
        });
    </script>
</body>

</html>
