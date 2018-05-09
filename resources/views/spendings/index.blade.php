@extends('layout')

@section('body')
    <div class="banner">
        <h1>Spendings</h1>
    </div>
    <div class="wrapper spacing-top-large spacing-bottom-large">
        <div class="spacing-bottom-large text-align-center">
            {!! ($sort == 'date-asc') ? '<span>' : '<a href="/spendings?sort=date-asc">' !!}Sort by Date <i class="fa fa-arrow-up"></i>{!! ($sort == 'date-asc') ? '</span>' : '</a>' !!} &middot;
            {!! ($sort == 'date-desc' || !$sort) ? '<span>' : '<a href="/spendings?sort=date-desc">' !!}Sort by Date <i class="fa fa-arrow-down"></i>{!! ($sort == 'date-desc' || !$sort) ? '</span>' : '</a>' !!} &middot;
            {!! ($sort == 'price-asc') ? '<span>' : '<a href="/spendings?sort=price-asc">' !!}Sort by Price <i class="fa fa-arrow-up"></i>{!! ($sort == 'price-asc') ? '</span>' : '</a>' !!} &middot;
            {!! ($sort == 'price-desc') ? '<span>' : '<a href="/spendings?sort=price-desc">' !!}Sort by Price <i class="fa fa-arrow-down"></i>{!! ($sort == 'price-desc') ? '</span>' : '</a>' !!}
        </div>
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
            {!! ($currentPage > 1) ? '<a href="/spendings?page=' . ($currentPage - 1) . ($sort ? '&sort=' . $sort : '') . '">Previous</a> &middot;' : '' !!} Page {{ $currentPage }} of {{ $totalPages }} {!! ($currentPage < $totalPages) ? '&middot; <a href="/spendings?page=' . ($currentPage + 1) . ($sort ? '&sort=' . $sort : '') . '">Next</a>' : '' !!}
        </div>
    </div>
@endsection
