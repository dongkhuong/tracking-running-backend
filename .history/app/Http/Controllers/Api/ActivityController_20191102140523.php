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

    public function create()
    {
        
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

    public function getWeek() {
        $weeks = DB::select(DB::raw('SELECT WEEK(date) as week, count(*) from activities'));
        return $this->jsonOut([
            'data' => $weeks
        ]);
    }
    public function getActivityByWeek($id) {
        // $activities = DB::select(DB::raw('SELECT * from activities WHERE WEEK(date) = 40'));
        $activities = DB::table('activities')->select(DB::raw('distance, calories, date'))->whereRaw('WEEK(date) = ? ', $id)->get();
        // ->whereRaw('WEEK(date) = ?',$id)
        // ->selectRaw('COUNT(*) as numberOfActivities, SUM(distance) as summaryDistance')
        // // ->selectRaw('*')
        // ->get();
        return $this->jsonOut([
             'data' => $activities
        ]);
    }
}