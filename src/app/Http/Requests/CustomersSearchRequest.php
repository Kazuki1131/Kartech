<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

class CustomersSearchRequest extends FormRequest
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
        $searchColumnValidate = function($attribute, $value, $fail) {
            // 入力の取得
            $input_data = $this->all();

            // 条件に合致しなかったら失敗にする
            if ($input_data['searchColumn'] === 'control_number' && !is_numeric($input_data['keyword'])) {
                $fail('顧客番号で絞り込む場合は数字を入力してください。');
            }
            if ($input_data['searchColumn'] === 'name' && is_numeric($input_data['keyword'])) {
                $fail('名前で絞り込む場合は数字で検索することはできません。');
            }
        };

        return [
            'searchColumn' => ['required', $searchColumnValidate],
        ];
    }

    public function attributes()
    {
        return [
            'searchColumn' => '絞り込み条件',
        ];
    }
}
