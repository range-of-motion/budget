@extends('layout')

@section('body')
    <div class="wrapper spacing-top-large spacing-bottom-large">
        <div class="box">
            <div class="section">
                <div class="row">
                    <div class="column align-middle">
                        <h3>Search</h3>
                    </div>
                    <div class="column">
                        <form method="GET">
                            <div class="row gutter">
                                <div class="column">
                                    <input class="tight" type="text" name="query" />
                                </div>
                                <div class="column tight">
                                    <button>Search</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="section">Search is temporarily out of order</div>
        </div>
    </div>
@endsection
