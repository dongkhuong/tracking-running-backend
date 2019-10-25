<?php

namespace App\Http\Requests\Api;

class ChangeAvatarRequest extends Form
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'image' => 'required|mimes:jpeg,jpg,png'
        ];
    }
}
