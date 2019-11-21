<?php

namespace App\Http\Services;

use App\Http\Models\Challenge;
class ChallengeService extends MainService
{
    use Main;

    public function index($request)
    {
        $model = Challenge::where('group_id',$request);
        return $model;
        
    }
    public function create($request)
    {
        $model = new Challenge;
        $model->fill($request->all());
        $model->save();

        return $model;
    }


    public function getDetail($id)
    {
        $model = Challenge::where('id', $id)->with('policy','group');

        return $model;
    }

}
