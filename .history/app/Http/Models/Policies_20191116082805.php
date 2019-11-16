<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Policies extends Model
{
    protected $fillable = [
        'overview', 'rewards', 'add_infos', 'rules', 'challenge_id'
    ];

    public function challenge()
    {
        return $this->belongsTo(Challenge::class);
    }

}
