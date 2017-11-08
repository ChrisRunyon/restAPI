<?php

class Uploader {

    protected $fileName;

    public function uploadFile($file, $nameDir) {
        if(isset($file)) {
            if (($file["type"] == "image/jpeg")
                || ($file["type"] == "image/png")
                || ($file["type"] == "image/gif")
                /* 1 Megabit === 1048576 bits */
                && ($file["size"] < 1048576)) {
                if ($file["error"] > 0) {
                    throw new Exception("Return Code: " . $file["error"]);
                } else {
                    $prepend = $nameDir;
                    $filename = $prepend.$file["name"];
                    $location = $_SERVER['DOCUMENT_ROOT']."/upload/".$filename;

                    move_uploaded_file($file["tmp_name"], $location);

                    $this->setFileName($filename);
                }
            }
        }
    }

    public function getFileName() {
        return $this->fileName;
    }

    public function setFileName($filename) {
        $this->fileName = $filename;
    }
}
