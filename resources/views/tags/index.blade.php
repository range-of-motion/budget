@extends('layout')

@section('body')
    <div class="wrapper spacing-top-large spacing-bottom-large">
        <div class="box">
            <div class="section">
                <div class="row">
                    <div class="column align-middle">
                        <h3>Tags</h3>
                    </div>
                    <div class="column align-middle text-align-right">
                        <a href="/tags/create">Create</a>
                    </div>
                </div>
            </div>
            <ul class="section">
                @foreach ($tags as $tag)
                    <li>{{ $tag->name }}</li>
                @endforeach
            </ul>
        </div>
    </div>
@endsection
