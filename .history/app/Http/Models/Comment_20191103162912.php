<?php

namespace App\Http\Models;

use App\Http\Traits\Filter;
use App\Http\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use Filter;
    use UsesUuid;

    protected $fillable = [
        'content', 'post_id', 'user_id'
    ];
}
