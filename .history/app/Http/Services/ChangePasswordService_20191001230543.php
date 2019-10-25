<?php
namespace App\Http\Services;
use App\Http\Models\User;
use JWTAuth;

class ChangePasswordService
{
    public function update($request)
    {
        $user = cuser();

        $inputs = [
            'email' => $user->email,
            'password' => $request->old_password,
            'status' => User::STATUS_ACTIVE,
        ];

        if (JWTAuth::attempt($inputs)) {
            $user->password = bcrypt($request->new_password);
            $user->save();

            return true;
        }

        return false;
    }
}
