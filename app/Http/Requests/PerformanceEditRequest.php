<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PerformanceEditRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function rules()
    {
        return [
            'title' => 'required',
            'description' => 'required',
            'address' => 'required',
            'venue' => 'required',
            'web_site_url' => 'nullable|url',
        ];
    }

    /**
     * Get custom error messages for validator errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'title.required' => 'タイトルを入力してください。',
            'description.required' => '説明を入力してください。',
            'address.required' => '住所を入力してください。',
            'venue.required' => '会場を入力してください。',
            'web_site_url.url' => '公式サイトURLは正しいURL形式で入力してください。',
        ];
    }
}
