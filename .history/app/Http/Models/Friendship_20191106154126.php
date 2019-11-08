<?php

namespace App\Http\Models;

use App\Http\Traits\Filter;
use App\Http\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Model;

class Friendship extends Model
{
    use Filter;
    use UsesUuid;
    const PENDING = 0;
    const ACCEPTED = 1;
    const DECLINED = 2;
    const BLOCKED = 3;

    protected $fillable = [
    'user_one_id', 'user_two_id', 'status', 'action_user_id'
    ];
}
