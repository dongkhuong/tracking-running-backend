<?php

namespace App\Http\Services;

use App\Http\Models\Group;
use App\Http\Models\Post;
use Illuminate\Support\Facades\DB;

class GroupService extends MainService
{
    use Main;

    public function index()
    {
        $groups = Group::all();
        return $groups;
        
    }
    public function create($request)
    {
        $model = new Group;
        $model->fill($request->all());
        $model->save();

        return $model;
    }


    public function getDetail($id)
    {
        $model = Group::find($id);

        return $model;
    }

    public function update($id, $request)
    {
        $model = Group::findOrFail($id);

        $model->fill($request->all());
        
        $model->save();

        return $model;
    }

    public function delete($id)
    {
        $model = Activity::findOrFail($id);

        return $model->delete();
    }
}
