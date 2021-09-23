<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;
use Illuminate\Validation\Rule;
use App\Models\Customer;

class CustomerUpdateRequest extends FormRequest
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
        $customer = Customer::where([
            ['id', $this->id],
            ['shop_id', Auth::id()]
        ])->get();

        return [
            'control_number' => ['required', 'max:8', Rule::unique('customers')->ignore(intval($this->id))->where('shop_id', Auth::id())],
            'name' => 'required|string|max:30',
            'name_kana' => ['required', 'string', 'max:30','regex:/^[ァ-ヾ]+$/u'],
            'gender' => 'nullable|digits:1',
            'birthday' => 'nullable|date',
            'tel' => 'required|digits_between:8,11',
            'email' => 'nullable|email',
            'memo' => 'nullable|string|max:1000',
        ];
    }

    public function attributes()
    {
        return [
            'control_number' => '顧客番号',
            'name' => 'お客様名',
            'name_kana' => 'お客様名(カナ)',
            'gender' => '性別',
            'birthday' => '生年月日',
            'tel' => '電話番号',
            'email' => 'メールアドレス',
            'memo' => 'メモ',
        ];
    }

    public function messages()
    {
        return [
            'name_kana.regex' => 'お客様名(カナ)にはカタカナを入力してください。',
        ];
    }
}
