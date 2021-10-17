<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SettingRequest extends FormRequest
{
    private $table            = 'setting';
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        // $condThumb = 'bail|required|image|max:500';
        $rule =[];

        $task = $this->task;

        switch ($task) {
            case 'general':
                $rule =[
                    // 'logo'        =>  $condThumb,
                    'hotline'       => 'bail|required|min:2',
                    'copyright'     => 'bail|required|min:2',
                    'date_time'     => 'bail|required|min:2',
                    'address'       => 'bail|required|min:5',];
            break;
            case 'email_bcc':
                $rule =['bcc'       => 'bail|required|email'];
            break;
            case 'email_account':
                $rule =[
                    'email_account'       => 'bail|required|email',
                    'password'            => 'bail|required|min:6',];
            break;
            case 'social':
                $rule =[
                    'youtube'       => 'bail|required|min:5|url',
                    'facebook'      => 'bail|required|min:5|url',
                ];
            break;
        }

        return $rule;
    }

    public function messages()
    {
        return [
            // 'name.required' => 'Name không được rỗng',
            // 'name.min'      => 'Name :input chiều dài phải có ít nhất :min ký tứ',
        ];
    }
    public function attributes()
    {
        return [
            // 'description' => 'Field Description: ',
        ];
    }
}
