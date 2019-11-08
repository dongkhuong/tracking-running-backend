<?php

namespace App\Http\Services;

use App\Http\Models\Comment;
use App\Http\Models\Post;
use Illuminate\Support\Facades\DB;

class CommentService extends MainService
{
    use Main;

    public function getAllPosts(){
        $posts = Post::where('user_id', cuser()->id)->with('user','activity');
        return $posts;
    }

    public function create($request)
    {
        $model = new Comment;
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
