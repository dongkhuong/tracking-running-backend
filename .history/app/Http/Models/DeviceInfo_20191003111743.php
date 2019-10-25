<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\UsesUuid;

class DeviceInfo extends Model
{
    use UsesUuid;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'user_id', 'device_token', 'name', 'os', 'brand', 'ip'
	];
}
