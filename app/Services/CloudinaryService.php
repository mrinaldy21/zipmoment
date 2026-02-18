<?php

namespace App\Services;

use Cloudinary\Cloudinary;
use Cloudinary\Api\Upload\UploadApi;
use Illuminate\Support\Facades\Log;

class CloudinaryService
{
    protected $cloudinary;

    public function __construct()
    {
        // Using CLOUDINARY_URL directly for maximum stability
        $cloudinaryUrl = env('CLOUDINARY_URL');
        
        if (!$cloudinaryUrl) {
            Log::error('CloudinaryService: CLOUDINARY_URL not found in environment.');
            throw new \Exception('Cloudinary configuration error.');
        }

        $this->cloudinary = new Cloudinary($cloudinaryUrl);
    }

    /**
     * Upload a file to Cloudinary
     * 
     * @param string|\Illuminate\Http\UploadedFile $file
     * @param string $folder
     * @return string|null Secure path to the uploaded file
     */
    public function upload($file, string $folder = 'zipmoment')
    {
        try {
            if (!$file) {
                Log::warning('Cloudinary upload called with empty file.');
                return null;
            }

            $path = is_string($file) ? $file : $file->getRealPath();

            if (!file_exists($path)) {
                Log::error('Cloudinary file not found: ' . $path);
                return null;
            }

            $result = $this->cloudinary->uploadApi()->upload($path, [
                'folder' => $folder,
                'resource_type' => 'auto',
                'overwrite' => true,
            ]);

            return $result['secure_url'] ?? null;

        } catch (\Throwable $e) {
            Log::error('Cloudinary Upload Failed', [
                'message' => $e->getMessage(),
                'folder' => $folder
            ]);
            return null;
        }
    }

}
