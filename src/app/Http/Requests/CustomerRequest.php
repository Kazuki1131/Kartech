<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

class CustomerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'nullable|string|max:30',
            'name_kana' => 'required|string|max:30',
            'gender' => 'nullable|digits:1',
            'birthday' => 'nullable|date',
            'tel' => 'nullable|digits_between:8,11',
            'email' => 'nullable|email',
            'memo' => 'nullable|string|max:1000',
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
