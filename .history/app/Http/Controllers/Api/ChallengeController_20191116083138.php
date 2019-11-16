<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Models\Challenge;

class ChallengeController extends MainController
{
    public function index(Request $request)
    {
        $challenge = Challenge::where('group_id', $request->group_id)->get();
        return $challenge;
    }
}
