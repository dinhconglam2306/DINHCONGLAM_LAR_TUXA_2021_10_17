
@php
use App\Helpers\Form as FormTemplate;
use App\Helpers\Template;

$formInputAttr      = config('zvn.template.form_input');
$formLabelAttr      = config('zvn.template.form_label');

$inputHiddenTask  = Form::hidden('task', 'setting_email_bcc');
$inputBcc =  sprintf('<input class="form-control col-md-6 col-xs-12" name="bcc" type="text" value="%s" id="bcc" data-role="tagsinput">',@$settingEmailBcc['bcc']);
$elements = [
    [
        'label'   => Form::label('bcc', 'Email Bcc1', $formLabelAttr),
        'element' => $inputBcc
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
        @include('admin.templates.x_title', ['title' => 'Cấu hình Email Bcc'])
        <div class="x_content">
            {{ Form::open([
                'method'         => 'POST', 
                'url'            => route("$controllerName/save"),
                'accept-charset' => 'UTF-8',
                'enctype'        => 'multipart/form-data',
                'class'          => 'form-horizontal form-label-left',
                'id'             => 'mail-bcc-form' ])  }}
                {!! FormTemplate::show($elements)  !!}
            {{ Form::close() }}
        </div>
    </div>
</div>
</div>