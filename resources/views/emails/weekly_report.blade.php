Here's your weekly report for {{ $space->name }}.

This week (#{{ $week }}) you've
<ul>
    <li>Spent CURRENCY SPENT_TOTAL_AMOUNT</li>
    <li>Most of which you've spent on SPENT_MOST_TAG_NAME (CURRENCY SPENT_MOST_TAG_AMOUNT)</li>
</ul>

If you don't want to receive a weekly report, head over to <a href="{{ config('app.url') . '/settings' }}">settings</a> and let us know.
