<?php

namespace App\Http\Requests\Api;

class RolePermission extends Form
{
	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'role_id' => 'required|exists:roles,id',
			'items.*' => 'required|exists:permissions,id',
		];
	}
}
