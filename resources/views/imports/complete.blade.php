<form method="POST">
    {{ csrf_field() }}
    <div style="display: flex;">
        <div>Import</div>
        <div>{{ __('fields.date') }}</div>
        <div>{{ __('fields.description') }}</div>
        <div>{{ __('fields.amount') }}</div>
    </div>
    @foreach ($rows as $index => $row)
        <div style="display: flex;">
            <div>
                <input type="checkbox" name="rows[{{ $index }}][import]" />
            </div>
            <div>
                <input type="text" name="rows[{{ $index }}][happened_on]" value="{{ $row['happened_on'] }}" />
            </div>
            <div>
                <input type="text" name="rows[{{ $index }}][description]" value="{{ $row['description'] }}" />
            </div>
            <div>
                <input type="text" name="rows[{{ $index }}][amount]" value="{{ $row['amount'] }}" />
            </div>
        </div>
    @endforeach
    <button>Submit</button>
</form>