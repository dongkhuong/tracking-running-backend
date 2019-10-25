<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Services\SMSService;
use App\Http\Traits\ApiResponse;

class VerifyCodeController extends Controller
{
    use ApiResponse;

    protected $smsService;

    public function __construct(SMSService $smsService)
    {
        $this->smsService = $smsService;
    }

    /**
     * Display a listing of the resource.
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $items = $this->smsService->getVerifyCodes($request)->paginate();

        return view('verify-code.index', compact('items'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param   string $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $verifyCodeObject = $this->smsService->renewVerifyCode($id);

        return $this->jsonOut([
            'message' => trans('verifyCode.available'),
            'data' => $verifyCodeObject
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string $id
     * @return mixed
     */
    public function destroy($id)
    {
        $this->smsService->delete($id);

        return redirect('verify-codes');
    }
}
