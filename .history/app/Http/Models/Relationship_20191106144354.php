<?php

namespace App\Http\Models;

use App\Http\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Model;

class Relationship extends Model
{
    use UsesUuid;
    const PENDING = 0;
    const ACCEPTED = 1;
    const DECLINED = 2;
    const BLOCKED = 3;

    protected $fillable = [
        'user_one_id', 'user_two_id', 'status', 'action_user_id'
    ];

}
