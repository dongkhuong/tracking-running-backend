<?php

namespace App\Http\Services;

use App\Http\Models\Friend;
use App\Http\Models\Post;
use Illuminate\Support\Facades\DB;

class PostService extends MainService
{
    use Main;
    public function getList()
    {
        $temp = array();
        $listFriends = 
        DB::table('friends')
        ->select()
        ->where([['user_one', '=', cuser()->id],['status', '=', Friend::ACCEPTED]])
        ->orWhere([['user_two', '=', cuser()->id],['status', '=', Friend::ACCEPTED]])
        ->get();
        foreach($listFriends as $friend){
            array_push($temp,$friend->user_one, $friend->user_two);
        }  
        $posts = Post::whereNull('group_id')
            ->where(function ($query) use ($temp) {
                $query->whereIn('user_id', $temp)
                ->orWhere('user_id', cuser()->id);
            })->with('user', 'activity', 'comments')->orderBy('created_at','desc');
        return $posts;
    }

    public function getAllPosts(){
        $posts = Post::where('user_id', cuser()->id)->with('user','activity');
        return $posts;
    }

    public function showPostInGroup($request) {
        $posts = Post::where('group_id', $request)->with('user', 'comments')->orderBy('created_at','desc');
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
}
