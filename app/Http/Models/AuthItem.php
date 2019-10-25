<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use App\Http\Models\AuthAssignment;

class AuthItem extends Model
{
	const TYPE_ROUTE = 0;
	const TYPE_PERMISSION = 1;
	const TYPE_ROLE = 2;

	protected  $primaryKey = 'name';
    public $incrementing = false;
    public $timestamps = false;

	protected $fillable = [
		'name'
    ];

    public function getOrder()
    {
        return substr($this->type, 1);
    }

    public static function listRoles()
    {
        return static::whereBetween('type', [AuthAssignment::TYPE_ROLE_SUPER_ADMIN, AuthAssignment::TYPE_ROLE_GUEST])
            ->where('name', '!=', AuthAssignment::ROLE_SUPER_ADMIN)
            ->pluck('name')
            ->toArray();
    }
}
