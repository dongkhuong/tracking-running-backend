<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\VerifyPhoneRequest;
use App\Http\Requests\Api\VerifyCodeRequest;
use App\Http\Services\SMSService;
use Illuminate\Http\JsonResponse;

class SMSController extends MainController
{
    protected $smsService;

    public function __construct(SMSService $smsService)
    {
        $this->smsService = $smsService;
    }

    /**
     * Verify Phone and send SMS verify Code
     *
     * @param VerifyPhoneRequest $request request
     *
     * @return JsonResponse
     */
    public function verifyPhone(VerifyPhoneRequest $request)
    {
        $response = $this->smsService->verifyPhone($request);

        return $this->jsonOut([
            'data' => $response,
        ]);
    }

    /**
     * Verify Code
     *
     * @param VerifyCodeRequest $request request
     *
     * @return JsonResponse
     */
    public function verifyCode(VerifyCodeRequest $request)
    {
        $response = $this->smsService->verifyCode($request);

        return $this->jsonOut([
            'data' => $response,
        ]);
    }
}
