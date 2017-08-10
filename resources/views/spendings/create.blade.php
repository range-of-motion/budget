@extends('layout')

@section('body')
    <h1>Create spending</h1>
    <div class="box">
        <div class="box__section">
            <form method="POST" action="/spendings">
                {{ csrf_field() }}
                <label>Tag</label>
                <select name="tag_id">
                    <option value="">-</option>
                    @foreach ($tags as $tag)
                        <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                    @endforeach
                </select>
                <label>Date</label>
                <input type="text" name="date" />
                <label>Description</label>
                <input type="text" name="description" />
                <label>Amount</label>
                <input type="text" name="amount" />
                <input type="submit" value="Create spending" />
            </form>
        </div>
    </div>
@endsection
