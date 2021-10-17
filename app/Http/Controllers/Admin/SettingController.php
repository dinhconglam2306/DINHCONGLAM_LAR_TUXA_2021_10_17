<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SettingModel as MainModel;
use App\Http\Requests\SettingRequest as MainRequest;

class SettingController extends Controller
{
    private $pathViewController = 'admin.pages.setting.';  // slider
    private $controllerName     = 'setting';
    private $params             = [];
    private $model;

    public function __construct()
    {
        $this->model = new MainModel();
        view()->share('controllerName', $this->controllerName);
    }

    public function index(Request $request)
    {
        $settingGeneral         = $this->model->getItem(null,['task' => 'setting-general']);
        $settingEmailBcc        = $this->model->getItem(null,['task' => 'setting-email-bcc']);
        $settingEmailAccount    = $this->model->getItem(null,['task' => 'setting-email-account']);
        $settingSocial          = $this->model->getItem(null,['task' => 'setting-social']);
        
        return view($this->pathViewController .  'index', [
            'settingGeneral'        => $settingGeneral,
            'settingEmailBcc'       => $settingEmailBcc,
            'settingEmailAccount'   => $settingEmailAccount,
            'settingSocial'         => $settingSocial,
        ]);
    }

    public function general(MainRequest $request)
    {

        if ($request->method() == 'POST') {
            $params = $request->all();
            unset($params['_token']);
            unset($params['task']);
            
            $this->model->saveItem($params, ['task' => 'setting-general']);
            return redirect()->route('setting',['type'=>'general'])->with("zvn_notify", 'Cập nhật thành công');
            
        }
    }
    public function emailAccount(MainRequest $request)
    {

        if ($request->method() == 'POST') {
            $params = $request->all();
            unset($params['_token']);
            unset($params['task']);

            $this->model->saveItem($params, ['task' => 'setting-email-account']);
            return redirect()->route('setting',['type'=>'email'])->with("zvn_notify", 'Cập nhật thành công');
            
        }
    }

    public function emailBcc(MainRequest $request)
    {

        if ($request->method() == 'POST') {
            $params = $request->all();
            unset($params['_token']);
            unset($params['task']);

            $this->model->saveItem($params, ['task' => 'setting-email-bcc']);
            return redirect()->route('setting',['type'=>'email'])->with("zvn_notify", 'Cập nhật thành công');
            
        }
    }

    public function social(MainRequest $request)
    {

        if ($request->method() == 'POST') {
            
            $params = $request->all();
            unset($params['_token']);
            unset($params['task']);

            $this->model->saveItem($params, ['task' => 'setting-social']);
            return redirect()->route('setting',['type'=>'social'])->with("zvn_notify", 'Cập nhật thành công');
            
        }
    }
}
