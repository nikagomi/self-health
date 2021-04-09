<?php


namespace Patient\Controller;

use Neptune\{ModifiableBaseController, DbMapperUtility};
use Authentication\Model\PermissionManager;
use Symfony\Component\HttpFoundation\{Request, Response, RedirectResponse};

/**
 * PatientPhysicalActivityController
 * @package self-health
 * @author Randal Neptune
 */
class PatientMedicationController extends ModifiableBaseController {
    protected $modelClass = "\Patient\Model\PatientMedication";
    protected $template = "self_report/patientMedication.tpl";
    private $actionPage = "/patient/medication/save";
    
    public function viewPatientMedications ($patientId) {
        $patient = (new \Patient\Model\Patient())->getObjectById($patientId);
        if (!$patient->isIdEmpty() && ($_SESSION['patientId'] == $patientId || PermissionManager::userHasPermission("SEARCH.PATIENTS", $_SESSION['userId']))) {
            $this->_health->assign('medications', (new $this->modelClass())->getByPatientId($patientId));
            $this->_health->assign('html',$this->html);
            
            return new Response($this->_health->display("patient/medicationView.tpl"));
        } else {
            return new RedirectResponse("/access/denied/simple");
        }
    }
    
    protected function setUpTemplateVars($obj, $msg = ''){
        $this->_health->assign('patientMedication',$obj);
        $this->_health->assign('msg',$msg);
        $this->_health->assign('list',$obj->getByPatientId($_SESSION['patientId']));
        $this->_health->assign('html',$this->html);
        $this->_health->assign('medicationIds', DbMapperUtility::convertObjectArrayToDropDown((new \Admin\Model\Medication())->getAll()));
        $this->_health->assign('quantityTakenUnitIds', DbMapperUtility::convertObjectArrayToDropDown((new \Admin\Model\QuantityTakenUnit())->getAllOrderBy("name")));
        $this->_health->assign('title','Record Patient Medications');
        $this->_health->assign('actionPage',$this->actionPage);
    }

    
}