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
            ['distance', 'like', $request->name],
            ['duration', 'like',  $request->description],
            ['calories', '=',  $request->address]]);
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
