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
            'name' => 'required|string|max:30',
            'name_kana' => ['required', 'string', 'max:30','regex:/^[ァ-ヾ]+$/u'],
            'gender' => 'nullable|digits:1',
            'birthday' => 'nullable|date',
            'tel' => 'required|digits_between:8,11',
            'email' => 'nullable|email',
            'memo' => 'nullable|string|max:1000',
            'answer_text.*' => 'nullable|string|max:1000',
            'answer_select.*' => 'nullable|string|max:100',
            'answer_check.*.*' => 'nullable|string|max:100',
            'agree' => 'accepted'
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
            'answer_text.*' => '回答',
            'answer_select.*' => '回答',
            'answer_check.*.*' => '回答',
        ];
    }

    public function messages()
    {
        return [
            'name_kana.regex' => 'お客様名(カナ)にはカタカナを入力してください。',
            'agree.accepted' => '「同意する」にチェックを入れてください。',
        ];
    }
}
