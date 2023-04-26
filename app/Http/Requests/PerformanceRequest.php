<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PerformanceRequest extends FormRequest
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
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'venue' => 'required|string|max:255',
            'web_site_url' => 'required|url|max:255',
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
            'title.required' => '公演名は必須です。',
            'title.max' => '公演名は255文字以下で入力してください。',
            'description.required' => 'あらすじは必須です。',
            'venue.required' => '会場は必須です。',
            'venue.max' => '会場は255文字以下で入力してください。',
            'web_site_url.required' => '公式サイトは必須です。',
            'web_site_url.url' => '正しいURL形式で入力してください。',
            'web_site_url.max' => '公式サイトは255文字以下で入力してください。',
        ];
    }
}
