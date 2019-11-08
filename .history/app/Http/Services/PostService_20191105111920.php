<?php

namespace App\Http\Services;

use App\Http\Models\Post;

class PostService extends MainService
{
    use Main;
    public function getList($request)
    {
        $posts = Post::select('posts.*')->where('user_id', cuser()->id)->with('user','activity');
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
