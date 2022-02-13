<?php

namespace App\Http\Requests\Admin\users;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            'name'       => ['required', 'string'],
            'email'      => ['required', 'string', 'email'],
            'avatar_img' => ["nullable", "mimes:png,jpg,jpeg", "max:2048"],
        ];
    }
}
