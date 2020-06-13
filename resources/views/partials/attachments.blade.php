<div class="row row--separate row--bottom mt-3 mb-1">
    <h3>Attachments</h3>
    <form method="POST" action="/attachments" enctype="multipart/form-data">
        {{ csrf_field() }}
        <input type="hidden" name="transaction_type" value="{{ get_class($payload) === 'App\Models\Earning' ? 'earning' : 'spending' }}" />
        <input type="hidden" name="transaction_id" value="{{ $payload->id }}" />
        <input type="file" name="file" onchange="this.form.submit()" />
    </form>
</div>
<div class="box">
    @if (!$payload->attachments->count())
        <div class="box__section text-center">No attachments for this transaction</div>
    @endif
    @foreach ($payload->attachments as $attachment)
        <div class="box__section">
            <img src="{{ $attachment->file_path }}" style="max-width: 100%; max-height: 200px; border-radius: 5px; vertical-align: top;" />
        </div>
    @endforeach
</div>
