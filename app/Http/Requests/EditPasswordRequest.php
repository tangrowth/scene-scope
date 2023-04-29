<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditPasswordRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed|different:current_password',
        ];
    }


    public function messages()
    {
        return [
            'current_password.required' => '現在のパスワードは必須です',
            'new_password.required' => '新しいパスワードは必須です',
            'new_password.min' => 'パスワードは8文字以上で入力してください',
            'new_password.different' => '新しいパスワードは現在のパスワードと異なるものを入力してください',
            'new_password.confirmed' => 'パスワードが確認用パスワードと一致しません'
        ];
    }
}
