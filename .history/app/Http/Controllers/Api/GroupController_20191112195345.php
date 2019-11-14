<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Models\Group;
use App\Http\Services\GroupService;

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
