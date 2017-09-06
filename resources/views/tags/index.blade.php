@extends('layout')

@section('body')
    <h1>Tags</h1>
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
