<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'name'=>'string|min:3|max:50',
            'family'=>'string|min:4|max:50',
            'mobile'=>'required|string|min:8|max:50',
            'email'=>'required|email|min:8|max:50',
            'password'=>'required|string|min:6|max:8',
        ];
    }
}
