<?php

namespace App\Http\Controllers\Api;

use App\Http\Models\Like;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LikeController extends MainController
{
    public function addLike(Request $request) 
    {
        $like = new Like;
        $like->user_id = cuser()->id;
        $like->post_id = $request->post_id;
        $like->save();
        return $this->jsonOut([
            "data" => $like
        ]);
    }

    public function deleteLike(Request $request)
    {
        // $like = DB::table('likes')->where([['user_id', '=', cuser()->id],['post_id', '=', $request->id]])->delete();
        return $this->jsonOut([
            'business_code' => $request->id
        ]);
    }
}
