<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class FriendRequest extends FormRequest
{
    public function rules()
    {
        return [
            'user_one' => 'required',
        ];
    }
}
