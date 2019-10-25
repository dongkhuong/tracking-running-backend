<?php

namespace App\Http\Services;

use Illuminate\Support\Carbon;
use Storage;

class UploadImage
{

    public function store(array $files, $container = 'article')
    {
        foreach ($files as $index => $file) {
            $images[$index]['id_image'] = uuid();
            $images[$index]['original_name'] = $file->getClientOriginalName();
            $images[$index]['mime_type'] = $file->getClientMimeType();
            $images[$index]['size'] = $file->getClientSize();
            $images[$index]['extension'] = $file->getClientOriginalExtension();
            $images[$index]['container'] = $container;
            $images[$index]['created_at'] = Carbon::now()->toDateTimeString();

            $path = $file->storeAs($container, "{$images[$index]['id_image']}.{$images[$index]['extension']}", 'public');

            $images[$index]['upload_path'] = 'storage/' . $path;
            $images[$index]['name'] = "{$images[$index]['id_image']}.{$images[$index]['extension']}";
            $this->rotateImg($path);
        }

        return $images;
    }
    /**
     * Rotate img if image was auto rotate by ios
     *
     * @param string $fileName filename
     *
     * @return void
     */
    public function rotateImg($fileName)
    {
        if (env('APP_ENV') == 'testing') {
            return;
        }
        if (!function_exists('exif_read_data')) {
            throw new \InvalidArgumentException('fn exif_read_data not found, pls enable extension php_exif');
        }
        $path = storage_path('app/public/' . $fileName);

        $fileContent = file_get_contents($path);

        $image = imagecreatefromstring($fileContent);

        $exif = @exif_read_data(storage_path('app/public/' . $fileName));
        if ($exif) {
            $imageNew = null;
            if (!empty($exif['Orientation'])) {
                switch ($exif['Orientation']) {
                    case 8:
                        $imageNew = imagerotate($image, 90, 0);
                        break;
                    case 3:
                        $imageNew = imagerotate($image, 180, 0);
                        break;
                    case 6:
                        $imageNew = imagerotate($image, -90, 0);
                        break;
                }
            }

            if (!is_null($imageNew)) {
                imagejpeg($imageNew, $path);
                imagedestroy($imageNew);
            }
        }
        imagedestroy($image);
    }

    /**
     * Store Image Base64
     * 
     * @param String $file
     * @param String $folder
     * 
     * @return mixed
     */
    public function storeBase64($file, $folder = '')
    {
        if (preg_match('/^data:image\/(\w+);base64,/', $file)) {
            list($extension, $content) = explode(';',  $file);
            $fileName = sprintf('%s.%s', uuid(), explode('/', $extension)[1]);
            $content = explode(',', $content)[1];

            $storage = Storage::disk('public');
            if (!$storage->exists($folder)) {
                $storage->makeDirectory($folder);
            }

            if ($storage->put($folder . '/' . $fileName, base64_decode($content), 'public')) {
                $images['upload_path'] = Storage::url($folder . '/' . $fileName);
                $images['name'] = $fileName;
                $images['created_at'] = Carbon::now()->toDateTimeString();

                $this->rotateImg($folder . '/' . $fileName);

                return $images;
            }
        }

        return false;
    }
}
