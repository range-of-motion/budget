@extends('layout')

@section('body')
    <div class="wrapper spacing-top-large spacing-bottom-large">
        <div class="box">
            <div class="section">
                <span class="color-dark">Settings</span>
            </div>
            <div class="section">
                <form method="POST">
                    {{ csrf_field() }}
                    <label>Name</label>
                    <input type="text" name="name" value="{{ Auth::user()->name }}" />
                    <label>E-mail</label>
                    <input type="text" name="email" value="{{ Auth::user()->email }}" />
                    <label>Language</label>
                    <select name="language">
                        @foreach ($languages as $language)
                            <option value="{{ $language }}" @if (Auth::user()->language === $language) selected @endif>{{ $language }}</option>
                        @endforeach
                    </select>
                    <button>Update</button>
                </form>
            </div>
        </div>
    </div>
@endsection
