<?php

namespace App\Http\Models;

use App\Http\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
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

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function challenge() 
    {   
        return $this->hasOne(Challenge::class);
    }

}
