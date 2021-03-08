<?php

namespace Patient\Controller;

use Symfony\Component\HttpFoundation\{Request, Response, RedirectResponse};
use Neptune\{MessageResources, DbMapperUtility, PropertyService,HtmlHelper, ModifiableBaseController};


/**
 * Description of StudentController
 * @package smile
 * @author Randal Neptune
 */
class PatientController extends ModifiableBaseController{
    protected $modelClass = "\Patient\Model\Patient";
    protected $summaryTemplate = "patient/main.tpl";
    protected $template = "patient/registerPatient.tpl";
    private $actionPage = "/patient/register";
        
    public function summary (Request $request, $id, $message = ""){
        $patient = (new $this->modelClass())->getEntityById($id);
        
        if ($patient->getId() != "" && ($patient->getId() == $_SESSION['patientId'] 
                || \Authentication\Model\PermissionManager::userHasPermission("SEARCH.PATIENTS", $_SESSION['userId']))) {
         
            $msg = ($message == "") ? $_SESSION['msg'] : $message;
            $_SESSION['msg'] = "";
            $this->setUpTemplateVars($patient, $msg);

            return new Response($this->_health->display($this->summaryTemplate));
        } else {
            return new RedirectResponse("/user/home");
        }
    }
    
 
    
    /**
     * To capture photo from webcam
     * @param Request $request
     * @return Response
     */
    public function capturePhoto(Request $request){
        
        $patientImageDir = \Neptune\PropertyService::getProperty("patient.thumbnail.dir");
        $patient = (new $this->modelClass())->getEntityById($request->request->get("patientId"));
        
        $imgName = $patient->getId().'.png';
        
        //Possible existing files for student
        $files = glob($patientImageDir.$patient->getId().".*");
        $responseArr = array();
        
        // delete previous student files if they already exist
        if (\count($files) > 0){
            foreach ($files as $file) {
                if (file_exists($file)) {
                    unlink($file);
                }
            }
        }
        
        $imagick = new \Imagick();
        $imagick->readimage($request->files->get('photo'));
        $imagick->setimageformat('png');
        $imagick->thumbnailimage(120, 120);
        $imagick->writeimage($patientImageDir.$imgName);
        
        if(\file_exists($patientImageDir.$imgName)){
            $patient->setPhotoName($imgName);
            $patient->update();
            $responseArr['status'] = $patient->getOpStatus();
            $responseArr['msg'] = $patient->getOpMessage();
        }else{
            $responseArr['status'] = false;
            $responseArr['msg'] = "";
        }
        $response = (new Response())->setContent(json_encode($responseArr));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }
    
    public function deletePhoto($id){
        $photoDir = \Neptune\PropertyService::getProperty("patient.thumbnail.dir");
        $patient = (new $this->modelClass())->getObjectById($id);
        $msg = "";
        if($patient->getPhotoName() != ''){
            if(\unlink($photoDir.$patient->getPhotoName())){
                $patient->setPhotoName('');
                $patient->updateIncludeEmptyFields();
                $txt = ($patient->getOpStatus()) ? MessageResources::i18n("patientController.photo.delete.success"): MessageResources::i18n("patientController.photo.delete.error");
                $msg .= $this->html->printMessageText($patient->getOpStatus(),$txt);
            }else{
                $msg .= $this->html->printMessageText(false,MessageResources::i18n("patientController.photo.delete.error"));
            }
        } 
        $_SESSION['msg'] = $msg;
        return new RedirectResponse("/patient/summary/".$id);
    }
    
    /*public function showRegistrationForm(Request $request){
        $patient = new $this->modelClass();
        //Pre-populate form with search form criteria
        $patient->setFirstName($request->request->get("firstName"));
        $patient->setLastName($request->request->get("lastName"));
        $patient->setGenderId($request->request->get("genderId"));
        $patient->setPrimaryContactNumber($request->request->get("primaryContactNumber"));
        $this->_health->assign('apptId',$request->request->get("apptId"));
        
        //For default birth country 
        $country = (new \Admin\Model\Country())->getByName(PropertyService::getProperty("default.country.of.birth.name","Saint Lucia"));
        $patient->setCountryOfBirthId($country->getId());
        
        $this->setUpTemplateVars($patient,"");
        return new Response($this->_health->display($this->template));
    }*/
    
    public function register(Request $request){
        $patient = (new $this->modelClass())->mapFormToEntity($request->request);
        $now = date("Y-m-d H:i:s");
        $msgArr = [];
        $msg = '';
        
        if($request->request->get("id") != ''){//an edit
            $dbObj= (new $this->modelClass())->getEntityById($request->request->get("id"));
            $patient->setCreatedById($dbObj->getCreatedById());
            $patient->setCreatedTime($dbObj->getCreatedTime());
            //$patient->setPhotoName($dbObj->getPhotoName());
        }else{
            $patient->setCreatedById($_SESSION['userId']);
            $patient->setCreatedTime($now);
        }
        $patient->setModifiedById($_SESSION['userId']);
        $patient->setModifiedTime($now);
        $patient->pushObjectToDB(true);    
        \array_push($msgArr, [$patient->getOpStatus() => $patient->getOpMessage()]);
        //$msg = HtmlHelper::composeToastMessage();       
        if($patient->getOpStatus()){
            $_SESSION['msg'] = HtmlHelper::composeToastMessage($msgArr);
            
            //Irrespective of what happens here; redirect to summary page as patient was successfully saved
            //Use session to make sure user has rights to update patient infornmation.
            //return RedirectResponse::create("/patient/summary/".$_SESSION['patientId']);
        }else{
            //Could not save or update patient details return to registration page
            //Make sure id is cleared all other values can stay (to show in form inputs)
            $patient->setId('');
            \array_push($msgArr,[false => "Could not update patient information"]);
            $_SESSION['msg'] = HtmlHelper::composeToastMessage($msgArr);
            $msg .= $_SESSION['msg'];
            $this->setUpTemplateVars($patient, $msg);
           // return RedirectResponse::create("/patient/summary/".$_SESSION['patientId']);
            //return new Response($this->_health->display($this->template));
        }
        return RedirectResponse::create("/patient/summary/".$_SESSION['patientId']);
    }

    protected function setUpTemplateVars($obj, $msg = ''){
        $this->_health->assign('patient',$obj);
        $this->_health->assign('msg',$msg);
        $this->_health->assign('currentUsr',(new \Authentication\Model\User())->getObjectById($_SESSION['userId']));
        
        //for registration
        $this->_health->assign('genders',(new \Admin\Model\Gender())->getDropDownArrayOrder('name', 'name', 'ASC'));
        $this->_health->assign('religions',(new \Admin\Model\Religion())->getDropDownArrayOrder('name', 'name', 'ASC'));
        $this->_health->assign('ethnicities',(new \Admin\Model\Ethnicity())->getDropDownArrayOrder('name', 'name', 'ASC'));
        $this->_health->assign("countries",(new \Admin\Model\Country())->getDropDownArrayOrder("name","name","ASC"));
        
        $this->_health->assign('html',$this->html);
        $this->_health->assign('title','Patient Summary');
        $this->_health->assign('actionPage',$this->actionPage);
    }
    
}
