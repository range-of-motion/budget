@extends('layout')

@section('body')
    <h1>Reports</h1>
    <div class="box">
        <table class="box__section">
            <tbody>
                @for ($y = 2017; $y <= date('Y'); $y ++)
                    @for ($m = 1; $m <= 12; $m ++)
                        @if (App\Budget::where('user_id', Auth::user()->id)->whereMonth('date', $m)->whereYear('date', $y)->count())
                            <tr>
                                <td>
                                    <a href="/reports/{{ $y }}/{{ $m }}">@lang('months.' . $m), {{ $y }}</a>
                                </td>
                            </tr>
                        @endif
                    @endfor
                @endfor
            </tbody>
        </table>
    </div>
@endsection
