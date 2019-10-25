<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Role extends FormRequest
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
			'name' => 'required|min:3|max:32|notin:SuperAdmin,Guest',
			'order' => 'required|integer|between:1,8',
		];
	}
}
