@extends('auth.app')
@section('content')
<!-- Login v1 -->
<div class="card mb-0">
    <div class="card-body">
        <h4 class="card-title mb-1 text-center">Recuperación de acceso</h4>
        <p class="card-text mb-2 text-center">Por favor ingrese sus correo de acceso.</p>
        <form class="auth-login-form mt-2" id="frmRecovery">
            @csrf
            <div class="form-group">
                <label for="login-email" class="form-label">Email</label>
                <input type="text" class="form-control" id="email" name="email" placeholder="john@example.com" aria-describedby="login-email" tabindex="1" autofocus  required/>
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
