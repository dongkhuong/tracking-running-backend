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
            // $like = Like::firstOrCreate(['post_id', $request->post_id],['user_id' => cuser()->id, 'post_id', $request->post_id]);
            // if(DB::table('likes')->where(['user_id', '=', cuser()->id],['post_id', '=', $request->post_id])->get()){
            //     return $this->jsonOut([
            //         "message" => "You have already taken the action to like!"
            //     ]);
            // } else {
            //     $like = new Like;
            //     $like->user_id = cuser()->id;
            //     $like->post_id = $request->post_id;
            //     $like->save();
            //     return $this->jsonOut([
            //         'data' => $like
            //     ]);
            // }
            DB::table('likes')->get();
        } else {
            return $this->jsonOut([
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
}
