<?php

namespace App\Services;

use JD\Cloudder\Facades\Cloudder;

class FileUploadService 
{
    /** 
     * Upload file to Cloudinary
     *
     * @param Illuminate\Http\UploadedFile  $file
     * @return array
     */
	public function uploadFile($file)
    {
        // Get file extension
        $fileExtension = $file->getClientOriginalExtension();

        // Form new file name
        $fileName = uniqid(true) . '_' . time() . '.' . $fileExtension;
        
        // Get temp path
        $photo = $file->getRealPath();

        // Upload image to Cloudinary
       	Cloudder::upload($photo, $fileName);

        return Cloudder::getResult();
    }  

    /**
     * Delete file from Cloudinary
     *
     * @param string  $fileName
     * @return boolean
     */
    public function deleteFile($fileName)
    {
        Cloudder::destroyImage($fileName);
        return Cloudder::delete($fileName);
    }

}