@extends('layout')

@section('body')
    <div class="wrapper my-3">
        <h2>{{ $recurring->description }}</h2>
        <div class="row my-3">
            <div class="row__column row__column--compact">
                @if ($recurring->status)
                    <span style="border-radius: 5px; background: #D8F9E8; color: #51B07F; padding: 5px 10px; font-size: 14px; font-weight: 600;"><i class="fas fa-check fa-xs"></i> Active</span>
                @else
                    <span style="border-radius: 5px; background: #FFE7EC; color: #F25C68; padding: 5px 10px; font-size: 14px; font-weight: 600;"><i class="fas fa-times fa-xs"></i> Inactive</span>
                @endif
            </div>
            @if ($recurring->tag)
                <div class="row__column row__column--compact ml-1">
                    @include('partials.tag', ['payload' => $recurring->tag])
                </div>
            @endif
        </div>
        @if(count($recurring->earnings))
            <div class="color-dark mb-2">{{ __('models.earnings') }}</div>
            <div class="box">
                @foreach ($recurring->earnings as $earning)
                    <div class="box__section">
                        <div>
                            <div class="color-dark">{{ $earning->happened_on }}</div>
                            <div class="mt-1" style="font-size: 14px; font-weight: 600;">{{ $earning->formatted_happened_on }}</div>
                        </div>
                        <div></div>
                    </div>
                @endforeach
        @elseif(count($recurring->spendings))
            <div class="color-dark mb-2">{{ __('models.spendings') }}</div>
                <div class="box">
                    @foreach ($recurring->spendings as $spending)
                        <div class="box__section">
                            <div>
                                <div class="color-dark">{{ $spending->happened_on }}</div>
                                <div class="mt-1" style="font-size: 14px; font-weight: 600;">{{ $spending->formatted_happened_on }}</div>
                            </div>
                            <div></div>
                        </div>
                    @endforeach
        @else
            @include('partials.empty_state', ['payload' => 'transactions'])
        @endif
        </div>
    </div>
@endsection
