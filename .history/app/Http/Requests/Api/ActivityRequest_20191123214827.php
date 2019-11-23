<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class ActivityRequest extends FormRequest
{
    public function rules()
    {
        return [
            'distance' => 'required',
            'duration' => 'required',
            'calories' => 'required',
            'start_time' => 'required',
            'date' => 'required'
        ];
    }
}
