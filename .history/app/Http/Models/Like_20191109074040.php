<?php

namespace App\Http\Models;

use App\Http\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use UsesUuid;

    protected $fillable = [
        'user_id', 'post_id'
    ];
}
