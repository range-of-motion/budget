@extends('layout')

@section('body')
    <div class="wrapper my-3">
        <h2 class="mb-3">{{ __('pages.settings') }}</h2>
        <div class="row">
            <div class="row__column mr-3" style="max-width: 300px;">
                <div class="box">
                    <ul class="box__section">
                        <li><a href="/settings/profile">{{ __('general.profile') }}</a></li>
                        <li><a href="/settings/account">{{ __('general.account') }}</a></li>
                        <li><a href="/settings/preferences">{{ __('general.preferences') }}</a></li>
                    </ul>
                </div>
            </div>
            <div class="row__column">
                <form method="POST" action="/settings" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    @yield('settings_body')
                </form>
            </div>
        </div>
    </div>
@endsection
