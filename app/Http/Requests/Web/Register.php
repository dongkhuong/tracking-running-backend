<?php

namespace App\Http\Requests\Web;

use Illuminate\Foundation\Http\FormRequest;

class Register extends FormRequest
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
			'firstname' => 'required|string|min:2|max:64',
			'lastname' => 'required|string|min:2|max:64',
			'phone' => 'required|min:9|max:11',
			'email' => 'required|email|unique:users',
			'birthday' => 'required|date|date_format:d-m-Y|before:today',
			'password' => 'required|min:6|max:20|required_with:password_confirm|same:password_confirm',
			'password_confirm' => 'required|min:6|max:20',
		];
	}
}
