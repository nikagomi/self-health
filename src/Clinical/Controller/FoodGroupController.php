<?php

namespace Clinical\Controller;

use Neptune\{BaseController, HtmlHelper};
use Symfony\Component\HttpFoundation\{Request, Response};

/**
 * FoodGroupController
 * @package self-health
 * @author Randal Neptune
 */
class FoodGroupController extends BaseController {
    protected $modelClass = "\Clinical\Model\FoodGroup";
    protected $template = "clinical/foodGroup.tpl";
    private $actionPage = "/food/group/save";
    
    public function uploadImage(Request $request){
        
        \putenv("PATH=/usr/local/bin");
        
        $foodGroup = (new $this->modelClass())->getObjectById($request->request->get("foodGroupId"));
       
        $imgDir = \Neptune\PropertyService::getProperty("food.group.image.dir");
        \set_time_limit(90);
      
        try {

            if (($request->files->get("foodGroupFile")->getSize() / 1024) <= 1024) {
                $imagick = new \Imagick();
                $imagick->readimage($request->files->get("foodGroupFile"));

                //Delete current file if it exists
                if($foodGroup->getImageName() != ''){
                    \unlink($imgDir."/".$foodGroup->getImageName());
                }

                
                if (\strtolower($imagick->getimageformat()) == 'heic' || \strtolower($imagick->getimageformat()) == 'png' || \strtolower($imagick->getimageformat()) == 'jpeg') {
                    switch (\strtolower($imagick->getimageformat())) {
                        case "png": 
                            $savedImageName = 'fg_'.$foodGroup->getId().'.png';
                            $imagick->setimageformat($imagick->getimageformat());
                            break;
                        case "jpg": 
                            $savedImageName = 'fg_'.$foodGroup->getId().'.jpg';
                            $imagick->setimageformat($imagick->getimageformat());
                            break;
                        case "heic": 
                            $imagick->setimageformat('png');
                            $savedImageName = 'fg_'.$foodGroup->getId().'.png';
                            break;
                        default:
                            $savedImageName = 'fg_'.$foodGroup->getId().'.png';
                            $imagick->setimageformat($imagick->getimageformat());
                    }
                    //$savedImageName = (\strtolower($imagick->getimageformat()) == 'png') ?  : 'fg_'.$foodGroup->getId().'.jpg';
                    

                    $imagick->thumbnailimage(128, 128);
                    $imagick->writeimage($imgDir."/".$savedImageName);


                    if(\file_exists($imgDir."/".$savedImageName)){
                        $foodGroup->setImageName($savedImageName);
                        $foodGroup->setOriginalImageName($request->files->get("foodGroupFile")->getClientOriginalName());
                        $foodGroup->update();
                        $txt = ($foodGroup->getOpStatus()) ? "Image was successfully uploaded" : "An error occurred. Could not upload the food group image";
                        $msg = HtmlHelper::composeToastMessage([$foodGroup->getOpStatus() => $txt]);
                    }else{
                        $msg = HtmlHelper::composeToastMessage([false => "Could not upload image file"]);
                    }
                } else {
                    $msg = HtmlHelper::composeToastMessage([false => "Could not upload image file as it is neither in the jpeg or png formats"]);
                }
            }else{
                $msg = HtmlHelper::composeToastMessage([false => "File size is greater than 1024 kB(1 MB) (File size: ".($request->files->get("foodGroupFile")->getSize() / 1024)."kB)"]);
            }
        } catch (\Exception $e) {
            $msg = HtmlHelper::composeToastMessage([false => "Could not upload image file. It may be too big or corrupted."]);
        }
        $foodGroup->clear();
        $this->setUpTemplateVars($foodGroup, $msg);
        return new Response($this->_health->display($this->template));
    }
    
    public function deleteImage ($id) {
        $foodGroup = (new $this->modelClass())->getObjectById($id);
        $imgDir = \Neptune\PropertyService::getProperty("food.group.image.dir");
        //Delete current file if it exists
        \unlink($imgDir."/".$foodGroup->getImageName());
        
        $foodGroup->setImageName('');
        $foodGroup->setOriginalImageName('');
        $foodGroup->updateIncludeEmptyFields();
        $msg = HtmlHelper::composeToastMessage([$foodGroup->getOpStatus() => $foodGroup->getOpMessage()]);
        $foodGroup->clear();
        $this->setUpTemplateVars($foodGroup, $msg);
        return new Response($this->_health->display($this->template));
    }
    
    public function doBeforeDelete($id) {
        $foodGroup = (new $this->modelClass())->getObjectById($id); 
        $imgDir = \Neptune\PropertyService::getProperty("food.group.image.dir");
        $msg = '';
        $deleted = false;
        //Delete current file if it exists
        if($foodGroup->getImageName() != ''){
            $deleted = \unlink($imgDir."/".$foodGroup->getImageName());
            $msg .= ($deleted) ? "The associated image was successfully deleted on file" : "Could not delete the associated image on file.<br/>Please try again later.";
        } else {
            $deleted = true;
        }
        
        return $proceed = array("status" => $deleted, "message" => $msg);
    }
    
    protected function setUpTemplateVars($obj, $msg = ''){
        $this->_health->assign('foodGroup',$obj);
        $this->_health->assign('msg',$msg);
        $this->_health->assign('list',$obj->getAll());
        $this->_health->assign('html',$this->html);
        $this->_health->assign('title','Manage Food Groups');
        $this->_health->assign('actionPage',$this->actionPage);
    }
}
