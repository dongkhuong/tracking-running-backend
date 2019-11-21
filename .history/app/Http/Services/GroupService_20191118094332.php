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
        $groups = Group::paginate(2);
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
