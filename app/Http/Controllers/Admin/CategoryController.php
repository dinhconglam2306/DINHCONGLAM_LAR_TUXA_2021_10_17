<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Template;
use Illuminate\Http\Request;
use App\Models\CategoryModel as MainModel;
use App\Http\Requests\CategoryRequest as MainRequest;

class CategoryController extends AdminController
{
     

    public function __construct()
    {
        $this->pathViewController = 'admin.pages.category.';
        $this->controllerName     = 'category';

        $this->model = new MainModel();
        parent::__construct();
    }

    

    public function save(MainRequest $request)
    {
        if ($request->method() == 'POST') {
            $params = $request->all();

            $task   = "add-item";
            $notify = "Thêm phần tử thành công!";

            if ($params['id'] !== null) {
                $task   = "edit-item";
                $notify = "Cập nhật phần tử thành công!";
            }
            $this->model->saveItem($params, ['task' => $task]);
            return redirect()->route($this->controllerName)->with("zvn_notify", $notify);
        }
    }


    public function isHome(Request $request)
    {
        $params["currentIsHome"]  = $request->is_home;
        $params["id"]             = $request->id;
        $this->model->saveItem($params, ['task' => 'change-is-home']);
        $isHomeValue = $request->is_home == 'yes' ? 'no' : 'yes';
        $link = route($this->controllerName . '/isHome', ['is_home' => $isHomeValue, 'id' => $request->id]);
        return response()->json([
            'isHomeObj' => config('zvn.template.is_home')[$isHomeValue],
            'link' => $link,
        ]);
    }

    public function display(Request $request)
    {
        $params["currentDisplay"]   = $request->display;
        $params["id"]               = $request->id;
        $this->model->saveItem($params, ['task' => 'change-display']);
        return response()->json([
            'message' => config('zvn.notify.success.update'),
        ]);
    }

    public function ordering(Request $request){
        $params["ordering"]   = $request->ordering;
        $params["id"]         = $request->id;
        $modifyBy = session('userInfo')['username'];
        $modified = date('H:i:s Y-m-d');

        $this->model->saveItem($params, ['task' => 'change-ordering']);
        
        return response()->json([
           'id' => $params['id'],
           'modified' => Template::showItemHistory($modifyBy,$modified),
           'message'  => config('zvn.notify.success.update'),
        ]);
    }
}
