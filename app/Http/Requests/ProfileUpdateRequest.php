<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class ProfileUpdateRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name'       => ['required', 'string', 'max:255'],
            'email'      => ['required', 'email', 'string', 'max:255', Rule::unique('users')->ignore(Auth::user())],
            'avatar_img' => ['nullable', "mimes:png,jpg,jpeg", "max:2048"],
            'password'   => ['nullable', 'string', 'confirmed', 'min:8'],
        ];
    }

    public function authorize()
    {
        return true;
    }

    protected function prepareForValidation()
    {
        if (is_null($this->password)) {
            $this->request->remove('password');
        }
    }
}
