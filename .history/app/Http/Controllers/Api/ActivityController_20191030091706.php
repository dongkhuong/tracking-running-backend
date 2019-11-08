<?php

namespace App\Http\Controllers\Api;

use App\Http\Models\Activity;
use Illuminate\Http\Request;
use App\Http\Services\ActivityService;

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
            'data' => $activities->paginate()
        ]);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($activity)
    {
        $activity = $this->activityService->getDetail($activity);

        return $this->jsonOut([
            'data' => $activity
        ]);
    }

    public function edit(Activity $activity)
    {
        //
    }

    public function update(Request $request, Activity $activity)
    {
        //
    }

    public function destroy(Activity $activity)
    {
        //
    }
}
