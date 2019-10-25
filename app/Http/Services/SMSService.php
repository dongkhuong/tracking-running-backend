<?php

namespace App\Http\Services;

use DB;
use App\Http\Models\DeviceBlock;
use App\Http\Models\VerifyCode;
use Illuminate\Support\Carbon;



class SMSService extends MainService
{
    private $apiKey;
    private $secretKey;

    const MINUTES_EXPIRED_VERIFY_CODE = 1;
    const HOURS_LIMIT_SEND_SMS = 24;
    const MAX_TIMES_SEND_SMS = 3;
    const MIN_TIME_SEND_SMS = 1;
    const BLOCKED = 1;
    const AVAILABLE = 0;

    const SEND_SMS_API_END_POINT = 'http://rest.esms.vn/MainService.svc/json/SendMultipleMessage_V4_get';
    const BRAND_NAME = 'QCAO_ONLINE';
    const SMS_TYPE = 2;

    public function __construct()
    {
        $this->apiKey = env('SMS_API_KEY');
        $this->secretKey = env('SMS_SECRET_KEY');
    }

    /**
     * Restart Device Block - using for renew code.
     * If later user input correct code, Device will be deleted.
     *
     * @param object $deviceBlock 
     *
     * @return object
     */
    public function restartDeviceBlock($deviceBlock)
    {
        $deviceBlock->is_block = self::AVAILABLE;
        $deviceBlock->count = self::MIN_TIME_SEND_SMS;

        $deviceBlock->save();

        return $deviceBlock;
    }

    /**
     * Delete Device Block
     *
     * @param object $deviceBlock 
     *
     * @return boolean
     */
    public function deleteDeviceBlock($deviceBlock)
    {
        DB::beginTransaction();
        $deviceBlock->verifyCodes()->delete();
        $deviceBlock->delete();
        DB::commit();

        return true;
    }

    /**
     * Create Device Block
     *
     * @param array $data 
     *
     * @return object
     */
    public function createDeviceBlock($data)
    {
        $deviceBlockObject = new DeviceBlock;

        $deviceBlockObject->fill($data);

        $deviceBlockObject->save();

        return $deviceBlockObject;
    }
    /**
     * Verify Code
     *
     * @param Request $request 
     *
     * @return boolean
     */
    public function verifyCode($request)
    {
        $verifyCodeObject = VerifyCode::where([
            ['phone', '=', $request->phone],
            ['code', '=', $request->code]
        ])->firstOrFail();

        $verifyCodeExpiredAt = Carbon::parse($verifyCodeObject->expired_at)->timestamp;
        $currentTime = Carbon::now()->timestamp;
        if ($verifyCodeObject && $verifyCodeExpiredAt >= $currentTime) {
            return $this->deleteDeviceBlock($verifyCodeObject->deviceBlock);
        }

        return false;
    }

    /**
     * Send SMS verify code
     *
     * @param string $message 
     *
     * @return object
     */
    public function sendSMS($message, $phone)
    {
        $sendContent = urlencode($message);

        $data = self::SEND_SMS_API_END_POINT . "?Phone={$phone}&ApiKey={$this->apiKey}&SecretKey={$this->secretKey}&Content=$sendContent&Brandname=" . self::BRAND_NAME . '&SmsType=' . self::SMS_TYPE;
        $curl = curl_init($data);
        curl_setopt($curl, CURLOPT_FAILONERROR, true);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($curl);

        $obj = json_decode($result, true);

        if ($obj['CodeResult'] == 100) {
            return true;
        }

        return $obj['ErrorMessage'];
    }

    /**
     * Get Device by Mac Address
     *
     * @param $request 
     *
     * @return object
     */
    public function getDeviceByMacAddress($request)
    {
        $model = DeviceBlock::where([
            ['mac_address', '=', $request->mac_address],
            ['device_name', '=', $request->device_name],
        ]);

        return $model;
    }

    /**
     * Get Verify Codes
     *
     * @param $request 
     *
     * @return object
     */
    public function getVerifyCodes($request)
    {
        $model = VerifyCode::filter([
                ['code', 'like', $request->code],
                ['phone', 'like', $request->phone]
            ])
            ->whereHas('deviceBlock', function ($q) use ($request) {
                $q->filter([
                    ['mac_address', 'like', $request->mac_address],
                    ['device_name', 'like', $request->device_name],
                    ['is_block', '=', $request->is_block],
                ]);
            })
            ->orderBy('verify_codes.expired_at', 'desc');

        return $model;
    }

    /**
     * Renew Verify Code
     *
     * @param $request 
     *
     * @return object
     */
    public function renewVerifyCode($id)
    {
        $verifyCodeObject = VerifyCode::findOrFail($id);

        $verifyCodeObject->code = rand(100000, 999999);
        $verifyCodeObject->expired_at = Carbon::now()->addMinutes(self::MINUTES_EXPIRED_VERIFY_CODE)->toDateTimeString();

        $verifyCodeObject->save();

        $this->restartDeviceBlock($verifyCodeObject->deviceBlock);

        return $verifyCodeObject;
    }
    /**
     * Verify Phone
     *
     * @param $request 
     *
     * @return boolean
     */
    public function verifyPhone($request)
    {
        $verifyCode = rand(100000, 999999);

        $verifyCodeData = [
            'phone' => $request->phone,
            'code' => $verifyCode,
            'expired_at' => Carbon::now()->addMinutes(self::MINUTES_EXPIRED_VERIFY_CODE)->toDateTimeString()
        ];

        $deviceBlockObject = $this->getDeviceByMacAddress($request)->first();

        DB::beginTransaction();
        if ($deviceBlockObject) {
            //If request is within 24h from the beginning
            $validTime = Carbon::parse($deviceBlockObject->updated_at)->addHour(self::HOURS_LIMIT_SEND_SMS)->timestamp;
            $currentTime = Carbon::now()->timestamp;
            if ($validTime >= $currentTime) {
                //If over 3 times, blocked
                if (++$deviceBlockObject->count > self::MAX_TIMES_SEND_SMS) {
                    $deviceBlockObject->is_block = self::BLOCKED;

                    $deviceBlockObject->save();

                    return false;
                }
            } else {
                //delete and create a new one
                $this->deleteDeviceBlock($deviceBlockObject);
                $deviceBlockObject = $this->createDeviceBlock($request->all());
            }
            $deviceBlockObject->verifyCodes()->create($verifyCodeData);

            $deviceBlockObject->save();
        } else {
            $deviceBlockObject = $this->createDeviceBlock($request->all());

            $verifyCodeObject = new VerifyCode;

            $verifyCodeObject->fill($verifyCodeData);
            $verifyCodeObject->deviceBlock()->associate($deviceBlockObject);

            $verifyCodeObject->save();
        }
        DB::commit();

        $message = trans('sms.verify_code', ['code' => $verifyCode]);

        return $this->sendSMS($message, $request->phone);
    }

    /**
     * Delete Verify code
     *
     * @param $verfyCodeId
     *
     * @return mixed
     */
    public function delete($verfyCodeId)
    {
        VerifyCode::findOrFail($verfyCodeId)->delete();

        return true;
    }
}
