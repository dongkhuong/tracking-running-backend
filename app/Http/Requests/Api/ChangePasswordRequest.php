<?php

namespace App\Http\Requests\Api;

class ChangePasswordRequest extends Form
{
	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'old_password' => 'required|min:6|max:20',
			'new_password' => 'required|min:6|max:20',
		];
	}
}
