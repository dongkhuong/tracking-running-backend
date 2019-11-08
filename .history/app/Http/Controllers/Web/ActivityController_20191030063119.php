<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Services\ActivityService;

class ActivityController extends Controller
{
    protected $activityService;
    public function __construct(ActivityService $activityService)
    {
        $this->activityService = $activityService;
    }
    public function index(Request $request)
    {   
        // $items = $this->activityService->getList($request)->paginate(2);
        $items = $this->activityService->getList($request);
        
        return view('activity.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('activity.create');
    }

    public function store(Request $request)
    {
        $this->activityService->create($request);

        return redirect('activities');
    }

    public function show($id)
    {
        $model = $this->activityService->getDetail($id);

        return view('activity.show', compact('model'));
    }

    public function update(Request $request, $id)
    {
        $this->activityService->update($id, $request);

        return redirect('activities');
    }

    public function destroy($id)
    {
        $this->activityService->delete($id);

        return redirect('activities');
    }
}
