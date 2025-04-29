<?php

namespace App\Services;

use Illuminate\Support\Facades\File;


class UploadImageService
{
    public function uploadImage($id, string $folder, $file): string
    {
        $destinationPath = public_path("/images/{$folder}");

        $file->move($destinationPath, "{$id}.jpg");

        return "images/{$folder}/{$id}.jpg";
    }

    public function uploadLogo($file)
    {
        try {
            $destinationPath = public_path("/images");

            $file->move($destinationPath, "logo.png");

            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    public function deleteImage($id, string $folder)
    {
        $fullPath = public_path("/images/{$folder}/{$id}.*");

        $files = glob($fullPath);

        if ($files) {
            foreach ($files as $file) {
                if (File::exists($file)) {
                    File::delete($file);
                }
            }
        }
    }
}
