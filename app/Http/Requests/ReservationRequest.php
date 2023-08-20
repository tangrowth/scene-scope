<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Date;

class ReservationRequest extends FormRequest
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
        $date = Date::find($this->input('date_id'));

        return [
            'number' => [
                'required',
                'integer',
                'min:1',
                'max:' . ($date->capacity - $date->reserved)
            ],
            'date_id' => 'required|integer',
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
            'number.required' => '予約数は必須です。',
            'number.min' => '人数は1人以上にしてください、',
            'number.max' => '残席数オーバーです。',
            'date_id.required' => '日付の選択は必須です。',
        ];
    }
}
