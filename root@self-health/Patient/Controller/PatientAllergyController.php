<?php

namespace Patient\Controller;

use Neptune\{BaseController, DbMapperUtility};
use Authentication\Model\PermissionManager;
use Symfony\Component\HttpFoundation\{Request, Response, RedirectResponse};

/**
 * PatientAllergyController
 * @package self-health
 * @author Randal Neptune
 */
class PatientAllergyController extends BaseController {
    protected $modelClass = "\Patient\Model\PatientAllergyRecord";
    protected $template = "self_report/patientAllergy.tpl";
    private $actionPage = "/patient/allergy/save";
    
    public function viewPatientAllergies ($patientId) {
        $patient = (new \Patient\Model\Patient())->getObjectById($patientId);
        if (!$patient->isIdEmpty() && ($_SESSION['patientId'] == $patientId || PermissionManager::userHasPermission("SEARCH.PATIENTS", $_SESSION['userId']))) {
            $this->_health->assign('allergies', (new $this->modelClass())->getByPatientId($patientId));
            $this->_health->assign('html',$this->html);
            
            return new Response($this->_health->display("patient/allergyView.tpl"));
        } else {
            return new RedirectResponse("/access/denied/simple");
        }
    }
    
    protected function setUpTemplateVars($obj, $msg = ''){
        $this->_health->assign('patientAllergy',$obj);
        $this->_health->assign('msg',$msg);
        $this->_health->assign('list',$obj->getByPatientId($_SESSION['patientId']));
        $this->_health->assign('html',$this->html);
        $this->_health->assign('allergyTypeIds', DbMapperUtility::convertObjectArrayToDropDown((new \Admin\Model\AllergyType())->getAllOrderBy("name")));
        $this->_health->assign('title','Record Patient Allergies');
        $this->_health->assign('actionPage',$this->actionPage);
    }
}
