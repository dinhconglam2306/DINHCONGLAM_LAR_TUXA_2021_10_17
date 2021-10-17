
@extends('admin.main')
@section('content')
    <div class="page-header zvn-page-header clearfix">
        <div class="zvn-page-header-title">
            <h3>Quản lý Dashboard</h3>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <ul class="nav navbar-right panel_toolbox">
                        <li class="pull-right"><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                @foreach ($arrMenuValue as $item)
                    <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 ">
                        <div class="tile-stats">
                        <div class="icon"><i class="{{ $item['icon'] }}"></i></div>
                        <div class="count">{{ $item['total'] }}</div>
                        <h3>{{ $item['name'] }}</h3>
                        <a href="{!! $item['link'] !!}"><p>Xem chi tiết</p></a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection