<?php

namespace App\Utils;



use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;


class ImageUpload
{
 public static function uploadImage($request , $height = null, $width = null, $path = null){
   $imageName = Str::uuid().date('y-m-d').'.'.$request->extension();
   [$heightDefault, $widthDefault] =getimagesize($request);
   $height = $height ?? $heightDefault;
   $width = $height ?? $widthDefault;
   $image = Image::make($request->path());
   $image->fit($height, $width , function ($constraint){
    $constraint->upsize();
   })->stream();
   Storage::disk('images')->put($path.$imageName, $image);
   return $path.$imageName;

 }
}
