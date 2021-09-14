<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Auth;

class SurveyRequest extends FormRequest
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
    public function rules(Request $request)
    {
        return [
            'question' => 'required|string|max:100',
            'type' => 'required|digits:1',
            'singleAnswers.*' => 'nullable|string|max:100',
            'multipleAnswers.*' => 'nullable|string|max:100',
        ];
    }

    public function attributes()
    {
        return [
            'question' => 'アンケート内容',
            'type' => 'アンケートタイプ',
            'singleAnswers.*' => '選択肢',
            'multipleAnswers.*' => '選択肢',
        ];
    }
}
