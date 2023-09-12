<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompanyRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => 'required|string|max:16',
            'description' => 'required|string|max:300',
            'web_site_url' => 'nullable|url',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => '劇団名は必須項目です',
            'name.string' => '劇団名は文字列で入力してください',
            'name.max' => '劇団名は16文字以内で入力してください',
            'description.string' => '劇団説明は文字列で入力してください',
            'description.required' => '劇団説明は必須項目です',
            'description.300' => '劇団説明は300字以内で入力してください',
            'web_site_url.url' => '公式サイトは正しいURL形式で入力してください',
        ];
    }
}
