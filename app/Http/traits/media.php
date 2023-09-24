<?php

namespace App\Http\traits;

trait media {
    public function upload($image,$folder)
    {
        $photoName = time() . '.' . $image->extension(); //23122123.png
        $image->move(public_path("images\\$folder\\"),$photoName); //public_path() => public path as absolute path
        return $photoName;
    }

    public function delete($photoName,$folder)
    {
        $oldPhotoPath = public_path("images\\$folder\\$photoName");
        if(file_exists($oldPhotoPath)){
            unlink($oldPhotoPath);
            return true;
        }
        return false;
    }
}