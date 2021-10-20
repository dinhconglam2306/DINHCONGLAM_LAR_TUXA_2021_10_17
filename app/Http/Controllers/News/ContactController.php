<?php

namespace App\Http\Controllers\News;
use App\Helpers\MailContact;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ContactRequest as MainRequest;
use App\Models\SettingModel;
use App\Models\ContactModel;


class ContactController extends Controller
{
    private $pathViewController = 'news.pages.contact.';  // slider
    private $controllerName     = 'contact';
    private $params             = [];
    private $model;

    public function __construct()
    {
        $this->model = new ContactModel();
        view()->share('controllerName', $this->controllerName);
    }

    public function index(Request $request)
    {
        view()->share('title', 'Liên Hệ');
        $settingModel = new SettingModel();
        $contact  = $settingModel->getItem(null, ['task' => 'new-in-contact']);

        $contactValue = [
            'address' => [
                'name' => 'Địa chỉ',
                'description' => $contact['address'],
                'icon' => 'fa fa-map-marker',
            ],
            'hotline' => [
                'name' => 'Hotline',
                'description' => $contact['hotline'],
                'icon' => 'fa fa-phone',
            ],
            'email' => [
                'name' => 'Email',
                'description' => $contact['email'],
                'icon' => 'fa fa-envelope-o',
            ],
        ];
        $map = $contact['map'];
        return view($this->pathViewController .  'index', [
            'contactValue' => $contactValue,
            'map'     => $map,
        ]);
    }

    public function sendContact(MainRequest $request)
    {   
        $params = $request->all();

        //Send Email
        // MailContact::sendCustomer($params);
        // MailContact::sendBcc($params);
        // Save Database
        $this->model->saveItem($params, ['task' => 'add-item']);
        return redirect()->back()->with('send_success', 'Gửi thông tin liên hệ thành công');
    }
}
