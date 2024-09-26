<?php

namespace App\CPU;


class Images
{
    public static function upload($folder, $image)
    {
        $fileName = time() . rand(100, 999) . '.' . $image->getClientOriginalExtension();
        $image->storeAs('public/images/' . $folder, $fileName);
        $productImage = 'storage/images/' . $folder . '/' . $fileName;
        return $productImage;
    }
    
    public static function delete($image)
    {
        if (file_exists(public_path($image))) {
            unlink(public_path($image));
        }
    }

    public static function update($folder, $oldImagePath, $newImage)
    {
        self::delete($oldImagePath);

        $fileName = time() . rand(100, 999) . '.' . $newImage->getClientOriginalExtension();

        $newImage->storeAs('public/images/' . $folder, $fileName);

        $productImage = 'storage/images/' . $folder . '/' . $fileName;

        return $productImage;
    }
}
