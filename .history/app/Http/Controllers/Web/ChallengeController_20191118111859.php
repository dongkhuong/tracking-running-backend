<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Services\ChallengeService;

class ChallengeController extends Controller
{
    use Main;
    protected $challengeService;

    public function __construct(ChallengeService $challengeService)
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
        return view('challenge.create');
    }

    public function store(Request $request)
    {
        $this->challengeService->create($request);
    }

    public function show($id)
    {
        $model = $this->challengeService->getDetail($id);

        return view('challenge.show', compact('model'));
    }

    public function update(Request $request, $id)
    {
        $this->challengeService->update($id, $request);

        return redirect('challenges');
    }

    public function destroy($id)
    {
        $this->challengeService->delete($id);

        return redirect('challenges');
    }
}
