<?php

namespace App\Http\Models;

use App\Http\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Model;

class Challenge extends Model
{
    use UsesUuid;

    protected $fillable = [
        'name', 'description', 'address', 'image', 'number_runner'
    ];

    protected $hidden = [
        'pivot'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function groups()
    {
        return $this->belongsTo(Group::class);
    }

}
