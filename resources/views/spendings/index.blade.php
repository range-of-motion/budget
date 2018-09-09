@extends('layout')

@section('body')
    <div class="wrapper my-4">
        <div style="color: black; margin-bottom: 20px;">{{ __('general.spendings') }}</div>
        <div class="box">
            @if (count($spendings))
                @foreach ($spendings as $spending)
                    <div class="box__section row">
                        <div class="row__column">
                            @if ($spending->tag)
                                <div style="
                                    margin-bottom: 10px;
                                    display: inline-block;
                                    padding: 5px 10px;
                                    text-transform: uppercase;
                                    font-size: 12px;
                                    font-weight: bolder;
                                    bolder; color: #FFF;
                                    background: #333;
                                    border-radius: 5px;
                                ">{{ $spending->tag->name }}</div>
                            @endif
                            <div>{{ $spending->description }}</div>
                            <div style="margin-top: 10px; font-size: 14px;">{{ $spending->formatted_happened_on }}</div>
                        </div>
                        <div class="row__column text-right" style="color: red;">&euro; {{ $spending->formatted_amount }}</div>
                    </div>
                @endforeach
            @else
                <div class="box__section text-center">You don't have any spendings</div>
            @endif
        </div>
    </div>
@endsection
