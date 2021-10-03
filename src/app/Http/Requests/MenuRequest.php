<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

class MenuRequest extends FormRequest
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
            'name' => 'required|string|max:100',
            'price' => 'required|integer',
            'description' => 'nullable|string|max:1000',
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'メニュー名',
            'price' => 'メニュー料金',
            'description' => 'メニュー内容',
        ];
    }
}
