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
        $find_post_id = Post::find($request->post_id);
        // $like = new Like;
        // $like->user_id = cuser()->id;
        // $like->post_id = $request->post_id;
        // $like->save();
        // return $this->jsonOut([
        //     "data" => $like
        // ]);
        // if(hasValue($find_post_id)){
        //     return $find_post_id;
        // } else{
        //     return "Aaa";
        // }
        if(!isEmpty($find_post_id)) {
            return $find_post_id;
        } else {
            return 0
        }
       
    }

    public function deleteLike(Request $request)
    {
        $like = DB::table('likes')->where('user_id','=','12a26f6127494505adf4c05dab324aaf')->delete();
        return $this->jsonOut([
            'business_code' => $request->id
        ]);
    }
}
