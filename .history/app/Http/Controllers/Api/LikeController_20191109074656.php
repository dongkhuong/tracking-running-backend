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
        $like->post_id = $request->id;
        $like->save();
    }
}
