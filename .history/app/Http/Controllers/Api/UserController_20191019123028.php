<?php

namespace App\Http\Controllers\Api;

use App\Http\Models\User;
use JWTAuth;
use Illuminate\Http\Request;
use App\Http\Requests\Api\LoginRequest;
use App\Http\Requests\Api\RegisterRequest;
use App\Http\Requests\Api\ChangePasswordRequest;
use App\Http\Requests\Api\ChangeAvatarRequest;
use App\Http\Requests\Api\UserRequest;
use App\Http\Services\UserService;
use App\Http\Services\ProfileService;
use App\Http\Services\ChangePasswordService;

class UserController extends MainController
{
    protected $userService;
    protected $profileService;
    protected $changePasswordService;

    public function __construct(UserService $userService, ProfileService $profileService, ChangePasswordService $changePasswordService)
    {
        $this->userService = $userService;
        $this->profileService = $profileService;
        $this->changePasswordService = $changePasswordService;
    }
    // This is a demo function 
    public function displayAllUsers(){
        $users = User::all();
        return $this->jsonOut([
            'data' => $users
        ]);
    } 

    public function register(RegisterRequest $request)
    {
        $response = $this->userService->register($request->all());

        return $this->jsonOut([
            'data' => $response
        ]);
    }

    /**
     * Login
     *
     * @param array $request
     *
     * @return array
     */
    public function login(Request $request)
    {
        $response = $this->userService->login($request);

        return $this->jsonOut($response);
    }

    public function logout(Request $request)
    {
        JWTAuth::invalidate($request->header('Authorization'));

        return $this->jsonOut([
            'message' => trans('auth.logout_success')
        ]);
    }

    public function profile(Request $request)
    {
        $user = JWTAuth::authenticate($request->header('Authorization'));

        return $this->jsonOut([
            'data' => $user
        ]);
    }

    public function update(UserRequest $request)
    {
        $response = $this->profileService->update($request->all());

        return $this->jsonOut([
            'data' => $response
        ]);
    }

    public function changePassword(ChangePasswordRequest $request)
    {
        $response = $this->changePasswordService->update($request);
        if ($response) {
            return $this->jsonOut([
                'message' => trans('auth.change_password_success')
            ]);
        }

        return $this->jsonOut([
            'message' => trans('auth.change_password_unsuccess'),
            'statusCode' => 400
        ]);
    }

    /**
     * Change Avatar
     * 
     * @param App\Http\Requests\Api\ChangeAvatarRequest $request
     * 
     * @return Object
     */
    public function changeAvatar(ChangeAvatarRequest $request)
    {
        $response = $this->profileService->changeAvatarAPI($request->all());
        if ($response) {
            return $this->jsonOut([
                'message' => trans('message.upload_avatar_successful'),
                'data' => [
                    'path' => asset($response->upload_path)
                ]
            ]);
        }

        return $this->jsonOut([
            'message' => trans('message.upload_avatar_error')
        ]);
    }
}
