@if ($settings->facebook_status == 1 || $settings->google_status ==1)
    <div class="divider my-2">
        <div class="divider-text">{{ __('or') }}</div>
    </div>
    <div class="auth-footer-btn d-flex justify-content-center">
        @if (request()->get('code') && request()->get('id') && request()->get('type'))
            <a class="btn btn-facebook"
                href="{{ url('auth/facebook/redirect') .'?code=' .request()->get('code') .'&id=' .request()->get('id') .'&type=' .request()->get('type') }}">
                <i data-feather="facebook"></i>
            </a>
            <a class="btn btn-google"
                href="{{ url('auth/google/redirect') .'?code=' .request()->get('code') .'&id=' .request()->get('id') .'&type=' .request()->get('type') }}">
                <i data-feather="mail"></i>
            </a>
        @else
            @if ($settings->facebook_status == 1)
                @if (request()->get('code') && request()->get('id') && request()->get('type'))
                    <a class="btn btn-facebook"
                        href="{{ url('auth/facebook/redirect') .'?code=' .request()->get('code') .'&id=' .request()->get('id') .'&type=' .request()->get('type') }}">
                        <i data-feather="facebook"></i>
                    </a>
                @else
                    <a class="btn btn-facebook" href="{{ url('auth/facebook/redirect') }}">
                        <i data-feather="facebook"></i>
                    </a>
                @endif
            @endif
            @if ($settings->google_status == 1)
                @if (request()->get('code') && request()->get('id') && request()->get('type'))
                    <a class="btn btn-google"
                        href="{{ url('auth/google/redirect') .'?code=' .request()->get('code') .'&id=' .request()->get('id') .'&type=' .request()->get('type') }}">
                        <i data-feather="mail"></i>
                    </a>
                @else
                    <a class="btn btn-google" href="{{ url('auth/google/redirect') }}">
                        <i data-feather="mail"></i>
                    </a>
                @endif
            @endif
        @endif
    </div>
@endif