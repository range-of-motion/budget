@extends('layout')

@section('tailwind', true)

@section('title', 'Register')

@section('body')
    <div class="max-w-sm mx-auto my-12">
        <img class="h-12 mx-auto mb-8" src="/logo.svg" />
        <div class="p-5 bg-white border rounded-md">
            <form method="POST">
                {{ csrf_field() }}
                <div class="mb-5">
                    <label class="block mb-1 text-sm text-gray-700">Name</label>
                    <input class="w-full px-3 py-2 text-sm border rounded-md" type="text" name="name" value="{{ old('name') }}" />
                    @include('partials.validation_error', ['payload' => 'name'])
                </div>
                <div class="mb-5">
                    <label class="block mb-1 text-sm text-gray-700">E-mail</label>
                    <input class="w-full px-3 py-2 text-sm border rounded-md" type="email" name="email" value="{{ old('email') }}" />
                    @include('partials.validation_error', ['payload' => 'email'])
                </div>
                <div class="mb-5">
                    <label class="block mb-1 text-sm text-gray-700">Password</label>
                    <input class="w-full px-3 py-2 text-sm border rounded-md" type="password" name="password" />
                    @include('partials.validation_error', ['payload' => 'password'])
                </div>
                <div class="mb-5">
                    <label class="block mb-1 text-sm text-gray-700">Verify password</label>
                    <input class="w-full px-3 py-2 text-sm border rounded-md" type="password" name="password_confirmation" />
                    @include('partials.validation_error', ['payload' => 'password_confirmation'])
                </div>
                <div class="mb-5">
                    <label class="block mb-1 text-sm text-gray-700">Currency</label>
                    <select class="w-full px-3 py-2 text-sm border rounded-md appearance-none" name="currency">
                        @foreach ($currencies as $currency)
                            <option value="{{ $currency->id }}">{{ $currency->name }} ({!! $currency->symbol !!})</option>
                        @endforeach
                    </select>
                    @include('partials.validation_error', ['payload' => 'currency'])
                </div>
                <button class="w-full py-2.5 hover:bg-primary-dark transition text-sm bg-primary-regular text-white rounded-md">Register</button>
            </form>
        </div>
        <div class="mt-4 text-center">
            <a class="text-sm transition text-primary-regular hover:text-primary-dark" href="{{ route('login') }}">Already using Budget? Log in.</a>
        </div>
    </div>
@endsection
