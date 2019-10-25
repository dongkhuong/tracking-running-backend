<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Services\ResetPasswordService;
use App\Http\Requests\Web\ResetPasswordRequest;
use App\Http\Requests\Web\PasswordResetConfirmRequest;

class ResetPasswordController extends Controller
{
    protected $resetPasswordService;

    /**
     * Constructor
     * 
     * @param ResetPasswordService $resetPasswordService
     * 
     * @return void
     */
    public function __construct(ResetPasswordService $resetPasswordService)
    {
        $this->resetPasswordService = $resetPasswordService;
    }

    /**
     * Index
     * 
     * @return void
     */
    public function index()
    {
        return view('reset-password.index');
    }

    public function send(ResetPasswordRequest $request)
    {
        $response = $this->resetPasswordService->send($request);

        if ($response) {
            $type = 'success';
            $message = 'Send mail reset password successful.';
        } else {
            $type = 'error';
            $message = 'Send mail reset password unsuccessful.';
        }

        return redirect('reset-passwords')->with([$type => $message]);
    }

    public function verify($signature)
    {
        $response = $this->resetPasswordService->verify($signature);
        if ($response) {

            return view('reset-password.verify')->with(['signature' => $signature]);
        }

        return redirect('reset-passwords');
    }

    public function confirm()
    {
        return view('reset-password.confirm');
    }

    public function update(PasswordResetConfirmRequest $request)
    {
        $response = $this->resetPasswordService->update($request);
        if ($response) {
            $type = 'success';
            $message = 'Reset password successful.';
        } else {
            $type = 'error';
            $message = 'Reset password unsuccessful.';
        }

        return redirect('reset-passwords/confirm')->with([$type => $message]);
    }
}
