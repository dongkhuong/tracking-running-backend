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
        $friend = Friend::all();
        return $this->jsonOut([
            "data" => $friend
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
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
        //
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

    public function listAllUser() 
    {
        $temp = array();
        $listFriends = DB::table('friends')->select('user_two')->where([['user_one', '=', cuser()->id],['status', '=', Friend::ACCEPTED]])->get();
        foreach($listFriends as $friend){
            array_push($temp,$friend->user_two);
        }
        // if($temp) {
        //     return $temp;
        // }
        $users = DB::table('users')->select('id','firstname', 'lastname', 'avatar')->whereNotIn('id', $temp)->get();
        return $this->jsonOut([
            "data" => $users
        ]);
        // ->where('id', '<>', cuser()->id)
    }
}
