<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Models\Challenge;
use App\Http\Services\ChallengeService;
use Illuminate\Support\Facades\DB;

class ChallengeController extends MainController
{
    protected $challengeService;

    public function __construct(ChallengeService $challengeService)
    {
        $this->challengeService = $challengeService;
    }

    public function index(Request $request)
    {
        $challenges = $this->challengeService->index($request->group_id);
        if($challenges->count() > 0) {
            return $this->jsonOut([
                'business_code' => 1,
                'data' => $challenges->get()
            ]);
        } else {
            return $this->jsonOut([
                'business_code' => 0,
                'message' => 'No record in this table'
            ]);
        }

    }

    public function store(Request $request)
    {
        $challenge = $this->challengeService->create($request);
        return $this->jsonOut([
            'business_code' => 1,
            'data' => $challenge
        ]);
    }

    public function show(Request $request)
    {
        $challenge = $this->challengeService->getDetail($request->id);
        return $this->jsonOut([
            'business_code' => 1,
            'data' => $challenge->first()
        ]);
    }

    public function addCurrentUserIntoChallenge(Request $request) 
    {
        $challenge = Challenge::find($request->challenge_id);
        if($challenge!=null) {
            $cUser = cuser()->challenges()->attach($challenge);
            return $this->jsonOut([
                'business_code' => 1,
                'message' => "Add successfully!"
            ]);
        } else {
            return $this->jsonOut([
                'business_code' => 0,
                'message' => 'Id challenge not found'
            ]);
        }
    }

    public function checkJoinIntoChallenge(Request $request)
    {
        $cUser = DB::table('challenge_user')->where('user_id', cuser()->id)->where('challenge_id',$request->challenge_id)->count();
        if($cUser > 0){
            return $this->jsonOut([
                "business_code" => 1,
                "message" => "The record existed in this table"
            ]);
        } else {
            return $this->jsonOut([
                "business_code" => 0,
                "message" => "The record doesn't exists in this table"
            ]);
        }

    }

    public function checkSumOfChallenges()
    {
        $cUser = DB::table('challenge_user')->where('user_id', cuser()->id);
        if($cUser->count() > 0) {
            return $this->jsonOut([
                "business_code" => 1,
                "data" => $cUser->get()
            ]);
        } 
        else {
            return $this->jsonOut([
                "business_code" => 0,
                "message" => "The record doesn't exists in this table"
            ]);
        }
    }

    public function deleteJoin(Request $request) 
    {
        $challenge = Challenge::find($request->challenge_id);
        if($challenge!=null) {
            $cUser = cuser()->challenges()->detach($request->challenge_id);
            return $this->jsonOut([
                'business_code' => 1,
                'message' => "Leave challenge successfully!"
            ]);
        } else {
            return $this->jsonOut([
                "business_code" => 0,
                "message" => "The record doesn't exists in this table"
            ]);
        }
    }

    public function getAllChallengesOfUser() 
    {
        $temp = array();
        $cUsers = DB::table('challenge_user')->where('user_id', cuser()->id);
        if($cUsers->count() > 0) {
            foreach($cUsers->get() as $cUser){
                array_push($temp,$cUser->challenge_id);
            }
            $challenges = Challenge::whereIn('id', $temp)->get();
            return $this->jsonOut([
                'business_code' => 1,
                'data' => $challenges
            ]);
        }
    }

}
