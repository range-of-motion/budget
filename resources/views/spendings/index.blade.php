@extends('layout')

@section('body')
    <div class="banner">
        <h1>Spendings</h1>
    </div>
    <div class="wrapper spacing-top-large spacing-bottom-large">
        <div class="box">
            @if (count($spendings))
                @foreach ($spendings as $spending)
                    <div class="section row">
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
                <div class="section text-center">You don't have any spendings</div>
            @endif
        </div>
    </div>
@endsection
