<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Models\Group;
use App\Http\Services\GroupService;
use Illuminate\Support\Facades\DB;

class GroupController extends MainController
{
    protected $groupService;

    public function __construct(GroupService $groupService)
    {
        $this->groupService = $groupService;
    }

    public function index()
    {
        $groups = $this->groupService->index();
        if($groups->count() > 0) {
            return $this->jsonOut([
                'business_code' => 1,
                'data' => $groups
            ]);
        } else {
            return $this->jsonOut([
                'business_code' => 0,
                'message' => 'No record in this table'
            ]);
        }

    }

    public function create(Request $request)
    {

    }

    public function store(Request $request)
    {
        $group = $this->groupService->create($request);
        return $this->jsonOut([
            'business_code' => 1,
            'data' => $group
        ]);
    }

    public function show($id)
    {
        $group= $this->groupService->getDetail($id);
        if($group!= null) {
            return $this->jsonOut([
                'business_code' => 1,
                'data' => $group
            ]);
        } else {
            return $this->jsonOut([
                'business_code' => 0,
                'message' => 'Id not found'
            ]);
        }   

    }

    public function addCurrentUserIntoGroup(Request $request) 
    {
        $group = Group::find($request->group_id);
        if($group!=null) {
            $cUser = cuser()->groups()->attach($group);
            return $this->jsonOut([
                'business_code' => 1,
                'message' => "Add successfully!"
            ]);
        } else {
            return $this->jsonOut([
                'business_code' => 0,
                'message' => 'Id group not found'
            ]);
        }
    }

    public function checkJoinIntoGroup(Request $request){
        $cUser = DB::table('group_user')->where('user_id', cuser()->id)->where('group_id',$request->group_id)->count();
        if($cUser > 0){
            return $this->jsonOut([
                "business_code" => 1,
                "message" => "The record existed in this table"
            ]);
        } else {
            return $this->jsonOut([
                "business_code" => 0,
                "message" => "The record doesn't exists in this table"
            ]);
        }

    }

    public function deleteJoin(Request $request) 
    {
        $group = Group::find($request->group_id);
        if($group!=null) {
            $cUser = cuser()->groups()->detach($request->group_id);
            return $this->jsonOut([
                'business_code' => 1,
                'message' => "Leave group successfully!"
            ]);
        } else {
            return $this->jsonOut([
                "business_code" => 0,
                "message" => "The record doesn't exists in this table"
            ]);
        }
    }

    public function countRunners(Request $request){   
        $count_runners = DB::table('group_user')->select('group_id',DB::raw('count(*) as total'))->groupBy('group_id')->pluck('total', 'group_id');
        if($count_runners->count() > 0) {
            return $this->jsonOut([
                'business_code' => 1,
                'count_runners' => $count_runners
            ]);
        } else {
            return $this->jsonOut([
                'business_code' => 0,
                'message' => "No records in this table"
            ]);
        }       
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
