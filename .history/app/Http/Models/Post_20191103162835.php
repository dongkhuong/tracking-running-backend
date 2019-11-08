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
}
