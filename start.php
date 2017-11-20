<?php
require_once( __DIR__ . '/vendor/autoload.php');

use Spatie\PdfToImage\Pdf;
use Spatie\Image\Image;
use PdfToImage\PdfConversion;
use PdfToImage\ImageManipulation;

use \UserEmail\EmailSender;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

// create a log channel
$log = new Logger('database');
$dbStream = new StreamHandler('log/newsletter.log', Logger::WARNING);
$log->pushHandler($dbStream);

$url = 'http://forum.sci.ccny.cuny.edu/administration/deans-office/publications/gazette/archives/fall-2017/vol3issue9.pdf';
$path = 'documents/';
$imageJpeg = 'newpdfimg.jpg';
$width = '1250';
$height = '1500';

//PDF CONVERSION TO IMAGE
//PdfConversion::convertToImage($url, $path.$imageJpeg);
//IMAGE SIZE MANIPULATION
//ImageManipulation::changeImageDimensions($path.$imageJpeg, $width, $height);

EmailSender::mailmsg();
