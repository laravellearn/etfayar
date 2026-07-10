<?php

namespace App\Services\uploader;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class StorageManager {

    public function putFile(string $path, string $name, UploadedFile $file) {
        //dd('file', $file);
        return Storage::disk('public')->putFileAs($path, $file, $name);
    }

}
