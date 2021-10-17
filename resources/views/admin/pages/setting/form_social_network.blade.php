
@php
    use App\Helpers\Form as FormTemplate;
    use App\Helpers\Template;

    $formInputAttr      = config('zvn.template.form_input');
    $formLabelAttr      = config('zvn.template.form_label');


    $inputHiddenTask      = Form::hidden('task', 'social');
    
    $elements = [
        [
            'label'   => Form::label('youtube', 'Youtube', $formLabelAttr),
            'element' => Form::text('youtube', @$settingSocial['youtube'],  $formInputAttr )
        ],
        [
            'label'   => Form::label('facebook', 'Facebook', $formLabelAttr),
            'element' => Form::text('facebook', @$settingSocial['facebook'],  $formInputAttr )
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
                    'url'            => route("$controllerName/social_setting"),
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