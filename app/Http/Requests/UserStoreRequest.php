<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if ('admin' == $this->role) {
            return check_value($this->user()->role, 'super_admin');
        } else {
            return check_value($this->user()->role, 'admin|super_admin');
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nickname' => 'required',
            'name' => 'required',
            'password' => 'required',
            'repeat' => 'required|same:password',
            'role' => 'required',
        ];
    }
}
