@extends('layout')

@section('title', 'Settings')

@section('body')
    <div class="wrapper my-3">
        <h2>Settings</h2>
        <div class="box mt-3">
            <form method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="box__section">
                    <div class="input input--small">
                        <label>{{ __('general.avatar') }}</label>
                        @if (Auth::user()->avatar)
                            <img src="/storage/avatars/{{ Auth::user()->avatar }}" style="width: 200px; height: 200px; border-radius: 5px; object-fit: cover;" />
                        @else
                            <div>You don't have an avatar</div>
                        @endif
                        <input type="file" name="avatar" />
                        @include('partials.validation_error', ['payload' => 'avatar'])
                    </div>
                    <div class="input input--small">
                        <label>{{ __('general.name') }}</label>
                        <input type="text" name="name" value="{{ Auth::user()->name }}" />
                    </div>
                    <div class="input input--small">
                        <label>{{ __('general.email') }}</label>
                        <input type="text" name="email" value="{{ Auth::user()->email }}" />
                    </div>
                    <div class="input input--small">
                        <label>{{ __('general.password') }}</label>
                        <input type="password" name="password" />
                        @include('partials.validation_error', ['payload' => 'password'])
                    </div>
                    <div class="input input--small">
                        <label>{{ __('general.verify') }} {{ __('general.password') }}</label>
                        <input type="password" name="password_confirmation" />
                        @include('partials.validation_error', ['payload' => 'password_confirmation'])
                    </div>
                    <div class="input input--small mb-0">
                        <label>{{ __('general.language') }}</label>
                        <select name="language">
                            @foreach ($languages as $key => $value)
                                <option value="{{ $key }}" @if (Auth::user()->language === $key) selected @endif>{{ $value }}</option>
                            @endforeach
                        </select>
                        @include('partials.validation_error', ['payload' => 'language'])
                    </div>
                </div>
                <div class="box__section box__section--highlight text-right">
                    <button class="button">Update</button>
                </div>
            </form>
        </div>
    </div>
@endsection
