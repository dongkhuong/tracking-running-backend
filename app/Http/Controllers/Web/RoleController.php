<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Models\AuthItem;
use App\Http\Models\AuthItemChild;
use Illuminate\Support\Facades\Cache;
use App\Http\Requests\Role as RoleRequest;

class RoleController extends Controller
{
    public function index(Request $request)
    {
        $items = AuthItem::where('type', 'like', AuthItem::TYPE_ROLE . '%')
            ->orderBy('type')
            ->get();

        return view('role.index', compact('items'));
    }

    public function create()
    {
        return view('role.create');
    }

    public function store(RoleRequest $request)
    {
        $model = new AuthItem;
        $model->name = $request->input('name');
        $model->type = AuthItem::TYPE_ROLE . $request->input('order');
        $model->save();

        return redirect('role');
    }

    public function show($name)
    {
        $model = AuthItem::findOrFail($name);

        // Get all role active
        $activeRoles = AuthItemChild::where([
            'parent' => $model->name,
            'child_type' => AuthItemChild::TYPE_ROLE
        ])
        ->pluck('child')
        ->toArray();

        // Get all role in-active
        $permissions = AuthItem::where([
                'type' => AuthItem::TYPE_ROLE
            ])
            ->where('name', '<>', $name)
            ->get();

        $inActiveRoles = [];

        foreach ($permissions as $p) {
            if (!in_array($p->name, $activeRoles)) {
                array_push($inActiveRoles, $p->name);
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

        return view('role.show', compact(
            'model',
            'activePermissions',
            'inActivePermissions',
            'inActiveRoles',
            'activeRoles'
        ));


        return view('role.show', compact('model'));
    }

    public function update(RoleRequest $request, $name)
    {
        $model = AuthItem::findOrFail($name);
        $model->name = $request->input('name');
        $model->type = AuthItem::TYPE_ROLE . $request->input('order');
        $model->save();

        return redirect('role');
    }

    public function destroy($name)
    {
        $model = AuthItem::findOrFail($name);
        $model->delete($name);
        // TODO: delete related
        return redirect('role');
    }
}
