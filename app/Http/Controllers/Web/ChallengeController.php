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
        $model = DB::table('policies')->where('challenge_id','=', $challenge_id)->first();
        return view('challenge.showPolicy', compact('model'));
        
    }

    public function createPolicy(Request $request, $challenge_id)
    {
        $model = new Policy;
        $model->challenge_id = $challenge_id;
        $model->fill($request->all()); 
        $model->save();
        
        return redirect()->back();
    }

    public function updatePolicy(Request $request, $id)
    {
        $model = Policy::findOrFail($id);
        $model->fill($request->all());

        $model->save();
        return redirect()->back();
    }
    
    public function deletePolicy($id)
    {
        $model = Policy::findOrFail($id);
        $model->delete();

        return redirect()->back();
    }

}
