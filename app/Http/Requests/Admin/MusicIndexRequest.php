<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class MusicIndexRequest extends FormRequest
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
            'title' => 'nullable|max:255',
            'genre' => 'nullable|max:255',
            'artist' => 'nullable|max:255',
            'version' => 'nullable|in:' . implode(',', array_keys(config('const.VERSION'))),
            'popular_name' => 'nullable|max:255',
        ];
    }
}
