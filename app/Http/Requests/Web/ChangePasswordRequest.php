<?php

namespace App\Http\Requests\Web;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Models\User;

class ChangePasswordRequest extends FormRequest
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
            'new_password' => 'required|min:6|max:20|required_with:new_password_confirm|same:new_password_confirm',
			'new_password_confirm' => 'required|min:6|max:20',
		];
	}
}
