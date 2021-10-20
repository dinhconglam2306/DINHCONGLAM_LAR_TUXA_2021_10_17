
@php
use App\Helpers\Form as FormTemplate;
use App\Helpers\Template;

$formInputAttr      = config('zvn.template.form_input');
$formLabelAttr      = config('zvn.template.form_label');


$inputHiddenTask  = Form::hidden('task', 'setting_email_account');
$elements = [
    [
        'label'   => Form::label('email_account', 'Email Chính', $formLabelAttr),
        'element' => Form::text('email_account', @$settingEmailAccount['email_account'],  $formInputAttr )
    ],
    [
        'label'   => Form::label('password', 'Password', $formLabelAttr),
        'element' => Form::password('password', $formInputAttr),
    ],
    [
        'element' => $inputHiddenTask . Form::submit('Save', ['class'=>'btn btn-success']),
        'type'    => "btn-submit"
    ]
];
@endphp

<div class="row">
<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
        @include('admin.templates.x_title', ['title' => 'Cấu hình Email Chính'])
        <div class="x_content">
            {{ Form::open([
                'method'         => 'POST', 
                'url'            => route("$controllerName/email_account_setting"),
                'accept-charset' => 'UTF-8',
                'enctype'        => 'multipart/form-data',
                'class'          => 'form-horizontal form-label-left',
                'id'             => 'mail-account-form' ])  }}
                {!! FormTemplate::show($elements)  !!}
            {{ Form::close() }}
        </div>
    </div>
</div>
</div>