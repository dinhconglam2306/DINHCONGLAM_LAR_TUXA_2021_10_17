<!-- menu profile quick info -->
@php
    $avatar =session('userInfo')['avatar'];
    $settingActive   = (Request::input('type'))? 'active' : '' ;
   
@endphp
<div class="profile clearfix">
    <div class="profile_pic">
        <img src="{{ asset('images/user/' . $avatar) }}" alt="..." class="img-circle profile_img">
    </div>
    <div class="profile_info">
        <span>Welcome,</span>
        <h2>{{ session('userInfo')['fullname'] }}</h2>
    </div>
</div>
<!-- /menu profile quick info -->
<br/>
<!-- sidebar menu -->
<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
    <div class="menu_section">
        <h3>Menu</h3>
        <ul class="nav side-menu">
            <li class = "{{ (request()->path() == 'admin') ? 'active' : ''}}" ><a href="{{ route('dashboard') }}"><i class="fa fa-home"></i> Dashboard</a></li>
            <li><a href="{{ route('user') }}"><i class="fa fa-user"></i> User</a></li>
            <li><a href="{{ route('category') }}"><i class="fa fa fa-building-o"></i> Category</a></li>
            <li><a href="{{ route('article') }}"><i class="fa fa-newspaper-o"></i> Article</a></li>
            <li><a href="{{ route('slider') }}"><i class="fa fa-sliders"></i> Silders</a></li>
            <li><a href="{{ route('rss') }}"><i class="fa fa-link"></i> Rss</a></li>
            <li><a href="{{ route('menu') }}"><i class="fa fa-sitemap" aria-hidden="true"></i> Menu</a></li>
            <li><a href="{{ route('gallery') }}"><i class="fa fa-picture-o" aria-hidden="true"></i>Gallery</a></li>
            <li><a href="{{ route('contact') }}"><i class="fa fa-envelope-o" aria-hidden="true"></i></i>Contact</a></li>
            <li class="{{ $settingActive }}">
                <a><i class="fa fa-cogs"></i> Cấu hình <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="{{ route('setting',['type' => 'general' ]) }}">Cấu hình chung</a></li>
                    <li><a href="{{ route('setting',['type' => 'email']) }}">Cấu hình Email</a></li>
                    <li><a href="{{ route('setting',['type' => 'social']) }}">Social Network</a></li>
                </ul>
            </li>
            <li><a href="{{ route('password') }}"><i class="fa fa-key"></i> Password</a></li>
        </ul>
    </div>
</div>
<!-- /sidebar menu -->
