<?php

namespace App\Http\Services;

use App\Http\Models\Comment;
use App\Http\Models\Post;
use Illuminate\Support\Facades\DB;

class CommentService extends MainService
{
    use Main;

    public function getAllComments($request)
    {
        $comments = Comment::where('post_id',$request->all())->with('user');
        return $comments;
    }

    public function create($request)
    {
        $model = new Comment;
        $model->fill($request->all());
        $model->user_id = cuser()->id;
        $model->save();

        return $model;
    }
    
}
