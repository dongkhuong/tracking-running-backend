<?php

namespace App\Http\Controllers\Web;

use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Models\AuthItem;
use App\Http\Models\AuthItemChild;
use App\Http\Models\AuthAssignment;
use App\Http\Traits\ApiResponse;
use Illuminate\Support\Facades\Cache;

class ItemChildController extends Controller
{
    use ApiResponse;

    public function add(Request $request, $name)
    {
        $model = AuthItem::findOrFail($name);

        DB::beginTransaction();
        if($request->input('items')) foreach ($request->input('items') as $item) {
            $authItemChild = new AuthItemChild;
            $authItemChild->fill($item);
            $authItemChild->parent = $model->name;

            if (!$authItemChild->save()) {
                DB::rollBack();

                return $this->jsonOut([
                    'statusCode' => 500,
                    'message' => 'Successful'
                ]);
            }
        }
        DB::commit();
        $this->caching();

        return $this->jsonOut([
			'message' => 'Successful'
		]);
    }

    public function remove(Request $request, $name)
    {
        $model = AuthItem::findOrFail($name);
        $childs = array_pluck($request->input('items'), 'child');

        AuthItemChild::where('parent', $name)
            ->whereIn('child', $childs)
            ->delete();

        $this->caching();

        return $this->jsonOut([
			'message' => 'Successful'
		]);
    }

    private function caching()
    {
        // Get all roles
        $roles = AuthItem::listRoles();
        $rolesHasChild = AuthItemChild::whereIn('parent', $roles)->get();

        $objRoles = [];
        foreach ($roles as $role) {
            $objRoles[$role] = [];
        }

        foreach ($rolesHasChild as $roleHasChild) {
            $objRoles[$roleHasChild->parent] = $this->getRoutes($roleHasChild);
        }

        Cache::forever('roles', $objRoles);
    }

    private function getRoutes($role)
    {
        $routes = [];
        $childs = $role->childs;

        if($childs) {
            foreach($childs as $child) {
                if ($child->child_type === AuthItemChild::TYPE_ROUTE) {
                    array_push($routes, $child->child);
                } else {
                    $routes = array_values(array_unique(array_merge($routes, $this->getRoutes($child))));
                }
            }
        }

        return $routes;
    }
}
