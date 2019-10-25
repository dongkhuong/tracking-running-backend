<?php

namespace App\Http\Services;

use App\Http\Models\User;
use App\Mail\ResetPassword;
use App\Http\Traits\CryptData;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;

class ResetPasswordService
{
    use CryptData;

    const TIME_EXPIRED_RESET_PASSWORD = 24;

    public function send($request)
    {
        $toEmail = $request->email;
        $expireTo = Carbon::now()->addHour(self::TIME_EXPIRED_RESET_PASSWORD)->timestamp;
        $payload = [
            'email' => $toEmail,
            'expire' => $expireTo
        ];
        $encrypedSignature = $this->encryptData($payload);
        $urlRequestPassword = route('reset-password.verify', ['signature' => $encrypedSignature]);
        Mail::to($toEmail)->send(new ResetPassword($urlRequestPassword));

        return true;
    }

    public function verify($signature)
    {
        $decryptedData = $this->decryptData($signature);
        if (is_array($decryptedData) && isset($decryptedData['expire']) && isset($decryptedData['email'])) {
            $currentTime = Carbon::now()->timestamp;
            if ($currentTime < $decryptedData['expire']) {
                
                return  $decryptedData['email'];
            }
        }

        return false;
    }

    public function update($request)
    {
        $getEmailFromSignature = $this->verify($request->signature);
        if ($getEmailFromSignature) {
            $user = User::whereEmail($getEmailFromSignature)->first();
            if ($user) {
                $user->password = bcrypt($request->password);
                $user->save();

                return true;
            }
        }

        return false;
    }
}
