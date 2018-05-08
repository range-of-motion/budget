@extends('layout')

@section('body')
    <div class="banner">
        <h1>Spendings</h1>
    </div>
    <div class="wrapper spacing-top-large spacing-bottom-large">
        <div class="box">
            @foreach ($spendings as $spending)
                <div class="section row">
                    <div class="column">{{ $spending->description }}</div>
                    <div class="column">{{ ($spending->tag) ? $spending->tag->name : 'N/A' }}</div>
                    <div class="column">&euro; {{ $spending->amount }}</div>
                </div>
            @endforeach
        </div>
        <div class="spacing-top-large text-align-center">
            {!! ($currentPage > 1) ? '<a href="/spendings?page=' . ($currentPage - 1) . '">Previous</a> &middot;' : '' !!} Page {{ $currentPage }} of {{ $totalPages }} {!! ($currentPage < $totalPages) ? '&middot; <a href="/spendings?page=' . ($currentPage + 1) . '">Next</a>' : '' !!}
        </div>
    </div>
@endsection
