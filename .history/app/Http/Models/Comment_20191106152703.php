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

    public function post()
    {
        return $this->belongsTo(Post::class, 'post_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
