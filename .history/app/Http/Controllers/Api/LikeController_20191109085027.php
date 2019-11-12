<?php

namespace App\Http\Controllers\Api;

use App\Http\Models\Like;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Models\Post;

class LikeController extends MainController
{
    public function addLike(Request $request) 
    {
        $find_post_id = Post::where('id', '=', $request->post_id)->count();
        if($find_post_id > 0) {
            $like = new Like;
            $like->user_id = cuser()->id;
            $like->post_id = $request->post_id;
            $like->save();
            return $this->jsonOut([
                "data" => $like
            ]);
        } else {
            return $this->jsonOut([
                "message" => "post_id can not be found"
            ]);
        }
        
    }

    public function deleteLike(Request $request)
    {
        // $like = DB::table('likes')->where('user_id','=','12a26f6127494505adf4c05dab324aaf')->delete();
        $like = Like::where('user_id','12a26f6127494505adf4c05dab324aaf')->delete();
        return $this->jsonOut([
            'business_code' => $request->id
        ]);
    }
}
