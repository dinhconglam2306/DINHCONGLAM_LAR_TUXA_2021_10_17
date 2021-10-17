<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MenuRequest extends FormRequest
{
    private $table            = 'menu';
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
        $id = $this->id;

        $condName  = "bail|required|between:5,100|unique:$this->table,name";
        $condTypeMenu = implode(',',array_keys(config('zvn.template.type_menu')));
        $condTypeOpen = implode(',',array_keys(config('zvn.template.type_open')));
        
      
        if(!empty($id)){ // edit
            $condName  .= ",$id";
        }
        return [
            'name'          => $condName,
            'ordering'      => 'bail|required|numeric',
            'status'        => 'bail|in:active,inactive',
            'type_menu'     => "bail|in:$condTypeMenu",
            'type_open'     => "bail|in:$condTypeOpen",
        ];
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
