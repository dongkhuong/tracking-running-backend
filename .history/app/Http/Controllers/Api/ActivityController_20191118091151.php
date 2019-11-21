<?php

namespace App\Http\Controllers\Api;

use App\Http\Models\Activity;
use App\Http\Requests\Api\ActivityRequest;
use Illuminate\Http\Request;
use App\Http\Services\ActivityService;
use Illuminate\Support\Facades\DB;

class ActivityController extends MainController
{
    protected $activityService;

    public function __construct(ActivityService $activityService)
    {
        $this->activityService = $activityService;
    }

    public function index(Request $request)
    {
        $activities = $this->activityService->getList($request);
        return $this->jsonOut([
            'data' => $activities->paginate(3)
        ]);
    }

    public function getAllActivities(Request $request) 
    {
        $activities = $this->activityService->getList($request);
        return $this->jsonOut([
            'data' => $activities->paginate()
        ]);
    }

    public function store(ActivityRequest $request)
    {
        $activity = $this->activityService->create($request);
        return $this->jsonOut([
            'data' => $activity
        ]);
    }

    public function show($id)
    {
        $activity = $this->activityService->getDetail($id);

        return $this->jsonOut([
            'data' => $activity
        ]);
    }
}
