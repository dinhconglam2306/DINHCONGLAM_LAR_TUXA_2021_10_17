@php
    $userName   =session('userInfo')['username'];
    $avatar     =session('userInfo')['avatar'];
@endphp
<div class="nav_menu">
    <nav>
        <div class="nav toggle">
            <a id="menu_toggle"><i class="fa fa-bars"></i></a>
        </div>
        <ul class="nav navbar-nav navbar-right">
            <li class="">
                <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                <img src="{{ asset('images/user/' . $avatar) }}" alt="">{{ $userName }}
                    <span class=" fa fa-angle-down"></span>
                </a>
                <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a href="{{ route('auth/logout') }}"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                    <li><a href="{{ route('password') }}"><i class="fa fa-key pull-right"></i> Change Password</a></li>
                </ul>
            </li>
            <div class="nav toggle pull-right" style="margin-right:50px;">
                <a href="{{ route('home') }}" target="_blank" title="View web"><i class="fa fa-th pull-right"></i></a>
            </div>
        </ul>
    </nav>
</div>