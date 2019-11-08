<?php

namespace App\Http\Controllers\Api;

use App\Http\Models\Friend;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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
        ->get();
        foreach($listFriends as $friend){
            array_push($temp,$friend->user_one, $friend->user_two);
        }
        $users = DB::table('users')->select('id','firstname', 'lastname', 'avatar')->where('id', '<>', cuser()->id)->whereNotIn('id', $temp)->get();
        return $this->jsonOut([
            "data" => $users
        ]);
    }

    public function pendingRequest()
    {
        $pendingRequest = DB::table('friends')
        ->where([['user_one', '=', cuser()->id], ['status', '=', 0],['action_user', '<>', cuser()->id]])
        ->orWhere([['user_two', '=', cuser()->id], ['status', '=', 0],['action_user', '<>', cuser()->id]])
        ->get();
        return [
            "data" => $pendingRequest
        ];
    }
    
    public function acceptFriend(Request $request)
    {
        $acceptFriend = $this->friendService->update($request);
    }
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $friend = $this->friendService->create($request);
        
        return $this->jsonOut([
            "data" => $friend
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Http\Models\Friend  $friend
     * @return \Illuminate\Http\Response
     */
    public function show(Friend $friend)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Http\Models\Friend  $friend
     * @return \Illuminate\Http\Response
     */
    public function edit(Friend $friend)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Http\Models\Friend  $friend
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Friend $friend)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Http\Models\Friend  $friend
     * @return \Illuminate\Http\Response
     */
    public function destroy(Friend $friend)
    {
        //
    }

}
