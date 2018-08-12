@foreach ($errors->get($payload) as $error)
    <div style="font-size: 14px; color: red; margin-bottom: 20px;">{{ $error }}</div>
@endforeach
