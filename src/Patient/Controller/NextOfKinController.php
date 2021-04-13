<?php

namespace Patient\Controller;

use Neptune\{BaseController, DbMapperUtility};
use Authentication\Model\PermissionManager;
use Symfony\Component\HttpFoundation\{Request, Response, RedirectResponse};

/**
 * NextOfKinController
 * @package self-health
 * @author Randal Neptune
 */
class NextOfKinController extends BaseController {
    protected $modelClass = "\Patient\Model\NextOfKin";
    protected $template = "patient/nextOfKin.tpl";
    private $actionPage = "/next/of/kin/save";
    
    public function viewPatientNextOfKin ($patientId) {
        $patient = (new \Patient\Model\Patient())->getObjectById($patientId);
        if (!$patient->isIdEmpty() && ($_SESSION['patientId'] == $patientId || PermissionManager::userHasPermission("SEARCH.PATIENTS", $_SESSION['userId']))) {
            $this->_health->assign('nextOfKins', (new $this->modelClass())->getByPatientId($patientId));
            $this->_health->assign('html',$this->html);
            
            return new Response($this->_health->display("patient/nextOfKinView.tpl"));
        } else {
            return new RedirectResponse("/access/denied/simple");
        }
    }
    
    protected function setUpTemplateVars($obj, $msg = ''){
        $this->_health->assign('nextOfKin',$obj);
        $this->_health->assign('msg',$msg);
        $this->_health->assign('list',$obj->getByPatientId($_SESSION['patientId']));
        $this->_health->assign('html',$this->html);
        $this->_health->assign('relationshipTypeIds', DbMapperUtility::convertObjectArrayToDropDown((new \Admin\Model\RelationshipType())->getAllOrderBy("name")));
        $this->_health->assign('title','Record Patient Next of KIns');
        $this->_health->assign('actionPage',$this->actionPage);
    }
}
