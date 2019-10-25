<?php

namespace App\Http\Requests\Api;

class VerifyPhoneRequest extends Form
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
            'device_name' => 'required',
            'mac_address' => ['required', 'regex:/^(([0-9a-fA-F]{2}-){5}|([0-9a-fA-F]{2}:){5})[0-9a-fA-F]{2}$/']
        ];
    }
}
