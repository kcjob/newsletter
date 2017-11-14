<?php
require_once( __DIR__ . '/vendor/autoload.php');
//use Symfony\Component\HttpFoundation\Request;

use Spatie\PdfToImage\Pdf;
use Spatie\Image\Image;
use PdfToImage\PdfConversion;
use PdfToImage\ImageManipulation;

use \UserEmail\DBConnect;
use \UserEmail\RecipientDAO;


use \UserEmail\EmailMessage;
use \UserEmail\ConfigEmail;
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
$width = '100';
$height = '1000';

//PDF CONVERSION TO IMAGE
PdfConversion::convertToImage($url, $path.$imageJpeg);
//IMAGE SIZE MANIPULATION
ImageManipulation::changeImageDimensions($path.$imageJpeg, $width, $height);

//CONNECT TO DATABASE
try {
    $connectToDb = DBConnect::getConnection();
} catch (Exception $e) {
    $log->error($e->getMessage());
    echo "Database connection failed\r\n";
    die();
}
$recipientData = RecipientDAO::getRecipientData($connectToDb);
try {
    EmailMessage::createAndSendEmail($recipientData);
} catch (Exception $e) {
    $log->error($e->getMessage());
    echo "EmailMessage Somethin aint working\n" . $e->getMessage();
    die();
}
