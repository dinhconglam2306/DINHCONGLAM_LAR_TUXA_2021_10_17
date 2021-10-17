
@php
use App\Helpers\Form as FormTemplate;
use App\Helpers\Template;

$formInputAttr      = config('zvn.template.form_input');
$formLabelAttr      = config('zvn.template.form_label');

$inputHiddenTask      = Form::hidden('task', 'general');

$formTextarea       = sprintf('<textarea class="form-control" id="setting-general" name="introduce">%s</textarea>',@$settingGeneral['introduce']);
$logo               = sprintf('
    <div class="input-group">
        <span class="input-group-btn">
            <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary"><i class="fa fa-picture-o"></i> Choose</a>
        </span>
        <input id="thumbnail" class="form-control" type="text" name="logo" value="%s">
    </div>
    <img src="%s" id="holder" style="margin-top:15px;max-height:100px;" >
',@$settingGeneral['logo'],asset(@$settingGeneral['logo']));

$elements = [
    [
        'label'   => Form::label('logo', 'Logo', $formLabelAttr),
        'element' => $logo
    ],
    [
        'label'   => Form::label('hotline', 'Hotline', $formLabelAttr),
        'element' => Form::text('hotline', @$settingGeneral['hotline'],  $formInputAttr )
    ],
    [
        'label'   => Form::label('copyright', 'Copyright', $formLabelAttr),
        'element' => Form::text('copyright', @$settingGeneral['copyright'],  $formInputAttr )
    ],
    [
        'label'   => Form::label('date_time', 'Thời gian làm việc', $formLabelAttr),
        'element' => Form::text('date_time',@$settingGeneral['date_time'], $formInputAttr),
    ],
    [
        'label'   => Form::label('address', 'Địa chỉ ', $formLabelAttr),
        'element' => Form::text('address',@$settingGeneral['address'], $formInputAttr),
    ],
    [
        'label'   => Form::label('introduce', 'Giới thiệu', $formLabelAttr),
        'element' => $formTextarea,
    ],
    [
        'label'   => Form::label('map', 'Bản đồ', $formLabelAttr),
        'element' => Form::text('map',@$settingGeneral['map'], $formInputAttr),
    ],
    [
        'element' => $inputHiddenTask  . Form::submit('Save', ['class'=>'btn btn-success']),
        'type'    => "btn-submit"
    ]
];
@endphp

<div class="row">
<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
        @include('admin.templates.x_title', ['title' => 'Cấu hình chung'])
        <div class="x_content">
            {{ Form::open([
                'method'         => 'POST', 
                'url'            => route("$controllerName/general_setting"),
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