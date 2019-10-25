<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class AuthItemChild extends Model
{
    const TYPE_ROUTE = 0;
	const TYPE_PERMISSION = 1;
    const TYPE_ROLE = 2;

    protected $table = 'auth_item_childs';
    public $timestamps = false;

	protected $fillable = [
		'parent', 'child', 'child_type'
    ];

    public function childs()
    {
        return $this->hasMany(AuthItemChild::class, 'parent', 'child');
    }
}
