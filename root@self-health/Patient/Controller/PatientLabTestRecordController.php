<?php

namespace Patient\Controller;


use Neptune\{ModifiableBaseController, DbMapperUtility, HtmlHelper};
use Authentication\Model\PermissionManager;
use Symfony\Component\HttpFoundation\{Request, Response, RedirectResponse};

/**
 * PatientLabTestResultController
 * @pckage self-health
 * @author Randal Neptune
 */
class PatientLabTestRecordController extends ModifiableBaseController {
    protected $modelClass = "\Patient\Model\PatientLabTestRecord";
    protected $template = "self_report/patientLabRecord.tpl";
    private $actionPage = "/patient/lab/record/save";
    
    public function save(Request $request){
        $ltr = (new $this->modelClass())->mapFormToEntity($request->request);
        $now = \date("Y-m-d H:i:s");
        if($request->request->get("id") != ''){//an edit
            $dbObj = (new $this->modelClass())->getEntityById($request->request->get("id"));
            $ltr->setCreatedById($dbObj->getCreatedById());
            $ltr->setCreatedTime($dbObj->getCreatedTime());
        }else{
            $ltr->setCreatedById($_SESSION['userId']);
            $ltr->setCreatedTime($now);
        }
        $ltr->setModifiedById($_SESSION['userId']);
        $ltr->setModifiedTime($now);
        $ltr->pushObjectToDB(true);
        if ($ltr->getOpStatus()) {//Container record saved
            $results = [];
            $labTestIds = ($request->request->has("labTestId")) ? $request->request->get("labTestId") : [];
            foreach ($labTestIds as $labTestId) {
                \array_push($results, $request->request->get("result_".$labTestId));
            }
            
            $result = (new \Patient\Model\PatientLabTestResult())->recordLabTestResults($ltr->getId(), $labTestIds, $results);
            $txt = ($result) ? "The lab test results were successfully recorded." : "An error occurred. Could not record the lab test results. Please try again later";
            if (!$result) {
                $ltr->delete();
            } else {
                $ltr->clear();
            }
            $msg = HtmlHelper::composeToastMessage([$result => $txt]);
        } else {
            $msg = HtmlHelper::composeToastMessage([$ltr->getOpStatus() => $ltr->getOpMessage()]);
        }
        $this->setUpTemplateVars($ltr, $msg);
        return new Response($this->_health->display($this->template));
    }
    
    public function delete($id) {
        $ltr = (new $this->modelClass())->getObjectById($id);
        if ($ltr->getPatientId() == $_SESSION['patientId']) {
            $sql = '';
            $sql .= $ltr->generateDeleteSql();
            $results = $ltr->getLabTestResults();
            foreach ($results as $res) {
                $sql .= $res->generateDeleteSql();
            }
            $result = DbMapperUtility::dbQuery("BEGIN TRANSACTION; " .$sql ." COMMIT;");
            $txt  = ($result !== false) ? "The lab test result record was successfully deleted" : "Could not delete the lab test result record. Please try again later.";
            $msg = HtmlHelper::composeToastMessage([($result !== false) => $txt]);
        } else {
            $msg = HtmlHelper::composeToastMessage([FALSE => "This indicated lab test record does not belong to the patient associated to your user account."]);
            $ltr->clear();
        }
        $this->setUpTemplateVars($ltr, $msg);
        return new Response($this->_health->display($this->template));
    }
    
    public function viewPatienLabResults($patientId) {
        $patient = (new \Patient\Model\Patient())->getObjectById($patientId);
        if (!$patient->isIdEmpty() && ($_SESSION['patientId'] == $patientId || PermissionManager::userHasPermission("SEARCH.PATIENTS", $_SESSION['userId']))) {
            $this->_health->assign('results', (new $this->modelClass())->getByPatientId($patientId));
            $this->_health->assign('html',$this->html);
            $this->_health->assign('labTests', (new \Clinical\Model\LabTest())->getAllOrderBy("name"));
            $this->_health->assign('labTestResult', new \Patient\Model\PatientLabTestResult());
            return new Response($this->_health->display("patient/labResults.tpl"));
        } else {
            return new RedirectResponse("/access/denied/simple");
        }
    }
    
    protected function setUpTemplateVars($obj, $msg = ''){
        $this->_health->assign('patientLabRecord', $obj);
        $this->_health->assign('msg',$msg);
        $this->_health->assign('list',$obj->getByPatientId($_SESSION['patientId']));
        $this->_health->assign('html',$this->html);
        $this->_health->assign('labTests', (new \Clinical\Model\LabTest())->getAllOrderBy("name"));
        $this->_health->assign('title','Record Lab Test Results');
        $this->_health->assign('labTestResult', new \Patient\Model\PatientLabTestResult());
        $this->_health->assign('associatedLabTests', $obj->getLabTests());
        $this->_health->assign('actionPage',$this->actionPage);
    }
}
