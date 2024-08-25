<?php

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

if (!function_exists('uploadImage')) {
    /**
     * Upload an image file to the public disk and return the filename.
     *
     * @param UploadedFile $image
     * @param string $folder
     * @param string|null $prefix
     * @return string
     */
    function uploadImage(UploadedFile $image, string $folder): string
    {
        // Construct the file path
        $filePath = 'images' . DIRECTORY_SEPARATOR . $folder;

        // Store the image on the public disk
        Storage::disk('public')->put($filePath, $image);

        return $image->hashName();
    }
}
