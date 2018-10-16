<form method="POST">
    {{ csrf_field() }}
    <div class="row">
        <div class="row__column">
            <label>{{ __('fields.date') }}</label>
            <select name="column_happened_on">
                @foreach ($headers as $index => $header)
                    <option value="{{ $index }}">{{ $header }}</option>
                @endforeach
            </select>
        </div>
        <div class="row__column">
            <label>{{ __('fields.description') }}</label>
            <select name="column_description">
                @foreach ($headers as $index => $header)
                    <option value="{{ $index }}">{{ $header }}</option>
                @endforeach
            </select>
        </div>
        <div class="row__column">
            <label>{{ __('fields.amount') }}</label>
            <select name="column_amount">
                @foreach ($headers as $index => $header)
                    <option value="{{ $index }}">{{ $header }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <button>Submit</button>
</form>