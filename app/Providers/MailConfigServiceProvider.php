<?php

namespace App\Providers;

use App\Models\SettingModel;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Config;

class MailConfigServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $result = json_decode(SettingModel::where('key_value', 'setting_email_account')->first()['value'],true);
        $email = $result['email_account'];
        $password = $result['password'];
        // $email = SettingModel::where('key_        // $email = SettingModel::where('key_value', 'setting_general');
        Config::set('mail.mailers.smtp.username', $email);
        Config::set('mail.mailers.smtp.password', $password);
    }
}
