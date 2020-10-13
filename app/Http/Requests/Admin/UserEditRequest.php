<?php

namespace App\Http\Requests\Admin;

use App\Rules\ExistEmail;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserEditRequest extends FormRequest
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
            'email' => [
                'required',
                'email',
                'confirmed',
                'max:255',
                new ExistEmail($this->request->all()),
            ],
            'login_id' => [
                'required',
                'regex:/^[0-9a-zA-Z_@-]+$/',
                'min:6',
                'max:20',
                Rule::unique('users')->ignore($this->id),
            ],
            'password' => 'nullable|regex:/^[0-9a-zA-Z_@-]+$/|confirmed|min:6|max:20',
        ];
    }
}
