<?php

namespace App\Http\Traits;

use Illuminate\Support\Str;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

trait UploadTrait
{
    public function uploadOne(UploadedFile $uploadedFile, $folder= '/images/uploads', $disk = 'public', $filename = null)
    {
        $name = Str::random(10).'-'.time().'.'.$uploadedFile->getClientOriginalExtension();
        $uploadedFile->storeAs($folder, $name, $disk);
        return $name;
    }

    public function uploadMultiple(UploadedFile $uploadedFile, $folder = '/images/uploads', $disk = 'public', $filename = null)
    {
        foreach($uploadedFile as $file)
        {
            $name = Str::random(10).'-'.time().'.'.$file->getClientOriginalExtension();
            $file->storeAs($folder, $name, $disk);
            $data[] = $name;
        }
        return $data;
    }


    public function deleteFile($file_path) {
        if(Storage::disk('public')->exists($file_path)) {
            Storage::disk('public')->delete($file_path);
        }
    }
}