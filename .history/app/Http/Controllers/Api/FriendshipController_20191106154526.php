<?php

namespace App\Http\Controllers\Api;

use App\Http\Models\Friendship;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FriendshipController extends MainController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $friendship = Friendship::all();
        return $this->jsonOut([
            "data" => $friendship
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
        $friendship = new Friendship;
        $friendship->user_one_id = "kjasdkjhasdjhasd";
        $friendship->user_two_id = "jklhjasdlasdkdj";
        $friendship->action_user_id = "klqwlejoiklncyugasd";
        $friendship->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Http\Models\Friendship  $friendship
     * @return \Illuminate\Http\Response
     */
    public function show(Friendship $friendship)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Http\Models\Friendship  $friendship
     * @return \Illuminate\Http\Response
     */
    public function edit(Friendship $friendship)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Http\Models\Friendship  $friendship
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Friendship $friendship)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Http\Models\Friendship  $friendship
     * @return \Illuminate\Http\Response
     */
    public function destroy(Friendship $friendship)
    {
        //
    }
}
