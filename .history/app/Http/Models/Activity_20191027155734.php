<?php

namespace App\Http\Models;

use App\Http\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use UsesUuid;

    protected $fillable = [
		'distance', 'duration', 'calories', 'average_pace', 'average_speed', 'max_speed', 'max_speed', 'start_time', 'date', 'user_id', 'route_id'
	];
}
