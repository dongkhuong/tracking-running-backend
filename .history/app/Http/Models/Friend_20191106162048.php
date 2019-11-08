<?php

namespace App\Http\Models;

use App\Http\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Model;

class Friend extends Model
{
    const PENDING = 0;
    const ACCEPTED = 1;
    const DECLINED = 2;
    const BLOCKED = 3;
    protected $fillable = [
        'user_one', 'user_two', 'status', 'action_user'
    ];
}
