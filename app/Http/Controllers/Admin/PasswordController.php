<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PasswordModel as MainModel;
use App\Models\UserModel;
use App\Http\Requests\PasswordRequest as MainRequest;

class PasswordController extends Controller
{
    private $pathViewController = 'admin.pages.password.';  // slider
    private $controllerName     = 'password';
    private $params             = [];
    private $model             = '';
    public function __construct()
    {
        $this->model = new MainModel();
        $this->params["pagination"]["totalItemsPerPage"] = 5;
        view()->share('controllerName', $this->controllerName);
    }

    public function index(Request $request)
    {
        return view($this->pathViewController .  'index', []);
    }

    public function changePassword(MainRequest $request)
    {
        $params = $request->all();
        $params['id'] = session('userInfo')['id'];
        
        $userModel  = new UserModel();
        $userModel->saveItem($params,['task'=>'change-password-of-admin']);
        return redirect()->route($this->controllerName)->with('zvn_notify', 'Thay đổi mật khẩu thành công');
        
    }
}
