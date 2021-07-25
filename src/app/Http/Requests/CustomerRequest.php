<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:30',
            'name_kana' => 'required|string|max:30',
            'gender' => 'required|integer|digits:1',
            'birthday' => 'required|date',
            'tel' => 'required|string|url',
            'email' => 'required|email',
        ];
    }
    public function attributes()
    {
        return [
            'name' => 'お客様名',
            'name_kana' => 'お客様名(カナ)',
            'gender' => '性別',
            'birthday' => '生年月日',
            'tel' => '電話番号',
            'email' => 'email',
        ];
    }
}
