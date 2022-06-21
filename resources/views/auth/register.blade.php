@extends('auth.app')
@section('content')
    <!-- Register-->
    <form id="frmRegister">
        <div class="form-group">
            <label>{{ __('Name') }}</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="{{ __('Enter your name') }}">
        </div>
        <div class="form-group">
            <label>{{ __('Lastname') }}</label>
            <input type="text" class="form-control" id="lastname" name="lastname"
                placeholder="{{ __('Enter your last name') }}">
        </div>
        <div class="form-group">
            <label>{{ __('Email') }}</label>
            <input type="email" class="form-control" id="email" name="email"
                placeholder="{{ __('Enter your email') }}">
        </div>
        <div class="form-group">
            <label>{{ __('Password') }}</label>
            <input type="password" class="form-control" id="password" name="password" placeholder=".........">
        </div>
        <div class="form-group">
            <label>{{ __('Country') }}</label>
            <select id="country" name="country_id" class="form-control">
                <option>{{ __('Select Country') }}</option>
                @foreach ($countries as $data)
                    <option value="{{ $data->id }}">{{ $data->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label>{{ __('State') }}</label>
            <select id="state" name="state_id" class="form-control"></select>
        </div>
        <div class="form-group">
            <label>{{ __('City') }}</label>
            <select id="city" name="city_id" class="form-control"></select>
        </div>
        {{-- <div class="form-group">
            <label>{{ __('Promocode') }}</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="{{ __('Promocode') }}">
        </div> --}}
        <div class="mt-4">
            <button type="submit" class="btn btn-outline-primary btn-block btn-lg">{{ __('Sign Up') }}</button>
        </div>
    </form>
    <div class="text-center mt-5">
        <p class="light-gray">{{ __('Already have an Account?') }}<a
                href="{{ route('login') }}">{{ __('Sign In') }}</a></p>
    </div>
    <!-- /Register-->
@endsection
