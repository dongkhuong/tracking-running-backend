<?php

namespace App\Http\Models;

use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Access\AuthorizationException;

class AuthAssignment extends Model
{
    public $timestamps = false;

    const ROLE_GUEST = 'Guest';
    const ROLE_USER = 'User';
    const ROLE_SUPER_ADMIN = 'SuperAdmin';

    const PERMISSION_GUEST = 'GuestPermission';
    const PERMISSION_USER = 'UserPermission';

    const TYPE_ROLE_SUPER_ADMIN = 20;
    const TYPE_ROLE_USER = 28;
    const TYPE_ROLE_GUEST = 29;
    const TYPE_PERMISSION = 1;


    protected $fillable = [
        'item_name', 'user_id'
    ];

    /**
     * Relate to role
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function authItem()
    {
        return $this->hasOne(AuthItem::class, 'name', 'item_name');
    }

    public static function getRolesByUserId($userId = null)
    {
        if (is_null($userId)) {
            if ($user = cuser()) {
                $userId = $user->id;
            } else {
                return [self::ROLE_GUEST];
            }
        }

        return static::where('user_id', $userId)->pluck('item_name')->toArray();
    }

    public static function hasPermissionByRole($role, $userId = null)
    {
        return in_array($role, static::getRolesByUserId($userId));
    }

    public static function hasSupperAdmin()
    {
        return in_array(self::ROLE_SUPER_ADMIN, static::getRolesByUserId());
    }

    public static function hasAccess($userId = null)
    {
        $roles = static::getRolesByUserId($userId);
        if (in_array(static::ROLE_SUPER_ADMIN, $roles)) {
            return true;
        }

        $allRoutes = Cache::get('roles', []);
        $accessRoutes = [];
        foreach($roles as $role) {
            $accessRoutes = array_values(array_unique(array_merge($accessRoutes, $allRoutes[$role])));
        }

        $currentRoute = \Route::current();
        return in_array($currentRoute->getName(), $accessRoutes);
    }
}
