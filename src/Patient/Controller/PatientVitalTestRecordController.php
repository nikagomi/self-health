<?php

namespace Patient\Controller;

use Neptune\{ModifiableBaseController, HtmlHelper, DbMapperUtility};
use Authentication\Model\PermissionManager;
use Symfony\Component\HttpFoundation\{Request, Response, RedirectResponse};

/**
 * PatientVitalTestRecordController
 * @package self-health
 * @author Randal Neptune
 */
class PatientVitalTestRecordController extends ModifiableBaseController {
    protected $modelClass = "\Patient\Model\PatientVitalTestRecord";
    protected $template = "self_report/patientVitals.tpl";
    private $actionPage = "/patient/vitals/save";
    
    public function save(Request $request){
        $pvr = (new $this->modelClass())->mapFormToEntity($request->request);
        $now = \date("Y-m-d H:i:s");
        if($request->request->get("id") != ''){//an edit
            $dbObj = (new $this->modelClass())->getEntityById($request->request->get("id"));
            $pvr->setCreatedById($dbObj->getCreatedById());
            $pvr->setCreatedTime($dbObj->getCreatedTime());
        }else{
            $pvr->setCreatedById($_SESSION['userId']);
            $pvr->setCreatedTime($now);
        }
        $pvr->setModifiedById($_SESSION['userId']);
        $pvr->setModifiedTime($now);
        $pvr->pushObjectToDB(true);
        if ($pvr->getOpStatus()) {//Container record saved
            $vitalTests = (new \Clinical\Model\VitalTest())->getAll();
            $testIds = [];
            $testResults = [];
            
            foreach ($vitalTests as $vt) {
                if (\trim($request->request->get("vt_".$vt->getId())) != '') {
                    \array_push($testIds, $vt->getId());
                    \array_push($testResults, \trim($request->request->get("vt_".$vt->getId())));
                }
            }
            $result = (new \Patient\Model\PatientVitalTestRecordItem())->recordVitalTestItems($pvr->getId(), $testIds, $testResults);
            $txt = ($result) ? "The vital signs were successfully recorded." : "An error occurred. COuld not record the vital signs. Please try again later";
            if (!$result) {
                $pvr->delete();
            } else {
                $pvr->clear();
            }
            $msg = HtmlHelper::composeToastMessage([$result => $txt]);
        } else {
            $msg = HtmlHelper::composeToastMessage([$pvr->getOpStatus() => $pvr->getOpMessage()]);
        }
        $this->setUpTemplateVars($pvr, $msg);
        return new Response($this->_health->display($this->template));
    }
    
    public function delete($id) {
        $pvr = (new $this->modelClass())->getObjectById($id);
        if ($pvr->getPatientId() == $_SESSION['patientId']) {
            $sql = '';
            $sql .= $pvr->generateDeleteSql();
            $items = $pvr->getItems();
            foreach ($items as $item) {
                $sql .= $item->generateDeleteSql();
            }
            $result = DbMapperUtility::dbQuery("BEGIN TRANSACTION; " .$sql ." COMMIT;");
            $txt  = ($result !== false) ? "The vital signs record was successfully deleted" : "Could not delete the vital signs record. Please try again later.";
            $msg = HtmlHelper::composeToastMessage([($result !== false) => $txt]);
        } else {
            $msg = HtmlHelper::composeToastMessage([FALSE => "This indicated entity does not belong to the patient associated to your user account."]);
            $pvr->clear();
        }
        $this->setUpTemplateVars($pvr, $msg);
        return new Response($this->_health->display($this->template));
    }
    
    public function viewPatientVitals ($patientId) {
        $patient = (new \Patient\Model\Patient())->getObjectById($patientId);
        if (!$patient->isIdEmpty() && ($_SESSION['patientId'] == $patientId || PermissionManager::userHasPermission("SEARCH.PATIENTS", $_SESSION['userId']))) {
            $this->_health->assign('vitals', (new $this->modelClass())->getByPatientId($patientId));
            $this->_health->assign('html',$this->html);
            $this->_health->assign('bpTests', (new \Clinical\Model\VitalTest())->getBPTests());
            $this->_health->assign('nonBPTests', (new \Clinical\Model\VitalTest())->getNonBPTests());
            $this->_health->assign('item', new \Patient\Model\PatientVitalTestRecordItem());
            return new Response($this->_health->display("patient/vitalSigns.tpl"));
        } else {
            return new RedirectResponse("/access/denied/simple");
        }
    }
    
    protected function setUpTemplateVars($obj, $msg = ''){
        $this->_health->assign('patientVital',$obj);
        $this->_health->assign('patient', (new \Patient\Model\Patient())->getObjectById($_SESSION['patientId']));
        $this->_health->assign('msg',$msg);
        $this->_health->assign('list',$obj->getByPatientId($_SESSION['patientId']));
        $this->_health->assign('html',$this->html);
        $this->_health->assign('patientPositions', ["" => "", "Standing" => "Standing", "Sitting" => "Sitting", "Lying Down" => "Lying Down"]);
        $this->_health->assign('title','Record Vital Readings');
        $this->_health->assign('bpTests', (new \Clinical\Model\VitalTest())->getBPTests());
        $this->_health->assign('nonBPTests', (new \Clinical\Model\VitalTest())->getNonBPTests());
        $this->_health->assign('item', new \Patient\Model\PatientVitalTestRecordItem());
        $this->_health->assign('actionPage',$this->actionPage);
    }
}
