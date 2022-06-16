@extends('auth.app')
@section('content')
    <form id="frmLogin">
        @csrf
        <div class="form-group">
            <label>{{ __('Email') }}</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="john@example.com"
                aria-describedby="email" autofocus="" tabindex="1" />
        </div>
        <div class="form-group">
            <div class="d-flex justify-content-between">
                <label>{{ __('Password') }}</label>
                <a href="{{ route('forgot-password') }}">
                    <small>{{ __('Forgot Password?') }}</small>
                </a>
            </div>
            <input type="password" class="form-control" placeholder=".........">
        </div>
        <div class="mt-4">
            <div class="row">
                <div class="col-12">
                    <button type="submit" class="btn btn-outline-primary btn-block btn-lg">{{ __('Sign In') }}</button>
                </div>
            </div>
        </div>
    </form>
    <div class="text-center mt-5">
        <p class="light-gray">{{ __('Don’t have an account?') }}
            <a href="{{ route('register') }}">{{ __('Sign Up') }}</a>
        </p>
    </div>
@endsection
