
@php
use App\Helpers\Form as FormTemplate;
use App\Helpers\Template;

$formInputAttr = config('zvn.template.form_input');
$formLabelAttr = config('zvn.template.form_label');

$inputHiddenID    = Form::hidden('id', @$item['id']);

$elements = [
    [
        'label'   => Form::label('old_password', 'Mật khẩu hiện tại', $formLabelAttr),
        'element' => Form::password('old_password', $formInputAttr),
    ],
    [
        'label'   => Form::label('new_password', 'Mật khẩu mới', $formLabelAttr),
        'element' => Form::password('new_password', $formInputAttr),
    ],
    [
        'label'   => Form::label('password_confirmation', 'Xác nhận mật khẩu', $formLabelAttr),
        'element' => Form::password('password_confirmation', $formInputAttr),
    ],
    [
        'element' => $inputHiddenID . Form::submit('Save', ['class'=>'btn btn-success']),
        'type'    => "btn-submit-edit"
    ]
];
@endphp
@extends('admin.main')
@section('content')
    <div class="page-header zvn-page-header clearfix">
        <div class="zvn-page-header-title">
            <h3>Thay đổi Mật khẩu</h3>
        </div>
        <div class="zvn-add-new pull-right">
            <a href="{{ route('dashboard') }}" class="btn btn-success"><i class="fa fa-arrow-left"></i> Quay về</a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                @include('admin.templates.x_title', ['title' => 'Form Change Password'])
                @include ('admin.templates.error')
                @include ('admin.templates.zvn_notify_error')
                @include ('admin.templates.zvn_notify')
                <div class="x_content">
                    {{ Form::open([
                        'method'         => 'POST', 
                        'url'            => route("$controllerName/change-password"),
                        'accept-charset' => 'UTF-8',
                        'enctype'        => 'multipart/form-data',
                        'class'          => 'form-horizontal form-label-left',
                        'id'             => 'main-form' ])  }}
                        {!! FormTemplate::show($elements)  !!}
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
@endsection