<?php
session_start();

require_once (__DIR__.'/../../vendor/autoload.php');

$assessmentId = filter_input(INPUT_GET, 'assessmentId', FILTER_SANITIZE_STRING);
$oa = (new \Ole\Model\OleOnlineAssignment())->getBySubjectGradeActivity($assessmentId);
$url = "http://".\Neptune\EduPropertyService::getProperty("s3.bucket.name","svg-smart-bucket").".". \Neptune\Config::$S3_END_POINT."/".$oa->getUploadName();

//header('Content-Description: File Transfer');
// header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename="'.$oa->getFileName().'"');
header('Expires: 0');
header('Cache-Control: must-revalidate');
header('Pragma: public');
//header('Content-Length: ' . filesize($file));

ob_clean();
flush();
readfile($url);
exit;
