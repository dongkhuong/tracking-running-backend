<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Policies extends Model
{
    protected $fillable = [
        'overview', 'rewards', 'add_infos', 'rules', 'challenge_id'
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
