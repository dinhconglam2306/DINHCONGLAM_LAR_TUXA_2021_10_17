@extends('news.main')
@section('content')
    <!-- Content Container -->
    <div class="content_container">
        <div class="container">
            <div class="row">

                <!-- Main Content -->
                <div class="col-lg-12 text-center">
                    <div class="main_content">
                          <img src="{{ asset('news/images/404.png') }}" alt="" style="width:100%;">
                    </div>
                    <a href="{!! route('home') !!}" class="btn btn-primary btn-back-home">Go Home</a>
                </div>
            </div>
        </div>
    </div>
@endsection