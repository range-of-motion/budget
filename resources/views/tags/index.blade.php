@extends('layout')

@section('body')
    <div class="row">
        <div class="column align-middle">
            <h1>Tags</h1>
        </div>
        <div class="column align-right">
            <a href="/tags/create" class="button">Create</a>
        </div>
    </div>
    <div class="box spacing-top-large">
        <table>
            <tbody>
                @foreach ($tags as $tag)
                    <tr>
                        <td>{{ $tag->name }}</td>
                        <td>
                            <form class="test" method="POST" action="/tags/{{ $tag->id }}">
                                {{ method_field('DELETE') }}
                                {{ csrf_field() }}
                                <input type="submit" value="Delete" />
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
