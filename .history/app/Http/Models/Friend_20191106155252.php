<?php

namespace App\Http\Models;

use App\Http\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Model;

class Friend extends Model
{
    use UsesUuid;

    protected $fillable = [
        'user_one', 'user_two', 'status', 'action_user'
    ];
}
