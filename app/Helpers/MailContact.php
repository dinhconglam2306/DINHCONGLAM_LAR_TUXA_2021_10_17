<?php

namespace App\Helpers;
use App\Models\SettingModel;
use Mail;


class MailContact
{
    public static function sendCustomer($params)
    {
        $result = json_decode(SettingModel::where('key_value', 'setting_email_account')->first()['value'],true);
        $data['admin'] = $result['email_account'];
        $data['customer'] = $params['email'];
        $titleEmail = 'Thông báo từ ZendVN';

        $customerName = ['name' => $params['username']];

        Mail::send('news.pages.contact.email', $customerName, 
        function ($message) use ($titleEmail, $data) {
            $message->to($data['customer'])->subject($titleEmail);
            $message->from($data['admin'], $titleEmail);
        });

    }

    public static function sendBcc($params)
    {
        //Lấy  email Admin
        $result = json_decode(SettingModel::where('key_value', 'setting_email_account')->first()['value'],true);
        $data['admin'] = $result['email_account'];

        //Lấy mail bcc
        $bccValue = json_decode(SettingModel::where('key_value', 'setting_email_bcc')->first()['value'],true);
        $data['bcc'] = $bccValue['bcc'];

        $titleEmail = 'Thông báo : Có liên hệ từ người dùng';

        $content = [
            'name' => $params['username'],
            'email' => $params['email'],
            'phone' => $params['phone'],
            'contact' => $params['contact'],
        ];
        Mail::send('news.pages.contact.emailtoBcc', $content, function ($message) use ($titleEmail, $data) {
            $message->to($data['bcc'])->subject($titleEmail);
            $message->from($data['admin'], $titleEmail);
        });

    }

}
