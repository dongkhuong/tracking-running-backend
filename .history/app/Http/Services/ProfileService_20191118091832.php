<?php

namespace App\Http\Services;

use App\Http\Models\User;
use App\Http\Models\Image;
use Illuminate\Support\Facades\Log;
class ProfileService
{
    const FOLDER_UPLOAD_AVATAR_USER = 'user';

    public function update($inputs)
    {
        $model = cuser();
        $model->fill($inputs);
        $model->save();

        return $model;
    }

    public function changeAvatar($imageData)
    {
        if ($imageData) {
            $image = new Image();
            $image->fill($imageData);
            $image->save();
            $currentUser = cuser();
            // $currentUser->image_id = $image->id;
            $currentUser->save();
            return $currentUser->image;
        }

        return false;
    }

    public function changeAvatarWeb($data)
    {
        $uploadImage = new UploadImage;
        $imageData = $uploadImage->storeBase64($data['image'], self::FOLDER_UPLOAD_AVATAR_USER);

        return $this->changeAvatar($imageData);
    }

    public function changeAvatarAPI($data)
    {
        $uploadImage = new UploadImage;
        $imageData = $uploadImage->store([$data['image']], self::FOLDER_UPLOAD_AVATAR_USER);

        return $this->changeAvatar($imageData[0]);
    }
}