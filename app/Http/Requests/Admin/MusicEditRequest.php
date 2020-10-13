<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class MusicEditRequest extends FormRequest
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
            'version' => 'nullable|in:' . implode(',', array_keys(config('const.VERSION'))),
            'title' => 'required|max:255',
            'genre' => 'nullable|max:255',
            'artist' => 'nullable|max:255',
            'bpm' => 'nullable|max:255',
            'popular_name' => 'nullable|max:255',
            'sp_beginner' => 'nullable|numeric|digits_between:0,2',
            'sp_normal' => 'nullable|numeric|digits_between:0,2',
            'sp_hyper' => 'nullable|numeric|digits_between:0,2',
            'sp_another' => 'nullable|numeric|digits_between:0,2',
            'sp_leggendaria' => 'nullable|numeric|digits_between:0,2',
            'dp_beginner' => 'nullable|numeric|digits_between:0,2',
            'dp_normal' => 'nullable|numeric|digits_between:0,2',
            'dp_hyper' => 'nullable|numeric|digits_between:0,2',
            'dp_another' => 'nullable|numeric|digits_between:0,2',
            'dp_leggendaria' => 'nullable|numeric|digits_between:0,2',
        ];
    }
}
