<?php

namespace App\Http\Models;

use App\Http\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Model;

class Challenge extends Model
{
    use UsesUuid;

    protected $fillable = [
        'name', 'description', 'date', 'time', 'goal', 'reward', 'activity_id', 'group_id'
    ];

    protected $hidden = [
        'pivot'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function group()
    {
        return $this->belongsTo(Group::class);
    }

}
