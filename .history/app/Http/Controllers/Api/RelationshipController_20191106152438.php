<?php

namespace App\Http\Controllers\Api;

use App\Http\Models\Relationship;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Services\RelationshipService;

class RelationshipController extends MainController
{
    protected $relationshipService;

    public function __construct(RelationshipService $relationshipService)
    {
        $this->relationshipService = $relationshipService;
    }

    public function friendRequest(Request $request)
    {
    }
    public function index()
    {
        $addFriend = Relationship::all();
        return $this->jsonOut([
            "data" => $addFriend
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $addFriend = new Relationship;
        $addFriend->status = 0;
        $addFriend->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Http\Models\Relationship  $relationship
     * @return \Illuminate\Http\Response
     */
    public function show(Relationship $relationship)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Http\Models\Relationship  $relationship
     * @return \Illuminate\Http\Response
     */
    public function edit(Relationship $relationship)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Http\Models\Relationship  $relationship
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Relationship $relationship)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Http\Models\Relationship  $relationship
     * @return \Illuminate\Http\Response
     */
    public function destroy(Relationship $relationship)
    {
        //
    }
}
