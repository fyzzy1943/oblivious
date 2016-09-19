<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RuleStoreRequest extends FormRequest
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
            'serial' => 'required|unique:update_rules,serial',
        ];
    }

    public function messages()
    {
        return [
            'serial.unique' => '此序列号规则已存在',
        ];
    }
}
