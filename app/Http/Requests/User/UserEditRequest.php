<?php

namespace App\Http\Requests\User;

use App\Rules\ExistLoginId;
use Illuminate\Foundation\Http\FormRequest;

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
            'login_id' => [
                'required',
                'regex:/^[0-9a-zA-Z_@-]+$/',
                'min:6',
                'max:20',
                new ExistLoginId($this->request->all()),
            ],
            'password' => 'nullable|regex:/^[0-9a-zA-Z_@-]+$/|confirmed|min:6|max:20',
        ];
    }
}
