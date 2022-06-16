@extends('auth.app')
@section('content')
<!-- Login v1 -->
<div class="card mb-0">
    <div class="card-body">
        <img style="width: 50%; margin-left: 25%;" src="{{ $configuracion->logo??asset('dashboard/images/universidad.jpg') }}">
        <h4 class="card-title mb-1 text-center">Actualizar Contraseña</h4>
        <p class="card-text mb-2 text-center">Por favor ingrese sus nuevos dato de acceso.</p>
        <form class="auth-login-form mt-2" id="frmResetPassword">
            @csrf
            <input type="hidden" name="token" value="{{ request()->get('token') }}">
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="login-email" class="form-label">Nueva contraseña</label>
                        <input type="password" class="form-control" id="password" name="password" minlength="8" aria-describedby="login-email" tabindex="1" autofocus  required/>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="login-email" class="form-label">Confirmar contraseña</label>
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" minlength="8" aria-describedby="login-email" tabindex="1" autofocus  required/>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <a href="{{ route('login') }}" type="submit" class="btn btn-secondary btn-block" tabindex="4"><i class="fa fa-chevron-back"></i>Regrezar</a>
                </div>
                <div class="col-sm-6">
                    <button type="submit" class="btn btn-primary btn-block" tabindex="4">Enviar</button>
                </div>
            </div>

        </form>
    </div>
</div>
<!-- /Login v1 -->
@endsection
