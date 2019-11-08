<?php

namespace App\Http\Services;

use App\Http\Models\Post;

class PostService extends MainService
{
    use Main;
    public function getList($request)
    {
        if(cuser()->role->item_name == 'SuperAdmin'){
            $posts  = Post::filter([
                ['content', 'like', $request->content],
                ['image_route', 'like',  $request->image_route],
                ['activity_id', 'like',  $request->activity_id],
                ['user_id', 'like',  $request->user_id],
            ])->with('activities.distance');
        } else {
            $posts  = Post::filter([
                ['content', 'like', $request->content],
                ['image_route', 'like',  $request->image_route],
                ['activity_id', 'like',  $request->activity_id],
                ['user_id', 'like',  $request->user_id],
            ])->where('user_id',cuser()->id);
        }
        return $posts;
    }

    public function create($request)
    {
        $model = new Post;
        $model->fill($request->all());
        $model->user_id = cuser()->id;
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
