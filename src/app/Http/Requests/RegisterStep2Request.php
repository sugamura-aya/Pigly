<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterStep2Request extends FormRequest
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
            'current_weight' => ['required'],
            'target_weight'  => ['required'],    
        ];
    }

    public function messages(): array
    {
        return [
            'current_weight.required' => '現在の体重を入力してください',
            'target_weight.required'  => '目標の体重を入力してください',
        ];
    }


    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $weights = ['current_weight', 'target_weight'];

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
