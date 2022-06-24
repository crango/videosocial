@extends('auth.app')
@section('content')
    <form id="frmRecovery">
        <div class="form-group">
            <label>{{ __('Enter Email') }}</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="{{ __('Enter Email') }}"
                autofocus required>
        </div>
        <div class="mt-4">
            <button type="submit" class="btn btn-outline-primary btn-block btn-lg">{{ __('Reset Password') }}</button>
        </div>
    </form>
    <div class="text-center mt-5">
        <p class="light-gray">{{ __('Don’t have an account?') }}
            <a href="{{ route('register') }}">{{ __('Sign Up') }}</a>
        </p>
    </div>
@endsection
