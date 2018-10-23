@extends('layout')

@section('title', 'Complete ' . __('models.import'))

@section('body')
    <div class="wrapper my-3">
        <h2 class="mb-3">Complete {{ __('models.import') }}</h2>
        <div class="box">
            <form method="POST">
                {{ csrf_field() }}
                <div class="box__section">
                    <div class="input input--small mb-0">
                        <label>Date Format</label>
                        <select name="date_format">
                            <option value="Y-m-d">YYYY-MM-DD</option>
                            <option value="Y/m/d">YYYY/MM/DD</option>
                            <option value="Ymd">YYYYMMDD</option>
                        </select>
                    </div>
                </div>
                <div class="box__section box__section--header">
                    <div class="row row--gutter">
                        <div class="row__column row__column--compact" style="width: 100px;">Import</div>
                        <div class="row__column">{{ __('fields.date') }}</div>
                        <div class="row__column">{{ __('fields.description') }}</div>
                        <div class="row__column">{{ __('fields.amount') }}</div>
                    </div>
                </div>
                @foreach ($rows as $index => $row)
                    <div class="box__section">
                        <div class="row row--gutter">
                            <div class="row__column row__column--compact" style="width: 100px;">
                                <input type="checkbox" name="rows[{{ $index }}][import]" />
                            </div>
                            <div class="row__column">
                                <input type="text" name="rows[{{ $index }}][happened_on]" value="{{ $row['happened_on'] }}" />
                                {{ $errors->first('rows.' . $index . '.happened_on') }}
                            </div>
                            <div class="row__column">
                                <input type="text" name="rows[{{ $index }}][description]" value="{{ $row['description'] }}" />
                                {{ $errors->first('rows.' . $index . '.description') }}
                            </div>
                            <div class="row__column">
                                <input type="text" name="rows[{{ $index }}][amount]" value="{{ $row['amount'] }}" />
                                {{ $errors->first('rows.' . $index . '.amount') }}
                            </div>
                        </div>
                    </div>
                @endforeach
                <div class="box__section box__section--highlight text-right">
                    <button class="button">Submit</button>
                </div>
            </form>
        </div>
    </div>
@endsection
