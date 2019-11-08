<?php

namespace App\Http\Services;

use App\Http\Models\Relationship;

class RelationshipService extends MainService
{
    use Main;
    public function friendRequest($request)
    {
        $model = new Relationship;
        $model->fill($request->all());
        $model->user_one_id = cuser()->id;
        $model->status = Relationship::PENDING;
        $model->action_user_id = cuser()->id;        
        $model->save();
        return $model;
    }

    // public function getDetail($id)
    // {
    //     $model = Activity::findOrFail($id);

    //     return $model;
    // }

    // public function update($id, $request)
    // {
    //     $model = Activity::findOrFail($id);

    //     $model->fill($request->all());
    //     $model->save();

    //     return $model;
    // }

    // public function delete($id)
    // {
    //     $model = Activity::findOrFail($id);

    //     return $model->delete();
    // }
}
