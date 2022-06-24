@extends('layouts.app')
@section('content')
    <div class="container-fluid upload-details">
        <div class="row">
            <div class="col-lg-12">
                <div class="main-title">
                    <h6>{{ __('Profile') }}</h6>
                </div>
            </div>
        </div>
        <form id="frmUpdate">
            <div class="row">
                <div class="col-sm-6">
                    <!-- Choose image ro profile -->
                    <img class="img-rounded profile"
                        src="{{ $user->avatar != "https://ui-avatars.com/api/?name={$user->name}" ? asset('storage' . '/' . $user->avatar) : $user->avatar }}"
                        id="imgProfile">
                    <div class="form-group">
                        <label for="avatar">{{ __('Choose avatar') }}</label>
                        <input type="file" name="avatar" id="avatar" class="form-control"
                            onchange="imagePreview(this)">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="name" class="control-label">
                                    {{ __('Name') }} <span class="required">*</span>
                                </label>
                                <input type="text" class="form-control border-form-control" id="name" name="name"
                                    value="{{ $user->name ?? '' }}" required>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="lastname" class="control-label">
                                    {{ __('Last Name') }} <span class="required">*</span>
                                </label>
                                <input type="text" class="form-control border-form-control" id="lastname"
                                    name="lastname" value="{{ $user->lastname ?? '' }}">
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="email" class="control-label">
                                    {{ __('Email') }} <span class="required">*</span>
                                </label>
                                <input type="email" class="form-control border-form-control" id="email" name="email"
                                    value="{{ $user->email ?? '' }}" placeholder="" required>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group">
                        <label for="address" class="control-label">{{ __('Address') }}</label>
                        <textarea class="form-control border-form-control" id="address" name="address" maxlength="255">{{ $user->address ?? '' }}</textarea>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="country" class="control-label">{{ __('Country') }} <span
                                class="required">*</span></label>
                        <select class="custom-select" id="country" name="country_id">
                            <option>{{ __('Choose Country') }}</option>
                            @foreach ($countries as $country)
                                <option value="{{ $country->id }}"
                                    {{ $user->country_id == $country->id ? 'selected' : '' }}>
                                    {{ $country->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="state" class="control-label">{{ __('State') }} <span
                                class="required">*</span></label>
                        <select class="custom-select" id="state" name="state_id">
                            @foreach ($states as $state)
                                <option value="{{ $state->id }}"
                                    {{ $user->state_id == $state->id ? 'selected' : '' }}>
                                    {{ $state->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="city" class="control-label">{{ __('City') }} <span
                                class="required">*</span></label>
                        <select class="custom-select" id="city" name="city_id">
                            @foreach ($cities as $city)
                                <option value="{{ $city->id }}" {{ $user->city_id == $city->id ? 'selected' : '' }}>
                                    {{ $city->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="cp" class="control-label">{{ __('Zip Code') }}</label>
                        <input type="text" class="form-control border-form-control" id="cp" name="cp"
                            value="{{ $user->cp ?? '' }}" placeholder="123456">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="phone" class="control-label">{{ __('Phone') }}</label>
                        <input class="form-control border-form-control" id="phone" name="phone"
                            value="{{ $user->phone ?? '' }}" placeholder="123 456 7890">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="birthdate" class="control-label">{{ __('Birthdate') }}</label>
                        <input type="date" class="form-control" id="birthdate" name="birthdate"
                            value="{{ $user->birthdate ?? '' }}">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group">
                        <label for="bio" class="control-label">{{ __('Bio') }}</label>
                        <textarea class="form-control border-form-control" id="bio" name="bio" maxlength="255">{{ $user->bio ?? '' }}</textarea>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="password" class="control-label">{{ __('Current Password') }}</label>
                        <input type="password" class="form-control" name="password" id="password">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="newpassword" class="control-label">{{ __('New Password') }}</label>
                        <input type="password" class="form-control" name="newpassword" id="newpassword">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 text-right">
                    <button type="button" class="btn btn-danger border-none">{{ __('Cancel') }}</button>
                    <button type="submit" class="btn btn-success border-none">{{ __('Save Changes') }}</button>
                </div>
            </div>
        </form>
    </div>
    <!-- /.container-fluid -->
@endsection
