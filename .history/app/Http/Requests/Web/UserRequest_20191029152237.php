<?php

namespace App\Http\Requests\Web;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Models\User;
use App\Http\Models\AuthItem;
use App\Http\Models\AuthAssignment;

class UserRequest extends FormRequest
{
	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
        $type = auth()->user()->role->authItem->type;
        $roles = AuthItem::whereBetween('type', [++$type, AuthAssignment::TYPE_ROLE_GUEST])->pluck('name')->toArray();

        return [
			'firstname' => 'required|string|min:2|max:64',
            'lastname' => 'required|string|min:2|max:64',
            'email' => 'required|email|unique:users,email,' . $this->route('user'),
			'phone' => 'required|min:9|max:11',
            'status' => 'required|in:' . implode(',', User::getStatuses()),
            'role' => 'required|in:' . implode(',', $roles),
		];
	}
}
