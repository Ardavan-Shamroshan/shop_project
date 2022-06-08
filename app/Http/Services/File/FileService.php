<?php

namespace App\Http\Services\File;

use Illuminate\Support\Facades\Config;
use Intervention\File\Facades\File;

class FileService extends FileToolsService {
    public function moveToPublic($file) {
        $this->setFile($file);
        $this->provider();
        $result = $file->move(public_path($this->getFinalFileDirectory()), $this->getFinalFileName());
        return $result ? $this->getFileAddress() : false;
    }

    public function moveToStorage($file) {
        $this->setFile($file);
        $this->provider();
        $result = $file->move(storage_path($this->getFinalFileDirectory()), $this->getFinalFileName());
        return $result ? $this->getFileAddress() : false;
    }

    public function deleteFile($filePath, $storage = false) {
        if($storage)
        {
            unlink(storage_path($filePath));
            return true;
        }
        if (file_exists($filePath)) {
            unlink($filePath);
            return true;
        }
        return false;
    }
}