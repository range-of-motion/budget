@extends('layout')

@section('title', __('general.tags'))

@section('body')
    <div class="wrapper my-4">
        <div class="color-dark mb-2">{{ __('general.tags') }}</div>
        <div class="box">
            @foreach ($tags as $tag)
                <div class="box__section row">
                    <div class="row__column">{{ $tag->name }}</div>
                    <div class="row__column row__column--compact row__column--middle">
                        <a href="/tags/{{ $tag->id }}/edit">
                            <i class="far fa-pencil"></i>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
