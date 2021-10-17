<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\ContactModel as MainModel;
use App\Http\Requests\ContactRequest as MainRequest;

class ContactController extends AdminController
{
    public function __construct()
    {
        $this->pathViewController = 'admin.pages.contact.';
        $this->controllerName = 'contact';
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

    public function status(Request $request)
    {
        $params["currentStatus"]  = $request->status;
        $params["id"]             = $request->id;
        $this->model->saveItem($params, ['task' => 'change-status']);
        $status = $request->status == 'active' ? 'inactive' : 'active';
        $link = route($this->controllerName . '/status', ['status' => $status, 'id' => $request->id]);
        return response()->json([
            'statusObj' => config('zvn.template.contact')[$status],
            'link' => $link,
        ]);
    }

}
