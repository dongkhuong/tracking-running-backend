<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Services\ChallengeService;

class ChallengeController extends Controller
{
    use Main;
    protected $challengeService;

    public function __construct(ChallengeService $challenService)
    {
        $this->challengeService = $challengeService;
    }

    public function index(Request $request)
    {
        $items = Group::paginate(2);
        
        return view('group.index', compact('items'));
    }
    public function create()
    {
        return view('group.create');
    }

    public function store(Request $request)
    {
        $this->groupService->create($request);

        return redirect('groups');
    }

    public function show($id)
    {
        $model = $this->groupService->getDetail($id);

        return view('group.show', compact('model'));
    }

    public function update(Request $request, $id)
    {
        $this->groupService->update($id, $request);

        return redirect('groups');
    }

    public function destroy($id)
    {
        $this->groupService->delete($id);

        return redirect('groups');
    }
}
