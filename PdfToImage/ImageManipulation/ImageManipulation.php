<?php
namespace PdfToImage;
use Spatie\Image\Image;

class ImageManipulation {
   static function changeImageDimensions($imageJpeg, $width, $height) {

   echo 'ORIGINAL SIZE -- pixels -- COMMENT OUT FOR PRODUCTION';
   $imgsize1 = getimagesize($imageJpeg);
   var_dump($imgsize1);

   $newImage =  Image::load($imageJpeg)
                ->width($width)
                ->height($height)
                ->save('documents/newimg.jpg');

   echo 'RESIZED -- pixels -- COMMENT OUT FOR PRODUCTION';
   $imgsize = getimagesize('documents/newimg.jpg');
   var_dump($imgsize);
  }
}
