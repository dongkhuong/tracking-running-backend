<?php

namespace App\Http\Services;

use App\Http\Models\User;
use App\Mail\VerifyEmail;
use App\Http\Models\DeviceInfo;
use App\Http\Traits\CryptData;
use App\Http\Models\AuthAssignment;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;

use JWTAuth;
use DB;

class UserService
{
    use Main;
    use CryptData;

    const TIME_EXPIRED_RESET_PASSWORD = 24;

    /**
     * Service register user
     * 
     * @param array $inputs
     * 
     * @return object
     */
    public function register($inputs)
    {
        $inputs['status'] = User::STATUS_ACTIVE;
        $inputs['password'] = bcrypt($inputs['password']);

        $model = new User;
        $model->fill($inputs);

        $authAssign = new AuthAssignment;
        $authAssign->item_name = AuthAssignment::ROLE_USER;

        DB::transaction(function () use ($model, $authAssign) {
            $model->save();
            $authAssign->user_id = $model->id;
            $authAssign->save();
            $this->sendVerifyEmail($model);
        });

        return $model;
    }

    /**
     * Service send verify email when user registered
     * 
     * @param object  $model
     * 
     * @return Boolean
     */
    public function sendVerifyEmail($model)
    {
        $expireTo = Carbon::now()->addHour(self::TIME_EXPIRED_RESET_PASSWORD)->timestamp;
        $payload = [
            'expired' => $expireTo,
            'userEmail' => $model->email
        ];
        $encrypedSignature = $this->encryptData($payload);
        $urlVerifyEmail = route('register.verify', ['signature' => $encrypedSignature]);
        $verifyEmailContent = [
            'user' => $model,
            'urlVerifyEmail' => $urlVerifyEmail
        ];
        Mail::to($model->email)->send(new VerifyEmail($verifyEmailContent));
    }

    /**
     * Service verify the link user click from verify email
     * 
     * @param array $signature
     * 
     * @return Boolean
     */
    public function verify($signature)
    {
        $decryptedData = $this->decryptData($signature);
        if (is_array($decryptedData) && isset($decryptedData['expired']) && isset($decryptedData['userEmail'])) {
            $currentTime = Carbon::now()->timestamp;
            if ($currentTime < $decryptedData['expired']) {
                $user = User::whereEmail($decryptedData['userEmail'])->first();
                if ($user && !$user->email_verified_at) {
                    $user->status = User::STATUS_ACTIVE;
                    $user->email_verified_at = Carbon::now()->toDateTimeString();
                    $user->save();

                    return true;
                }
            }
        }

        return false;
    }

    /**
     * Service for user login
     * 
     * @param object $request
     * 
     * @return object
     */
    public function login($request)
    {
        $inputs = $request->only('email', 'password');
        $inputs['status'] = User::STATUS_ACTIVE;
        $token = null;

        if (!$token = JWTAuth::attempt($inputs, $request->has('remember'))) {

            return $this->response([
                'message' => 'Invalid email or password',
                'statusCode' => 422
            ]);
        }

        $deviceInfo = new DeviceInfo;
        $deviceInfo->fill($request->all());
        $deviceInfo->user_id = cuser()->id;
        $deviceInfo->save();

        return $this->response([
            'data' => [
                'user' => cuser(),
                'token' => $token,
            ]
        ]);
    }

    /**
     * Service for get list user base on request
     * 
     * @param object $request
     * 
     * @return object
     */
    public function getList($request)
    {
        $users  = User::filter([
            ['firstname', 'like',  $request->firstname],
            ['lastname', 'like',  $request->lastname],
            ['email', 'like',  $request->email],
            ['phone', 'like', $request->phone],
            ['birthday', 'like', serverFormatDate($request->birthday)],
            ['status', '=', $request->status],
        ])
            ->with(['image'])
            ->orderBy('created_at', 'desc');

        return $users;
    }

    /**
     * Service for get detail user base on id
     * 
     * @param String $request
     * 
     * @return object
     */
    public function getDetail($id)
    {
        $user  = User::findOrFail($id);
        $user->load('image', 'role');

        return $user;
    }

    /**
     * Service for update user
     * 
     * @param object $input
     * @param String $id
     * 
     * @return object
     */
    public function update($inputs, $id)
    {
        $model = User::findOrFail($id);
        $model->fill($inputs);

        $authAssign = AuthAssignment::where('user_id', $model->id)->firstOrFail();
        if (isset($inputs['role'])) {
            $authAssign->item_name = $inputs['role'];
        }

        DB::transaction(function () use ($model, $authAssign) {
            $model->save();
            $authAssign->save();
        });

        return $model;
    }
}
