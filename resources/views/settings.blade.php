@extends('layout')

@section('title', 'Settings')

@section('body')
    <div class="wrapper spacing-top-large spacing-bottom-large">
        <div class="row row--gutter">
            <div class="row__column">
                <div class="spacing-bottom-large color-dark">Account</div>
                <div class="box">
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
            <div class="row__column">
                <div class="spacing-bottom-large color-dark">Tags</div>
                <div class="box">
                    <ul class="box__section">
                        @foreach ($tags as $tag)
                            <li class="row">
                                <div class="row__column">{{ $tag->name }}</div>
                                <div class="row__column row__column--compact">
                                    <a href="/tags/{{ $tag->id }}/edit">
                                        <i class="fa fa-pencil"></i>
                                    </a>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
