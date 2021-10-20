@php
    $buttonName = mb_strtoupper('Liên Hệ');
@endphp
<h4>Gửi tin nhắn cho chúng tôi</h4>
<div class="row">
    @include('news.pages.templates.error')
    @include('news.pages.templates.zvn_notify') 
</div>
<form method="POST" action="{{ route("$controllerName/send-contact") }}" accept-charset="UTF-8" enctype="multipart/form-data" class="form-horizontal form-label-left" id="contact-form">
    
    <div class="form-group">
        <label for="username">Họ và tên</label>
        <input type="text" class="form-control" id="username" name="username">
    </div>
    <div class="form-group">
      <label for="email">Email</label>
      <input type="email" class="form-control" id="email" name="email">
    </div>
    <div class="form-group">
        <label for="phone">Phone</label>
        <input type="text" class="form-control" id="phone" name="phone">
    </div>
    <div class="form-group">
        <label for="message">Lời nhắn</label>
        <textarea rows="3" name="contact" type="text" class="form-control" id="message" style=" resize: none;"></textarea>
    </div>
    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
    <button type="submit" class="btn btn-primary btn-contact">{{ $buttonName }}</button>
</form>
