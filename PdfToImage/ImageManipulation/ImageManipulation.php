<?php
namespace PdfToImage;
use Spatie\Image\Image;

class ImageManipulation {
  static function changeImageDimensions($imageJpeg, $width, $height) {

  $newImage =  Image::load($imageJpeg)
                ->width($width)
                ->height($height)
                ->save('documents/newimg.jpg');
  }


}
