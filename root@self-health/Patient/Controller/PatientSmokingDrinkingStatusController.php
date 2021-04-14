<?php

namespace Patient\Controller;

use Neptune\{BaseController, HtmlHelper};
use Symfony\Component\HttpFoundation\{Request, Response, RedirectResponse};
use \Authentication\Model\PermissionManager;

/**
 * PatientSmokingDrinkingStatusController
 * @package self-health
 * @author Randal Neptune
 */
class PatientSmokingDrinkingStatusController extends BaseController {
    protected $modelClass = "\Patient\Model\PatientSmokingDrinkingStatus";
    protected $template = "self_report/patientSmokingDrinkingStatus.tpl";
    private $actionPage = "/patient/smoking/drinking/status/save";
    protected $viewTemplate = "self_report/patientSmokingDrinkingStatusView.tpl";
    
    public function form (Request $request){
        $obj = (new $this->modelClass())->getByPatientId($_SESSION['patientId']);
        if ($obj->isIdEmpty()) {
            $this->setUpTemplateVars(new $this->modelClass());
            return new Response($this->_health->display($this->template));
        } else {
            $this->_health->assign('patientSmokingDrinkingStatus', $obj);
            $this->_health->assign('html',$this->html);
            $this->_health->assign('title','View Smoking/Drinking Status');
            return new Response($this->_health->display($this->viewTemplate));
        }
    }
    
    public function view($id) {
        $obj = (new $this->modelClass())->getObjectById($id);
        if ($obj->getPatientId() == $_SESSION['patientId']) {
            $this->_health->assign('patientSmokingDrinkingStatus', $obj);
            $this->_health->assign('html',$this->html);
            $this->_health->assign('title','View Smoking/Drinking Status');
            return new Response($this->_health->display($this->viewTemplate));
        } else {
            return new RedirectResponse("/access/denied");
        }
    }
    
    public function edit(Request $request, $id){
        $obj = (new $this->modelClass())->getObjectById($id);
        if ($obj->getPatientId() == $_SESSION['patientId']) {
            $this->setUpTemplateVars($obj);
            return new Response($this->_health->display($this->template));
        }else{
            return new RedirectResponse("/access/denied"); 
        }
    }
    
    public function save(Request $request){
        $obj = (new $this->modelClass())->mapFormToEntity($request->request);
        
        $obj->pushObjectToDB(true);     
        
        $msg = HtmlHelper::composeToastMessage([$obj->getOpStatus() => $obj->getOpMessage()]);
        if($obj->getOpStatus()){
            $this->_health->assign('patientSmokingDrinkingStatus', $obj);
            $this->_health->assign('msg', $msg);
            $this->_health->assign('html',$this->html);
            $this->_health->assign('title','View Smoking/Drinking Status');
            return new Response($this->_health->display($this->viewTemplate)); 
        } else {
            $this->setUpTemplateVars($obj, $msg);
            return new Response($this->_health->display($this->template));
        }
    }
    
    public function viewPatientSmokingDrinkingStatus ($patientId) {
        $patient = (new \Patient\Model\Patient())->getObjectById($patientId);
        if (!$patient->isIdEmpty() && ($_SESSION['patientId'] == $patientId || PermissionManager::userHasPermission("SEARCH.PATIENTS", $_SESSION['userId']))) {
            $this->_health->assign('patientSmokingDrinkingStatus', (new $this->modelClass())->getByPatientId($patientId));
            $this->_health->assign('html',$this->html);
            return new Response($this->_health->display("patient/smokingDrinkingStatus.tpl"));
        } else {
            return new RedirectResponse("/access/denied/simple");
        }
    }
    
    protected function setUpTemplateVars($obj, $msg = ''){
        $this->_health->assign('patientSmokingDrinkingStatus', $obj);
        $this->_health->assign('msg',$msg);
        $this->_health->assign('intervals', ["" => "Please select", "days" => "Days", "weeks" => "weeks", "months" => "Months", "years" => "Years"]);
        $this->_health->assign('frequencies', ["" => "Please select", "Rarely" => "Rarely", "Often" => "Often", "Frequently" => "Frequently", "Daily" => "Daily"]);
        $this->_health->assign('html',$this->html);
        $this->_health->assign('title','Record Smoking/Drinking Status');
        $this->_health->assign('actionPage',$this->actionPage);
    }
}
