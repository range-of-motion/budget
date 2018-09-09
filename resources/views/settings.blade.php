@extends('layout')

@section('title', 'Settings')

@section('body')
    <div class="wrapper my-4">
        <div class="mb-4 color-dark">Account</div>
        <div class="box">
            <div class="box__section">
                <form method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
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
                    <div class="input input--small">
                        <label>{{ __('general.language') }}</label>
                        <select name="language">
                            @foreach ($languages as $key => $value)
                                <option value="{{ $key }}" @if (Auth::user()->language === $key) selected @endif>{{ $value }}</option>
                            @endforeach
                        </select>
                        @include('partials.validation_error', ['payload' => 'language'])
                    </div>
                    <button class="button">Update</button>
                </form>
            </div>
        </div>
        <div class="my-4 color-dark">Tags</div>
        <div class="box">
            @if (count($tags))
                <ul class="box__section">
                    @foreach ($tags as $tag)
                        <li class="row">
                            <div class="row__column">
                                <div>{{ $tag->name }}</div>
                                <div class="mt-1"><i class="fal fa-piggy-bank"></i> {{ $tag->spendings->count() }} {{ __('general.spendings') }}</div>
                            </div>
                            <div class="row__column row__column--compact">
                                <a href="/tags/{{ $tag->id }}/edit">
                                    <i class="fas fa-pencil"></i>
                                </a>
                            </div>
                            <div class="row__column row__column--compact ml-2">
                                <form method="POST" action="/tags/{{ $tag->id }}">
                                    {{ method_field('DELETE') }}
                                    {{ csrf_field() }}
                                    <button class="link">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </li>
                    @endforeach
                </ul>
            @else
                <div class="box__section text-center">You don't have any tags</div>
            @endif
            <div class="box__section">
                <form method="POST" action="/tags">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="row__column" style="max-width: 400px;">
                            <input type="text" name="name" />
                            @include('partials.validation_error', ['payload' => 'name'])
                        </div>
                        <div class="row__column row__column--compact row__column--middle ml-2">
                            <button>Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
