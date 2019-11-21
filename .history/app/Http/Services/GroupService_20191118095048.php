<?php

namespace App\Http\Services;

use App\Http\Models\Group;
use App\Http\Models\Post;
use Illuminate\Support\Facades\DB;

class GroupService extends MainService
{
    use Main;

    public function index($request)
    {
        $groups = Group::filter([
            ['name', 'like', $request->name],
            ['description', 'like',  $request->description],
            ['address', '=',  $request->address]]);
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

}
