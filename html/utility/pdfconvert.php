<?php
session_start();

require_once(__DIR__.'/../../src/pdf/tcpdf.php');
require_once (__DIR__.'/../../vendor/autoload.php');


$id = \filter_input(INPUT_GET, 'id', FILTER_SANITIZE_STRING);
$suffix = \filter_input(INPUT_GET, 'suffix', FILTER_SANITIZE_STRING);
$userId = \filter_input(INPUT_GET, 'userId', FILTER_SANITIZE_STRING);

if($id !== false && \trim($suffix) != '') {
    $host = \filter_input(INPUT_SERVER, 'HTTP_HOST');
    $protocol = strtolower(substr(\filter_input(INPUT_SERVER, "SERVER_PROTOCOL"),0,5))=='https'?'https':'http';
    $url = $protocol."://".$host. \Neptune\Config::$PDF_GRADE_REPORT_DIR . \trim(\strtoupper($suffix)). "/pdfGenerator".".php?id=".$id."&userId=".$userId."&outputType=I";
    
    //echo $url;
    
    $img = new \Imagick();
    $img->setResolution(200,200);
    $img->readimage($url);
    $img->scaleImage(800,0);
    $img->setimageformat('jpeg');
    //$img->flattenimages();
   //$img->writeimages('test.jpeg', false);
    header("Content-type: image/".$img->getimageformat()); 
    echo $img->getimageblob(); 
} else {
    
}



