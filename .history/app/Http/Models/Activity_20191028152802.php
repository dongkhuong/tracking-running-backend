<?php

namespace App\Http\Models;

use App\Http\Traits\Filter;
use App\Http\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use UsesUuid;
    use Filter;

    protected $fillable = [
		'distance', 'duration', 'calories', 'average_pace', 'average_speed', 'max_speed', 'max_speed', 'start_time', 'date', 'user_id'
  ];
    public function user()
    {
        return $this->belongsTo(User::class,'user_id', 'id');
    }
}
