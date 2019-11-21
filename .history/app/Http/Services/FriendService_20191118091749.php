<?php

namespace App\Http\Services;

use App\Http\Models\Friend;

class FriendService extends MainService
{
    use Main;

    public function create($request)
    {
        $model = new Friend;
        $model->fill($request->all());
        $model->user_one = cuser()->id;
        $model->status = Friend::PENDING;
        $model->action_user = cuser()->id;
        $model->save();

        return $model;
    }
    
}
