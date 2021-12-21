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
                            <option value="Y-m-d" {{ old('date_format') == 'Y-m-d' ? 'selected' : '' }}>YYYY-MM-DD</option>
                            <option value="Y/m/d" {{ old('date_format') == 'Y/m/d' ? 'selected' : '' }}>YYYY/MM/DD</option>
                            <option value="Ymd" {{ old('date_format') == 'Ymd' ? 'selected' : '' }}>YYYYMMDD</option>
                        </select>
                    </div>
                    <div class="row mt-2">
                        <button id="selectAll" style="padding: 5px 10px;" class="button">Select all</button>
                        <button id="deselectAll" style="padding: 5px 10px;" class="button ml-1">Deselect all</button>
                    </div>
                </div>
                <div class="box__section box__section--header">
                    <div class="row row--gutter">
                        <div class="row__column row__column--compact" style="width: 100px;">Import</div>
                        <div class="row__column">{{ __('models.tag') }}</div>
                        <div class="row__column">{{ __('fields.date') }}</div>
                        <div class="row__column row__column--triple">{{ __('fields.description') }}</div>
                        <div class="row__column">{{ __('fields.amount') }}</div>
                    </div>
                </div>
                @foreach ($rows as $index => $row)
                    <div class="box__section">
                        <div class="row row--gutter">
                            <div class="row__column row__column--compact row__column--middle" style="width: 100px;">
                                <input type="checkbox" name="rows[{{ $index }}][import]" {{ old('rows.' . $index . '.import') == 'on' ? 'checked' : '' }} /></div>
                            <div class="row__column">
                                <select name="rows[{{ $index }}][tag_id]">
                                    <option value="">-</option>
                                    @foreach ($tags as $tag)
                                        <option value="{{ $tag->id }}" v-pre>{{ $tag->name }}</option>
                                    @endforeach
                                </select>
                                @include('partials.validation_error', ['payload' => 'rows.' . $index . '.tag_id'])
                            </div>
                            <div class="row__column">
                                <input type="text" name="rows[{{ $index }}][happened_on]" value="{{ old('rows.' . $index . '.happened_on') ? old('rows.' . $index . '.happened_on') : $row['happened_on'] }}" />
                                @include('partials.validation_error', ['payload' => 'rows.' . $index . '.happened_on'])
                            </div>
                            <div class="row__column row__column--triple">
                                <input type="text" name="rows[{{ $index }}][description]" value="{{ old('rows.' . $index . '.description') ? old('rows.' . $index . '.description') : $row['description'] }}" />
                                @include('partials.validation_error', ['payload' => 'rows.' . $index . '.description'])
                            </div>
                            <div class="row__column">
                                <input type="text" name="rows[{{ $index }}][amount]" value="{{ old('rows.' . $index . '.amount') ? old('rows.' . $index . '.amount') : $row['amount'] }}" />
                                @include('partials.validation_error', ['payload' => 'rows.' . $index . '.amount'])
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

@section('scripts')
    <script>
        function selectAll() {
            var checkboxes = document.querySelectorAll('input[type="checkbox"][name^="rows"]');

            checkboxes.forEach(checkbox => {
                checkbox.checked = true;
            });
        }

        function deselectAll() {
            var checkboxes = document.querySelectorAll('input[type="checkbox"][name^="rows"]');

            checkboxes.forEach(checkbox => {
                checkbox.checked = false;
            });
        }

        document.querySelector('#selectAll').addEventListener('click', function (e) {
            e.preventDefault();

            selectAll();
        });

        document.querySelector('#deselectAll').addEventListener('click', function (e) {
            e.preventDefault();

            deselectAll();
        });
    </script>
@endsection
