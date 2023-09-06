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
            'title' => 'required|max:21',
            'description' => 'required|max:300',
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
            'title.max' =>'タイトルは21字以内で入力してください。',
            'description.required' => 'あらすじを入力してください。',
            'description|max' =>'あらすじは300字以内で入力してください。',
            'address.required' => '住所を入力してください。',
            'venue.required' => '会場を入力してください。',
            'web_site_url.url' => '公式サイトURLは正しいURL形式で入力してください。',
        ];
    }
}
