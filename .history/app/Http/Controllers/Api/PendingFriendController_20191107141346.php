<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Models\Friend;
use Illuminate\Support\Facades\DB;

class PendingFriendController extends MainController
{
    public function pendingRequest() 
    {
        $pendingRequest = DB::table('friends')
        ->where([['user_one', '=', cuser()->id], ['status', '=', 0],['action_user', '<>', cuser()->id]])
        ->orWhere([['user_two', '=', cuser()->id], ['status', '=', 0],['action_user', '<>', cuser()->id]])
        ->get();
    }
}
