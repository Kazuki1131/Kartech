<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

class VisitedRecordRequest extends FormRequest
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
            'customer_id' => 'required|integer',
            'visited_at' => 'nullable|date',
            'menu' => 'nullable|digits:1',
            'images.*' => 'nullable|image|max:30000',
            'memo' => 'nullable|string|max:1000',
        ];
    }

    public function attributes()
    {
        return [
            'visited_at' => '来店日',
            'menu' => '提供メニュー',
            'images.*' => '写真',
            'memo' => 'お客様メモ',
        ];
    }

    public function messages()
    {
        return [
            'images.*.max' => '一度に送信できるのは30メガバイトまでです。',
        ];
    }
}