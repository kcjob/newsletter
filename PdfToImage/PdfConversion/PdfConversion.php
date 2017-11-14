<?php
namespace PdfToImage;

class PdfConversion{

  static function convertToImage($url, $imageJpeg){

    $pdf = new \Spatie\PdfToImage\Pdf($url);
    $pdf -> setPage(1) //convert first page only
         -> saveImage($imageJpeg);
  }
}
