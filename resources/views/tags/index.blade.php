@extends('layout')

@section('title', __('general.tags'))

@section('body')
    <div class="wrapper my-4">
        <div class="color-dark mb-2">{{ __('general.tags') }}</div>
        <div class="box">
            <div class="box__section box__section--header">
                <div class="row__column">Name</div>
            </div>
            @foreach ($tags as $tag)
                <div class="box__section row">
                    <div class="row__column">{{ $tag->name }}</div>
                    <div class="row__column row__column--compact row__column--middle row">
                        <div class="row__column row__column--compact">
                            <a href="/tags/{{ $tag->id }}/edit">
                                <i class="far fa-pencil"></i>
                            </a>
                        </div>
                        <div class="row__column row__column--compact ml-2">
                            <form method="POST" action="/tags/{{ $tag->id }}">
                                {{ method_field('DELETE') }}
                                {{ csrf_field() }}
                                <button class="button link">
                                    <i class="far fa-trash-alt"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
