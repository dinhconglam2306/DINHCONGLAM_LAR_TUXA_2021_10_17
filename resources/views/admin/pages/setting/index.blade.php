@php
    $type = Request::input('type','general');
@endphp
@extends('admin.main')
@section('content')
    @include ('admin.templates.page_header', ['pageIndex' => false])
    @include ('admin.templates.error')
    @include ('admin.templates.zvn_notify')
    <div class="col-md-12 col-sm-12  ">
        <div class="x_panel">
           <div class="x_content" style="display: block;">
              <ul class="nav nav-tabs bar_tabs" id="myTab" role="tablist">
                 <li class="nav-item {{ ($type == 'general') ? 'active ' : '' }}"><a class="nav-link" href="{{ route('setting',['type' => 'general'])}}" role="tab">Cấu hình chung</a></li>
                 <li class="nav-item {{ ($type == 'email') ? 'active' : '' }}"><a class="nav-link" href="{{ route('setting',['type' => 'email'])}}" role="tab">Cấu hình Email</a></li>
                 <li class="nav-item {{ ($type == 'social') ? 'active' : '' }}"><a class="nav-link" href="{{ route('setting',['type' => 'social'])}}" role="tab">Social Network</a></li>
              </ul>
              <div id="settingContent" class="tab-content">
                  @switch($type)
                    @case('general')
                        @include('admin.pages.setting.form_general')
                    @break
                    @case('email')
                        @include('admin.pages.setting.form_email_account')
                        @include('admin.pages.setting.form_email_bcc')
                    @break
                    @case('social')
                        @include('admin.pages.setting.form_social_network')
                    @break
                  @endswitch
              </div>
           </div>
        </div>
     </div>
@endsection
