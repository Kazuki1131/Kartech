<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

class VisitedRecordUpdateRequest extends FormRequest
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
            'visited_at' => 'required|date',
            'memo' => 'nullable|string|max:1000',
        ];
    }

    public function attributes()
    {
        return [
            'visited_at' => '来店日',
            'memo' => 'お客様メモ',
        ];
    }
}
