<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Template;
use Illuminate\Http\Request;
use App\Models\MenuModel as MainModel;
use App\Http\Requests\MenuRequest as MainRequest;

class MenuController extends AdminController
{
    public function __construct()
    {
        $this->pathViewController = 'admin.pages.menu.';
        $this->controllerName     = 'menu';
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

    public function typeOpen(Request $request){
        $params["currentTypeOpen"]   = $request->type_open;
        $params['id'] = $request->id;

        $this->model->saveItem($params, ['task' => 'change-type-open']);
        return response()->json([
            'message'  => config('zvn.notify.success.update'),
         ]);
    }

    public function typeMenu(Request $request){
        $params["currentTypeMenu"]   = $request->type_menu;
        $params['id'] = $request->id;

        $this->model->saveItem($params, ['task' => 'change-type-menu']);
        return response()->json([
            'message'  => config('zvn.notify.success.update'),
         ]);
    }

    public function ordering(Request $request){
        $params["ordering"]   = $request->ordering;
        $params['id'] = $request->id;
        $this->model->saveItem($params, ['task' => 'change-ordering']);
        return response()->json([
            'message'  => config('zvn.notify.success.update'),
         ]);
    }
}
