<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MapRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'routing_guide' => 'required|string|max:200',
        ];
    }

    public function message()
    {
        return [
            'routing_guide.required' => '説明文は必ず入力してください。',
            'routing_guide.max' => '説明文は200字以内で入力してください。',
        ];
    }
}
