<?php

 namespace App\Helpers;

 use Illuminate\Support\Facades\File;

 class HelpersFun
 {
     /**
      * Create directory if it don't exist
      *
      * @param string $path
      *
      * @return bool
      */
     public static function checkAndMakeDirectory($path)
     {
         $realPath = public_path($path);
         if (!File::exists($realPath)) {
             return File::makeDirectory($realPath, 0775, true);
         }
         return true;
     }
     /**
      * @param $image
      * @return string
      */
     public static function getNameImage($image, $directory, $imageName)
     {
         $extension = $image->getClientOriginalExtension();
         $nameimg = $imageName . '.'. $extension;
         $image->move(public_path() . '/uploads/'. $directory, $nameimg);

         return '/uploads/' . $directory . '/' . $nameimg;
     }

     /**
      * Delete image by path
      *
      * @param string $path
      *
      * @return mixed
      */
     public static function deleteImage($path)
     {
         $realPath = public_path($path);
         if (File::exists($realPath)) {
             return File::delete($realPath);
         }
         return true;
     }
 }
