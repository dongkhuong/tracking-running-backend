<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Models\Challenge;
use App\Http\Models\Group;
use App\Http\Models\Policy;
use App\Http\Services\ChallengeService;
use Illuminate\Support\Facades\DB;

class ChallengeController extends Controller
{
    protected $challengeService;

    public function __construct(ChallengeService $challengeService)
    {
        $this->challengeService = $challengeService;
    }

    public function index(Request $request)
    {
        $items = Challenge::with('group')->paginate(5);
        
        return view('challenge.index', compact('items'));
    }

    public function create()
    {
        $groups = DB::table('groups')->select('id', 'name')->get();
        return view('challenge.create',compact('groups'));
    }

    public function store(Request $request)
    {
        $this->challengeService->create($request);
        return redirect('challenges');
    }

    public function show($id)
    {
        $model = Challenge::find($id);
        $groups = DB::table('groups')->select('id', 'name')->get();
        return view('challenge.show', compact('model','groups'));
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

    public function showPolicy($challenge_id)
    {
        $policy = DB->table('policies')->where('challenge_id','=', '8717781b7c1142eebf30d6796bf57909');
        // return view('challenge.showPolicy', compact('policy'));
        dd($policy);
    }
    
}
