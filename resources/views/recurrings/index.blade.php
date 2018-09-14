@extends('layout')

@section('body')
    <div class="wrapper my-4">
        <div class="color-dark mb-2">{{ __('general.recurrings') }}</div>
        <div class="box">
            @foreach ($recurrings as $recurring)
                <div class="box__section row">
                    <div class="row__column">
                        <div class="color-dark">{{ $recurring->description }}</div>
                        <div class="row mt-1">
                            <div class="row__column row__column--compact" style="font-size: 14px; font-weight: 600;">{!! $currency->symbol !!} {{ number_format($recurring->amount / 100, 2) }}</div>
                            @if ($recurring->due_days)
                                <div class="row__column row__column--compact ml-2" style="font-size: 14px; font-weight: 600;"><i class="far fa-clock"></i> Due in {{ $recurring->due_days }} days</div>
                            @endif
                        </div>
                    </div>
                    <div class="row__column row__column--middle">
                        @if ($recurring->due_days)
                            <span style="border-radius: 5px; background: #D8F9E8; color: #51B07F; padding: 5px 10px; font-size: 14px; font-weight: 600;"><i class="fas fa-check fa-xs"></i> Active</span>
                        @else
                            <span style="border-radius: 5px; background: #FFE7EC; color: #F25C68; padding: 5px 10px; font-size: 14px; font-weight: 600;"><i class="fas fa-times fa-xs"></i> Inactive</span>
                        @endif
                    </div>
                    <div class="row__column row__column--middle">
                        @if ($recurring->tag)
                            <span style="border-radius: 5px; background: #DEEAFE; color: #618DD7; padding: 5px 10px; font-size: 14px; font-weight: 600;"><i class="fas fa-tag fa-xs"></i> {{ $recurring->tag->name }}</span>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
