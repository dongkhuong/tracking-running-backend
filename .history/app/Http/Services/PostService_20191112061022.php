<?php

namespace App\Http\Services;

use App\Http\Models\Friend;
use App\Http\Models\Post;
use Illuminate\Support\Facades\DB;

class PostService extends MainService
{
    use Main;
    public function getList($request)
    {
        $temp = array();
        $listFriends = 
        DB::table('friends')
        ->select()
        ->where([['user_one', '=', cuser()->id],['status', '=', Friend::ACCEPTED],['activity_id', '<>', null]])
        ->orWhere([['user_two', '=', cuser()->id],['status', '=', Friend::ACCEPTED],['activity_id', '<>', null]])
        ->get();
        foreach($listFriends as $friend){
            array_push($temp,$friend->user_one, $friend->user_two);
        }
        $posts = Post::whereIn('user_id', $temp)->orWhere('user_id', cuser()->id)->with('user', 'activity', 'comments');
        return $posts;
    }

    public function getAllPosts(){
        $posts = Post::where('user_id', cuser()->id)->with('user','activity');
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
