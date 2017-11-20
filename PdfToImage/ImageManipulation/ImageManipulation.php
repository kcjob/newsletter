<?php
namespace PdfToImage;
use Spatie\Image\Image;

class ImageManipulation {
  static function changeImageDimensions($imageJpeg, $width, $height) {

  $imgsize1 = getimagesize($imageJpeg);
  echo 'ORIGINAL SIZE -- pixels -- COMMENT OUT FOR PRODUCTION';
  var_dump($imgsize1);

  $newImage =  Image::load($imageJpeg)
                ->width($width)
                ->height($height)
                ->save('documents/newimg.jpg');

$imgsize = getimagesize('documents/newimg.jpg');

echo 'RESIZED -- pixels -- COMMENT OUT FOR PRODUCTION';
var_dump($imgsize);

  /*$width = $newImage->getImageWidth(); // pixels
  $height = $newImage->getImageHeight();
  echo 'width: '.$width;
  echo 'height: '. $height;*/

  }



}
