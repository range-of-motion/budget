@extends('layout')

@section('body')
    <div class="wrapper spacing-top-large spacing-bottom-large">
        <div class="box">
            <div class="section">
                <div class="row">
                    <div class="column align-middle">
                        <span class="color-dark">@lang('general.tags')</span>
                    </div>
                    <div class="column align-middle text-align-right">
                        <a href="/tags/create">Create</a>
                    </div>
                </div>
            </div>
            <ul class="section">
                @foreach ($tags as $tag)
                    <li class="row">
                        <div class="column">{{ $tag->name }}</div>
                        <div class="column">
                            <form method="POST" action="/tags/{{ $tag->id }}">
                                {{ method_field('delete') }}
                                {{ csrf_field() }}
                                <button>@lang('actions.delete')</button>
                            </form>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
@endsection
