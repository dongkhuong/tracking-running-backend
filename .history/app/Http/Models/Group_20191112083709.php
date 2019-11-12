<?php

namespace App\Http\Models;

use App\Http\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use UsesUuid;

    protected $fillable = [
        'name', 'description', 'image', 'numberOfRunner'
    ];

    protected $hidden = [
        'pivot'
    ];
}
