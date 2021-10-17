<?php

namespace App\Rules;

use App\Models\UserModel;
use Illuminate\Contracts\Validation\Rule;

class Uppercase implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $data = UserModel::where('username', session('userInfo')['username'])->where('password', md5($value))->first();
        return !empty($data);
    }
    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Mật khẩu hiện tại chưa đúng';
    }
}
