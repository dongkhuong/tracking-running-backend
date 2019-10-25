<?php

namespace App\Http\Requests\Api;

class VerifyCodeRequest extends Form
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'phone' => 'required|min:9|max:11',
            'code' => 'required|min:6|max:6'
        ];
    }
}
