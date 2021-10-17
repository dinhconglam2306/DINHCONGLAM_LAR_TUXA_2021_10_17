@extends('news.main')
@section('content')
<div class="section-category">
    @include('news.block.breadcrumb', ['item' => ['name' => $title]])
    <div class="content_container container_category">
        <div class="featured_title">
            <div class="container">
                <div class="row">
                @include('news.pages.templates.error')
                </div>
                <div class="row">
                   
                    @include('news.pages.templates.zvn_notify') 
                    @include('news.pages.contact.child-index.information', ['items' => $contactValue]) 
                </div>
                <div class="row mt-5">
                    <div class="col-lg-6">
                        {!! $map !!}
                    </div>
                    <div class="col-lg-6">
                        @include('news.pages.contact.child-index.form') 
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection