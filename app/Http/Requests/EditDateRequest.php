<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditDateRequest extends FormRequest
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
            'capacity' => 'required|min:1|integer'
        ];
    }

    public function messages()
    {
        return [
            'start_date.required' => '日付は必須です。',
            'capacity.required' => '席数を入力してください。',
            'capacity.required' => '席数は1以上にしてください。'
        ];
    }
}
