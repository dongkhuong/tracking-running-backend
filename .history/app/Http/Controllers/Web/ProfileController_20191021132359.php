<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Services\ProfileService;
use App\Http\Requests\Web\ProfileRequest;
use App\Http\Requests\Web\ChangeAvatarRequest;
use App\Http\Traits\ApiResponse;

class ProfileController extends Controller
{
    use ApiResponse;

    protected $profileService;

    public function __construct(ProfileService $profileService)
    {
        $this->profileService = $profileService;
    }

    public function index()
    {
        $model = cuser();
        $model->image->image_id;
        dd($model->image->image_id);
        // dd($model);
        return view('profile.index', compact('model'));
    }

    public function update(ProfileRequest $request)
    {
        $this->profileService->update($request->all());

        return redirect('profiles');
    }

    /**
     * Change Avatar
     * 
     * @param App\Http\Requests\Web\ChangeAvatarRequest request
     * 
     * @return mixed
     */
    public function changeAvatar(ChangeAvatarRequest $request)
    {
        $response =  $this->profileService->changeAvatarWeb($request->all());
        if ($response) {
            return $this->jsonOut([
                'data' => [
                    'path' => asset($response->upload_path)
                ]
            ]);
        }

        return $this->jsonOut([
            'error' => true,
            'message' => 'Upload error'
        ]);
    }
}
