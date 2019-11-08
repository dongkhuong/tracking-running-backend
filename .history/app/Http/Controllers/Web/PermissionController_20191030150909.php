<?php

namespace App\Http\Controllers\Web;

use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Models\AuthItem;
use App\Http\Models\AuthItemChild;
use App\Http\Requests\Permission as PermissionRequest;
use App\Http\Traits\ApiResponse;

class PermissionController extends Controller
{
    use ApiResponse;

    public function index(Request $request)
    {
        $items = AuthItem::where('type', AuthItem::TYPE_PERMISSION)->get();
        return view('permission.index', compact('items'));
    }

    public function create()
    {
        return view('permission.create');
    }

    public function store(PermissionRequest $request)
    {
        $model = new AuthItem;
        $input = $request->only('name');
        $model->fill($input);
        $model->type = AuthItem::TYPE_PERMISSION;
        $model->save();

        return redirect('permission');
    }

    public function show($name)
    {
        $model = AuthItem::findOrFail($name);

        // All get all Routes active
        $activeRoutes = AuthItemChild::where([
                'parent' => $model->name,
                'child_type' => AuthItemChild::TYPE_ROUTE
            ])
            ->pluck('child')
            ->toArray();

        // All get all Routes in-active
        $routeCollection = \Route::getRoutes();
        $inActiveRoutes = [];

		foreach ($routeCollection as $value) {
            if (!in_array($value->getName(), $activeRoutes) && $value->getName() != '') {
                array_push($inActiveRoutes, $value->getName());
            }
        }

        // Get all permission active
        $activePermissions = AuthItemChild::where([
            'parent' => $model->name,
            'child_type' => AuthItemChild::TYPE_PERMISSION
        ])
        ->pluck('child')
        ->toArray();

        // Get all permission in-active
        $permissions = AuthItem::where([
                'type' => AuthItem::TYPE_PERMISSION
            ])
            ->where('name', '<>', $name)
            ->get();

        $inActivePermissions = [];

        foreach ($permissions as $p) {
            if (!in_array($p->name, $activePermissions)) {
                array_push($inActivePermissions, $p->name);
            }
        }

        return view('permission.show', compact(
            'model',
            'activePermissions',
            'inActivePermissions',
            'inActiveRoutes',
            'activeRoutes'
        ));
    }

    public function update(PermissionRequest $request, $name)
    {
        $model = AuthItem::findOrFail($name);
        $input = $request->only('name');
        $model->fill($input);
        $model->save();

        return redirect('permissions');
    }

    public function addItems(Request $request, $name)
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

        return $this->jsonOut([
			'message' => 'Successful'
		]);
    }

    public function removeItems(Request $request, $name)
    {
        $model = AuthItem::findOrFail($name);

        AuthItemChild::where('parent', $name)
            ->whereIn('child', $request->input('items'))
            ->delete();

        return $this->jsonOut([
			'message' => 'Successful'
		]);
    }

    public function destroy($name)
    {
        $model = AuthItem::findOrFail($name);
        $model->delete($name);
        return redirect('permissions');
    }
}
