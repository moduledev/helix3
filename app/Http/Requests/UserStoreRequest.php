<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends FormRequest
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
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'phone' => 'required|unique:users|min:10',
            'password' => 'required|min:8',
        ];
    }

    /**
     * Custom message for validation
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => "Ім'я обов'язково!",
            'email.required' => 'E-mail обов\'язково!',
            'email.unique' => 'email вже існує!',
            'password.required' => 'Введіть пароль!',
            'phone.required' => 'Введіть Телефон!',
            'password.min' => 'Довжина паролю повинна булти не менше 8 символів!',
            'phone.min' => 'Телефон не повинен бути менше 10 символів!',
        ];
    }
}
