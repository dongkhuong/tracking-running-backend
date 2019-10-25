<?php

namespace App\Http\Requests\Api;

class LoginRequest extends Form
{
	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'email' => 'required|email',
            'password' => 'required|min:6|max:20',
            'device_token' => 'required',
            'name' => 'required',
            'os' => 'required',
            'brand' => 'required',
            'ip' => 'required',
		];
	}
}
