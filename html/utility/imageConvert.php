<?php
session_start();

require_once (__DIR__.'/../../vendor/autoload.php');
use Neptune\PropertyService;

$id = \filter_input(INPUT_GET, 'id', FILTER_SANITIZE_STRING);
$foodGroup = (new \Clinical\Model\FoodGroup())->getObjectById($id);
   
$imageDir = PropertyService::getProperty("food.group.image.dir","/var/www/oecs/html/food_group_images");

$img = new \Imagick();
$img->readimage($imageDir."/".$foodGroup->getImageName());
$img->setResolution(300,300);
$img->scaleImage(400,400, true);

header("Content-type: image/".$img->getimageformat()); 
echo $img->getimageblob(); 