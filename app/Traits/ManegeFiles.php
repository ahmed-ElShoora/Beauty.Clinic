<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;

trait ManegeFiles
{
    public function uploadFile($file, $folder = 'general')
    {
        $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

        $path = $file->storeAs(
            "files/$folder",
            $fileName,
            'public'
        );

        return $path;
    }

    public function deleteFile($path)
    {
        if (Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }
    }
}