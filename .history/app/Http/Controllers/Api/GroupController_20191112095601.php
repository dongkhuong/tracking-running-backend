<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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
        return $this->jsonOut([
            'data' => $groups
        ])
    }

    public function create(Request $request)
    {

    }

    public function store(Request $request)
    {
        $group = $this->groupService->create($request);
        return $this->jsonOut([
            "data" => $group
        ]);
    }

    public function show($id)
    {
        //
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
