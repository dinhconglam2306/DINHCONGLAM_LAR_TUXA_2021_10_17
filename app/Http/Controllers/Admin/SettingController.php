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

    public function save(MainRequest $request)
    {

        if ($request->method() == 'POST') {
            $params = $request->all();
            switch ($params['task']) {
                case 'setting_email_bcc':
                case 'setting_email_account':
                  $type = 'email';
                    break;
                case 'setting_social':
                    $type = 'social';
                        break;
                case 'setting_general':
                    $type = 'general';
                        break;
            }
            $this->model->saveItem($params,null);
            return redirect()->route('setting',['type'=>$type])->with("zvn_notify", 'Cập nhật thành công');
        }
    }
}
