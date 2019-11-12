<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{

    public function rules()
    {
        return [
            'content' => 'required',
            'image_route' => 'required',
        ];
    }
}
