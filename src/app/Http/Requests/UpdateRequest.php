<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'date' => ['required', 'date'],
            'weight' => ['required', 'numeric'], 
            'calories' => ['required', 'numeric'],
            'exercise_time' => ['required'],
            'exercise_content' => ['nullable', 'max:120'],
        ];
    }

    public function messages()
    {
        return [
            'date.required' => '日付を入力してください',
            'weight.required' => '体重を入力してください',
            'weight.numeric' => '数字で入力してください',
            'calories.required' => '摂取カロリーを入力してください',
            'calories.numeric' => '数字で入力してください',
            'exercise_time.required' => '運動時間を入力してください',
            'exercise_content.max' => '120文字以内で入力してください',
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $weights = ['weight'];

            foreach ($weights as $field) {
                $value = $this->input($field);

                if ($value === null || $value === '') continue; // 空は required に任せる

                $parts = explode('.', $value);

                // 整数部分4桁チェック
                if (strlen($parts[0]) > 4) {
                    $validator->errors()->add($field, '4桁までの数字で入力してください');
                }

                // 小数部分1桁チェック
                if (isset($parts[1]) && strlen($parts[1]) > 1) {
                    $validator->errors()->add($field, '小数点は1桁で入力してください');
                }
            }
        });
    }    


}
