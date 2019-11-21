<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GroupController extends Controller
{
    protected $groupService;

    public function __construct(GroupService $groupService)
    {
        $this->groupService = $groupService;
    }

    public function index()
    {
        $groups = $this->groupService->index();
        return view('group.index', compact('groups'));
    }

    // public function store(Request $request)
    // {
    //     $group = $this->groupService->create($request);
    //     return $this->jsonOut([
    //         'business_code' => 1,
    //         'data' => $group
    //     ]);
    // }

    // public function show($id)
    // {
    //     $group= $this->groupService->getDetail($id);
    //     if($group!= null) {
    //         return $this->jsonOut([
    //             'business_code' => 1,
    //             'data' => $group
    //         ]);
    //     } else {
    //         return $this->jsonOut([
    //             'business_code' => 0,
    //             'message' => 'Id not found'
    //         ]);
    //     }   

    // }
}
