@extends('layout')

@section('title', 'Reports')

@section('body')
    <div class="wrapper my-3">
        <h2>Reports</h2>
        <div class="row row--gutter row--responsive mt-3">
            <div class="row__column">
                <div class="card">
                    <a href="/reports/weekly-report">Weekly Balance</a>
                    <p class="mt-1">Your balance over the course of 52 weeks&mdash;displayed in a graph.</p>
                </div>
            </div>
            <div class="row__column">
                <div class="card">
                    <a href="/reports/most-expensive-tags">Most Expensive Tags</a>
                    <p class="mt-1">Your all-time most expensive tags&mdash;find out what costs you the most.</p>
                </div>
            </div>
            <div class="row__column">
                <!-- EMPTY -->
            </div>
        </div>
    </div>
@endsection
