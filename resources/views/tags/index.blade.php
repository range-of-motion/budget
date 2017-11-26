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
                        <a href="/tags/create">@lang('actions.create')</a>
                    </div>
                </div>
            </div>
            @if (count($tags) > 0)
                <ul class="section">
                    @foreach ($tags as $tag)
                        <li class="row">
                            <div class="column">{{ $tag->name }}</div>
                            <div class="column">
                                <a href="/tags/{{ $tag->id }}/edit">Edit</a> &middot;
                                <form class="action" method="POST" action="/tags/{{ $tag->id }}">
                                    {{ method_field('delete') }}
                                    {{ csrf_field() }}
                                    <button>@lang('actions.delete')</button>
                                </form>
                            </div>
                        </li>
                    @endforeach
                </ul>
            @else
                <div class="section">You don't have any tags</div>
            @endif
        </div>
    </div>
@endsection
