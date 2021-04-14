<?php

namespace SelfReport\Controller;

use Neptune\{ModifiableBaseController, DbMapperUtility};
use Authentication\Model\PermissionManager;
use Symfony\Component\HttpFoundation\{Request, Response, RedirectResponse};

/**
 * PatientPhysicalActivityController
 * @package self-health
 * @author Randal Neptune
 */
class PatientPhysicalActivityController extends ModifiableBaseController {
    protected $modelClass = "\SelfReport\Model\PatientPhysicalActivity";
    protected $template = "self_report/patientPhysicalActivity.tpl";
    private $actionPage = "/patient/physical/activity/save";
    
    public function viewPatientPhysicalActvities ($patientId) {
        $patient = (new \Patient\Model\Patient())->getObjectById($patientId);
        if (!$patient->isIdEmpty() && ($_SESSION['patientId'] == $patientId || PermissionManager::userHasPermission("SEARCH.PATIENTS", $_SESSION['userId']))) {
            $this->_health->assign('activities', (new $this->modelClass())->getByPatientId($patientId));
            $this->_health->assign('html',$this->html);
            
            return new Response($this->_health->display("patient/physicalActivityView.tpl"));
        } else {
            return new RedirectResponse("/access/denied/simple");
        }
    }
    
    protected function setUpTemplateVars($obj, $msg = ''){
        $this->_health->assign('patientPhysicalActivity',$obj);
        $this->_health->assign('msg',$msg);
        $this->_health->assign('list',$obj->getByPatientId($_SESSION['patientId']));
        $this->_health->assign('html',$this->html);
        $this->_health->assign('physicalActivityIds', DbMapperUtility::convertObjectArrayToDropDown((new \Admin\Model\PhysicalActivity())->getAllOrderBy("name")));
        $this->_health->assign('title','Record Patient Physical Activities');
        $this->_health->assign('actionPage',$this->actionPage);
    }
}
