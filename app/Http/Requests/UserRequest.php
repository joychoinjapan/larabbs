<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UserRequest extends FormRequest
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
            'name' => 'required|between:3,25|regex:/^[A-Za-z0-9\-\_]+$/|unique:users,name,' . Auth::id(),
            'email' => 'required|email',
            'introduction' => 'max:80',
        ];
    }


    public function messages()
    {
        return [
            'name.unique'=>'ユーザー名はすでに使用されております。',
            'name.regex'=>'ユーザー名は英数字、または"_""/""-"を使用してください。',
            'name.between'=>'ユーザー名の文字数を3から25まで設定してください。',
            'name.required'=>'ユーザー名を入力してください。'
        ];
    }
}
