@extends('layout')

@section('body')
    <div class="row">
        <div class="column align-middle">
            <h1>Tags</h1>
        </div>
        <div class="column align-right">
            <a href="#" class="button">Create</a>
        </div>
    </div>
    <div class="box spacing-top-large">
        <table>
            <tbody>
                @foreach ($tags as $tag)
                    <tr>
                        <td>{{ $tag->name }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
