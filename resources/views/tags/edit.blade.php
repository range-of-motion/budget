@extends('layout')

@section('body')
    <div class="wrapper spacing-top-large spacing-bottom-large">
        <div class="box">
            <div class="section">
                <h3>Tags &middot; Edit</h3>
            </div>
            <div class="section">
                <form method="POST" action="/tags/{{ $tag->id }}">
                    {{ method_field('PATCH') }}
                    {{ csrf_field() }}
                    <label>Name</label>
                    <input type="text" name="name" value="{{ $tag->name }}" />
                    <button>Update</button>
                </form>
            </div>
        </div>
    </div>
@endsection
