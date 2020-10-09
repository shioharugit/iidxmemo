<?php

namespace App\Http\Requests\User;

use App\Rules\ExistEmail;
use Illuminate\Foundation\Http\FormRequest;

class UserPreregisterRequest extends FormRequest
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
        ];
    }
}
