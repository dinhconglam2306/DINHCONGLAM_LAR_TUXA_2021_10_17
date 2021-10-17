@php
    $content = mb_strtoupper(session('send_success'));
@endphp
@if (session('send_success'))
        <div class="col-md-12 col-sm-12 col-xs-12 text-center mb-5">
             <h3 style="color: #61e49b">{{ $content }}</h3>
        </div>
@endif