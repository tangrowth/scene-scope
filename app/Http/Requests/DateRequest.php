<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DateRequest extends FormRequest
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
            'start_date' => 'required',
            'capacity' => 'required|min:1|integer'
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'start_date.required' => '日付は必須です。',
            'capacity.required' => '席数を入力してください。',
            'capacity.required' => '席数は1以上にしてください。'
        ];
    }
}
