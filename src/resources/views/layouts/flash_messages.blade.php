@if (session('flash_message'))
    <div class="alert bg-origin-body text-center">
        {{ session('flash_message') }}
    </div>
@endif
@foreach ($errors->all() as $message)
<div class="alert text-center bg-origin-body">{{ $message }}</div>
@endforeach