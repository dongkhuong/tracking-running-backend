<?php

namespace App\Http\Requests\Api;

class UserRequest extends Form
{
	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'firstname' => 'required|string|min:2|max:64',
			'lastname' => 'required|string|min:2|max:64',
			'phone' => 'required|min:9|max:11',
			'birthday' => 'required|date|date_format:d-m-Y|before:today',
			'gender' => 'required|integer|between:0,2'
		];
	}
}
