@php
    $content = mb_strtoupper(session('send_success'));
@endphp
@if (session('send_success'))
    <div class="col-md-12 col-sm-12 col-xs-12 text-center">
        <div class="alert alert-info">
            <h4>{{ $content }}</h4>
        </div> 
    </div>
@endif