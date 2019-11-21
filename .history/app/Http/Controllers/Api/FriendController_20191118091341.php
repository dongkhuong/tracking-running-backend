<?php

namespace App\Http\Controllers\Api;

use App\Http\Models\Friend;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\FriendRequest;
use App\Http\Services\FriendService;
use Illuminate\Support\Facades\DB;

class FriendController extends MainController
{
    protected $friendService;

    public function __construct(FriendService $friendService)
    {
        $this->friendService = $friendService;
    }

    public function index()
    {
        $temp = array();
        $listFriends = 
        DB::table('friends')
        ->select()
        ->where([['user_one', '=', cuser()->id],['status', '=', Friend::ACCEPTED]])
        ->orWhere([['user_two', '=', cuser()->id],['status', '=', Friend::ACCEPTED]])
        ->orWhere([['user_one', '=', cuser()->id],['status', '=', Friend::PENDING]])
        ->orWhere([['user_two', '=', cuser()->id],['status', '=', Friend::PENDING]])
        ->get();
        foreach($listFriends as $friend){
            array_push($temp,$friend->user_one, $friend->user_two);
        }
        $users = DB::table('users')->select('id','firstname', 'lastname', 'avatar')->where('id', '<>', cuser()->id)->whereNotIn('id', $temp)->get();
        return $this->jsonOut([
            'data' => $users
        ]);
    }

    public function pendingRequest()
    {
        $temp= array();
        $pendingRequests = DB::table('friends')
        ->where([['user_one', '=', cuser()->id], ['status', '=', 0],['action_user', '<>', cuser()->id]])
        ->orWhere([['user_two', '=', cuser()->id], ['status', '=', 0],['action_user', '<>', cuser()->id]])
        ->get();
        foreach($pendingRequests as $pendingRequest){
            array_push($temp, $pendingRequest->action_user);
        }
        $infoUsers = DB::table('users')
        ->select('id', 'firstname', 'lastname', 'avatar')
        ->whereIn('id', $temp)
        ->get();
        return $this->jsonOut([
            'data' => $infoUsers 
        ]); 
    }
    
    public function deletePendingRequest()
    {
        $pendingRequests = DB::table('friends')
        ->where([['user_one', '=', cuser()->id], ['status', '=', 0],['action_user', '<>', cuser()->id]])
        ->orWhere([['user_two', '=', cuser()->id], ['status', '=', 0],['action_user', '<>', cuser()->id]])
        ->delete();
    }
    public function acceptFriend(FriendRequest $request)
    {
        $acceptFriend = DB::table('friends')
        ->where([['user_one', '=', $request->all()],['user_two', '=', cuser()->id]])
        ->update(['status' => 1, 'action_user' => cuser()->id]);
        return $acceptFriend;
    }

    public function store(Request $request)
    {
        $friend = $this->friendService->create($request);
        
        return $this->jsonOut([
            'data' => $friend
        ]);
    }
}
