@extends('layout')

@section('title', __('models.tags'))

@section('body')
    <div class="tw-my-8 tw-mx-auto tw-max-w-4xl">
        <div class="tw-mb-4 tw-flex tw-items-end tw-justify-between">
            <h2>{{ __('models.tags') }}</h2>
            <x-button target="/tags/create">{{ __('actions.create') . ' ' . __('models.tag') }}</x-button>
        </div>
        <div class="tw-bg-white tw-rounded tw-shadow">
            @if (count($tags))
                <div class="tw-py-3 tw-px-5 tw-flex tw-bg-gray-50">
                    <div class="tw-w-10"></div>
                    <div class="tw-flex-1">{{ __('fields.name') }}</div>
                    <div class="tw-flex-1">{{ __('models.spendings') }}</div>
                    <div class="tw-w-20"></div>
                </div>
                @foreach ($tags as $tag)
                    <div class="tw-p-5 tw-flex tw-border-t tw-border-gray-200">
                        <div class="tw-w-10 tw-flex tw-items-center">
                            <div class="tw-w-4 tw-h-4 tw-rounded" style="background: #{{ $tag->color }};"></div>
                        </div>
                        <div class="tw-flex-1">{{ $tag->name }}</div>
                        <div class="tw-flex-1">{{ $tag->spendings->count() }}</div>
                        <div class="tw-w-20 tw-flex tw-justify-end tw-items-center">
                            <a href="/tags/{{ $tag->id }}/edit" class="tw-mr-5">
                                <i class="fas fa-pencil"></i>
                            </a>
                            @if ($tag->spendings->count())
                                <i class="fas fa-trash-alt"></i>
                            @else
                                <form method="POST" action="/tags/{{ $tag->id }}">
                                    {{ method_field('DELETE') }}
                                    {{ csrf_field() }}
                                    <button class="button link">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                @endforeach
            @else
                @include('partials.empty_state', ['payload' => 'tags'])
            @endif
        </div>
    </div>
@endsection
