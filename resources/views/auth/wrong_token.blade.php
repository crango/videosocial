@extends('layout.default.main')
@section('content')
{{ config('app.url') }}
<div class="app-content content ">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body">
            <div class="auth-wrapper auth-v1 px-2" style="margin-top: -150px;margin-left: -11%;">
                <div class="auth-inner py-2">
                    <!-- Login v1 -->
                    <div class="card mb-0">
                        <div class="card-body">
                            <img style="width: 50%; margin-left: 25%;" src="{{ $configuracion->logo??asset('dashboard/images/universidad.jpg') }}">
                            <h4 class="card-title mb-1 text-center">Token invalido</h4>
                            <p class="card-text mb-2 text-center">El token es invalido o ha caducado, por favor vuelva a iniciar el proceso de recuperación de acceso.</p>
                            <div class="row">
                                <div class="col-12">
                                    <a href="{{ route('login') }}" type="submit" class="btn btn-secondary btn-block" tabindex="4"><i class="fa fa-chevron-back"></i>Ir a inicio</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /Login v1 -->
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
