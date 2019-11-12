<?php

namespace App\Http\Controllers\Api;

use App\Http\Models\Like;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Models\Post;
use Illuminate\Support\Facades\DB;

class LikeController extends MainController
{
    public function addLike(Request $request) 
    {
        $find_post_id = Post::where('id', '=', $request->post_id)->count();
        if($find_post_id > 0) {
            $isLike = DB::table('likes')->where([['post_id', '=', $request->post_id], ['user_id', '=', cuser()->id]])->count();
            if($isLike > 0) {
                return $this->jsonOut([
                    'business_code' => 0,
                    'message' => "You have already done this action before!"
                ]);
            } else {
                $like = new Like;
                $like->user_id = cuser()->id;
                $like->post_id = $request->post_id;
                $like->save();
                return $this->jsonOut([
                    'business_code' => 1,
                    'data' => $like
                ]);
            }
        } else {
            return $this->jsonOut([
                'business_code' => 2,
                'message' => "post_id can not be found"
            ]);
        }
        
    }

    public function deleteLike(Request $request)
    {
        $like = Like::where([['user_id',cuser()->id],['post_id', $request->id]])->delete();
        return $this->jsonOut([
            'business_code' => $like
        ]);
    }

    public function checkLike()
    {
        if(DB::table('likes')->select('post_id')->where('user_id', '=', cuser()->id)->exists()) {
            $likes = DB::table('likes')->select('post_id')->where('user_id', '=', cuser()->id)->paginate();
            return $this->jsonOut([
                'business_code' => 1,
                'data' => $likes
            ]);
        } else {
            return $this->jsonOut([
                'business_code' => 0,
                'message' => 'You still do not like any post!'
            ]);
        }
    }

    public function getSumLikesByPost()
    {
        $sumLikes = DB::table('likes')->select('COUNT(*)')->groupBy('post_id');
        return $sumLikes;
    }
    public function countLikes(Request $request)
    {
        $countLikes = Like::where('post_id', '=', $request->post_id)->with('user');
        if($countLikes->count() > 0){
            return $this->jsonOut([
                'business_code' => 1,
                'sumOfLikes' => $countLikes->count(),
                'userLikes' => $countLikes->get()
            ]);
        } else {
            return $this->jsonOut([
                'business_code' => 0,
                'message' => 'This post has no likes yet!'
            ]);
        }

    }
}
