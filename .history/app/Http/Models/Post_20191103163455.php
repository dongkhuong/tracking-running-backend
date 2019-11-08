<?php

namespace App\Http\Models;

use App\Http\Traits\Filter;
use App\Http\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use Filter;
    use UsesUuid;

    protected $fillable = [
        'content', 'image_route', 'activity_id', 'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function activity()
    {
        return $this->belongsTo(Activity::class, 'activity_id', 'id');
    }
}
