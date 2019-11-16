<?php

namespace App\Http\Models;

use App\Http\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Model;

class Challenge extends Model
{
    use UsesUuid;

    protected $fillable = [
        'name', 'description', 'start_date','end_date', 'start_time', 'goal', 'group_id'
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

    public function policy()
    {
        return $this->hasOne(Policy::class);
    }
}
