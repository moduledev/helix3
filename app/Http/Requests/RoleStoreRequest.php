<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoleStoreRequest extends FormRequest
{
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
        return [
            'name' => 'required|unique:roles',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Поле роль обов\'язкове для заповнення!',
            'name.unique' => 'Індифікатор "роль" повинен бути унікальним!',
        ];
    }
}
