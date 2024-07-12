<?php

namespace Core;

class File
{
    private $file;
    private $fileName;
    private $uploadDir;

    public function __construct($file, $fileName, $uploadDir)
    {
        $this->file = $file;
        $this->fileName = $fileName;
        $this->uploadDir = $uploadDir;
    }

    public function upload()
    {
        if (isset($this->file) && $this->file["error"] === UPLOAD_ERR_OK) {
            $img_tmp = $this->file["tmp_name"];
            $img_name = $this->fileName;
            
            if (!is_dir($this->uploadDir)) {
                mkdir($this->uploadDir, 0777, true);
            }
            
            $target_file = $this->uploadDir . '/' . basename($img_name);
            if (move_uploaded_file($img_tmp, $target_file)) {
                return "The file " . htmlspecialchars(basename($img_name)) . " has been uploaded.";
            } else {
                return "Sorry, there was an error uploading your file.";
            }
        } else {
            return "No file was uploaded or there was an error with the file upload.";
        }
    }
}
