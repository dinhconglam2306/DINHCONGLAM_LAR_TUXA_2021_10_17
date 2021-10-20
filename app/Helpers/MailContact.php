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
        $titleEmail = 'Thông báo : Có liên hệ từ người dùng';

        $content = [
            'name' => $params['username'],
            'email' => $params['email'],
            'phone' => $params['phone'],
            'contact' => $params['contact'],
        ];
        //Lấy mail bcc
        $bccValue = json_decode(SettingModel::where('key_value', 'setting_email_bcc')->first()['value'],true);
        if($bccValue['bcc'] == null){
            $data['bcc'] = 'dinhconglam2306@gmail.com';
            Mail::send('news.pages.contact.emailtoBcc', $content, function ($message) use ($titleEmail, $data) {
                $message->to($data['bcc'])->subject($titleEmail);
                $message->from($data['admin'], $titleEmail);
            });
        }else{
            $bccValue = explode(',',$bccValue['bcc']);
            Mail::send('news.pages.contact.emailtoBcc', $content, function ($message) use ($titleEmail, $bccValue,$data) {
                foreach ($bccValue as $bcc) {
                    $message->to($bcc)->subject($titleEmail);
                }
                $message->from($data['admin'], $titleEmail);
            });
        }
    }

}
