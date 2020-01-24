<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SendSmsToMobileRequest extends FormRequest
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
            'email'=>'email|required|max:250',
            'mobile'=>'string|required|max:20',
            'password'=>'string|required|min:6|max:255',
        ];
    }
}
