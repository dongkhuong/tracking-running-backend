<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Models\Challenge;
use App\Http\Services\ChallengeService;

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
                'data' => $challenges
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

}
