<?php


namespace App\Http\Models;

use App\Http\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use UsesUuid;

    protected $fillable = [
        'name', 'upload_path'
    ];
}
