<?php

namespace App\Http\Services;

use App\Http\Models\User;
use App\Http\Models\Image;

class ProfileService
{
    const FOLDER_UPLOAD_AVATAR_USER = 'user';
    /**
     * Profile - Update
     * 
     * @param array $inputs
     * 
     * @return object
     */
    public function update($inputs)
    {
        $model = cuser();
        $model->fill($inputs);
        dd($inputs);
        $model->update();

        return $model;
    }

    /**
     * Profile - Change Avatar Common
     * 
     * @param array $data
     * 
     * @return object
     */
    public function changeAvatar($imageData)
    {
        if ($imageData) {
            $image = new Image();
            $image->fill($imageData);
            $image->save();
            $currentUser = cuser();
            $currentUser->image()->associate($image);
            return $currentUser->image;
        }

        return false;
    }
    /**
     * Profile - Change Avatar Service Web
     * 
     * @param array $data
     * 
     * @return string
     */
    public function changeAvatarWeb($data)
    {
        $uploadImage = new UploadImage;
        $imageData = $uploadImage->storeBase64($data['image'], self::FOLDER_UPLOAD_AVATAR_USER);

        return $this->changeAvatar($imageData);
    }

    /**
     * Profile - Change Avatar Service API
     * 
     * @param array $data
     * 
     * @return string
     */
    public function changeAvatarAPI($data)
    {
        $uploadImage = new UploadImage;
        $imageData = $uploadImage->store([$data['image']], self::FOLDER_UPLOAD_AVATAR_USER);

        return $this->changeAvatar($imageData[0]);
    }
}
