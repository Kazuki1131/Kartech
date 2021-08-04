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
            'name' => 'string|max:30',
            'name_kana' => 'required|string|max:30',
            'gender' => 'integer|digits:1',
            'birthday' => 'date',
            'tel' => 'string|url',
            'email' => 'email',
            'memo' => 'string|max:1000',
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
            'email' => 'メールアドレス',
            'memo' => 'メモ',
        ];
    }
}
