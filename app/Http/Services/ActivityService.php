<?php

namespace App\Http\Services;

use App\Http\Models\Activity;
use App\Http\Models\AuthAssignment;

class ActivityService extends MainService
{
    use Main;
    public function getList($request)
    {
        if(cuser()->role->item_name == 'SuperAdmin'){
            $activity  = Activity::filter([
                ['distance', 'like', $request->distance],
                ['duration', 'like',  $request->duration],
                ['calories', '=',  $request->calories],
                ['average_pace', 'like',  $request->average_pace],
                ['average_speed', 'like',  $request->average_speed],
                ['max_speed', '=',  $request->max_speed],
                ['start_time', 'like',  $request->start_time],
                ['date', 'like',  $request->date],
            ])->orderBy('created_at','desc');
        } else {
            $activity  = Activity::filter([
                ['distance', 'like', $request->distance],
                ['duration', 'like',  $request->duration],
                ['calories', '=',  $request->calories],
                ['average_pace', 'like',  $request->average_pace],
                ['average_speed', 'like',  $request->average_speed],
                ['max_speed', '=',  $request->max_speed],
                ['start_time', 'like',  $request->start_time],
                ['date', 'like',  $request->date],
            ])->where('user_id',cuser()->id)->orderBy('created_at','desc');
        }
        return $activity;
    }

    public function create($request)
    {
        $model = new Activity;
        $model->fill($request->all());
        $model->user_id = cuser()->id;
        $model->save();

        return $model;
    }

    public function getDetail($id)
    {
        $model = Activity::findOrFail($id);

        return $model;
    }

    public function delete($id)
    {
        $model = Activity::findOrFail($id);

        return $model->delete();
    }
}
