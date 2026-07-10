<?php

namespace App\Services\uploader;


use Carbon\Carbon;

class Uploader {

    private $storageManager;

    public function __construct(StorageManager $storageManager) {
        $this->storageManager = $storageManager;
    }

    public function upload($file) {
        return $this->putFileIntoStorage($file);
    }

    public function uploads($files) {
        $result = [];
        foreach ($files as $file) {
            $result[] = $this->putFileIntoStorage($file);

        }
        return $result;
    }

    private function putFileIntoStorage($file) {
        $file_name = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $file_extension = $file->extension();
        $file_full_name = $file_name . Carbon::now()->timestamp . '.' . $file_extension;
        $file_path = Carbon::now()->format('Y') . '/' . Carbon::now()->format('m') . '/' . Carbon::now()->format('d');
        return $this->storageManager->putFile($file_path, $file_full_name, $file);
    }

}
