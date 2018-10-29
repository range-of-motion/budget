@extends('layout')

@section('title', 'Prepare ' . __('models.import'))

@section('body')
    <div class="wrapper my-3">
        <h2 class="mb-3">Prepare {{ __('models.import') }}</h2>
        <div class="box">
            <form method="POST">
                {{ csrf_field() }}
                <div class="box__section">
                    <div class="row row--gutter">
                        <div class="row__column">
                            <div class="input mb-0">
                                <label>{{ __('fields.date') }}</label>
                                <select name="column_happened_on">
                                    @foreach ($headers as $index => $header)
                                        <option value="{{ $index }}">{{ $header }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row__column">
                            <div class="input mb-0">
                                <label>{{ __('fields.description') }}</label>
                                <select name="column_description">
                                    @foreach ($headers as $index => $header)
                                        <option value="{{ $index }}">{{ $header }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row__column">
                            <div class="input mb-0">
                                <label>{{ __('fields.amount') }}</label>
                                <select name="column_amount">
                                    @foreach ($headers as $index => $header)
                                        <option value="{{ $index }}">{{ $header }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box__section box__section--highlight text-right">
                    <button class="button">Submit</button>
                </div>
            </form>
        </div>
    </div>
@endsection
