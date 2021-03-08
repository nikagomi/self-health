<?php
namespace Patient\Controller;

use Neptune\{ModifiableBaseController, HtmlHelper, DbMapperUtility};
use Authentication\Model\PermissionManager;
use Symfony\Component\HttpFoundation\{Request, Response, RedirectResponse};

/**
 * PatientMealRecordController
 * @package self-health
 * @author Randal Neptune
 */
class PatientMealRecordController extends ModifiableBaseController {
    protected $modelClass = "\Patient\Model\PatientMealRecord";
    protected $template = "self_report/patientMealRecord.tpl";
    private $actionPage = "/patient/meal/record/save";
    
    public function save(Request $request){
        $pmr = (new $this->modelClass())->mapFormToEntity($request->request);
        $now = \date("Y-m-d H:i:s");
        if($request->request->get("id") != ''){//an edit
            $dbObj = (new $this->modelClass())->getEntityById($request->request->get("id"));
            $pmr->setCreatedById($dbObj->getCreatedById());
            $pmr->setCreatedTime($dbObj->getCreatedTime());
        }else{
            $pmr->setCreatedById($_SESSION['userId']);
            $pmr->setCreatedTime($now);
        }
        $pmr->setModifiedById($_SESSION['userId']);
        $pmr->setModifiedTime($now);
        $pmr->pushObjectToDB(true);
        if ($pmr->getOpStatus()) {//Container record saved
            $details = [];
            $foodGroupIds = ($request->request->has("foodGroupId")) ? $request->request->get("foodGroupId") : [];
            foreach ($foodGroupIds as $foodGroupId) {
                \array_push($details, $request->request->get("detail_".$foodGroupId));
            }
            
            $result = (new \Patient\Model\PatientMealRecordFoodGroup())->recordMealFoodGroups($pmr->getId(), $foodGroupIds, $details);
            $txt = ($result) ? "The meal details were successfully recorded." : "An error occurred. Could not record the meal details. Please try again later";
            if (!$result) {
                $pmr->delete();
            } else {
                $pmr->clear();
            }
            $msg = HtmlHelper::composeToastMessage([$result => $txt]);
        } else {
            $msg = HtmlHelper::composeToastMessage([$pmr->getOpStatus() => $pmr->getOpMessage()]);
        }
        $this->setUpTemplateVars($pmr, $msg);
        return new Response($this->_health->display($this->template));
    }
    
    public function delete($id) {
        $pmr = (new $this->modelClass())->getObjectById($id);
        if ($pmr->getPatientId() == $_SESSION['patientId']) {
            $sql = '';
            $sql .= $pmr->generateDeleteSql();
            $items = $pmr->getAssociatedFoodGroups();
            foreach ($items as $item) {
                $sql .= $item->generateDeleteSql();
            }
            $result = DbMapperUtility::dbQuery("BEGIN TRANSACTION; " .$sql ." COMMIT;");
            $txt  = ($result !== false) ? "The meal record was successfully deleted" : "Could not delete the meal record. Please try again later.";
            $msg = HtmlHelper::composeToastMessage([($result !== false) => $txt]);
        } else {
            $msg = HtmlHelper::composeToastMessage([FALSE => "This indicated meal record does not belong to the patient associated to your user account."]);
            $pmr->clear();
        }
        $this->setUpTemplateVars($pmr, $msg);
        return new Response($this->_health->display($this->template));
    }
    
    public function viewPatientMealRecord ($patientId) {
        $patient = (new \Patient\Model\Patient())->getObjectById($patientId);
        if (!$patient->isIdEmpty() && ($_SESSION['patientId'] == $patientId || PermissionManager::userHasPermission("SEARCH.PATIENTS", $_SESSION['userId']))) {
            $this->_health->assign('meals', (new $this->modelClass())->getByPatientId($patientId));
            $this->_health->assign('html',$this->html);
            $this->_health->assign('mealFoodGroup', new \Patient\Model\PatientMealRecordFoodGroup());
            $this->_health->assign('foodGroups', (new \Clinical\Model\FoodGroup())->getAllOrderBy("name"));
            return new Response($this->_health->display("patient/mealRecordView.tpl"));
        } else {
            return new RedirectResponse("/access/denied/simple");
        }
    }
    
    protected function setUpTemplateVars($obj, $msg = ''){
        $this->_health->assign('patientMeal', $obj);
        $this->_health->assign('msg',$msg);
        $this->_health->assign('list',$obj->getByPatientId($_SESSION['patientId']));
        $this->_health->assign('html',$this->html);
        $this->_health->assign('foodGroups', (new \Clinical\Model\FoodGroup())->getAllOrderBy("name"));
        $this->_health->assign('mealTypeIds', DbMapperUtility::convertObjectArrayToDropDown((new \Clinical\Model\MealType())->getAllOrderBy("name")));
        $this->_health->assign('title','Record Meals');
        $this->_health->assign('mealFoodGroup', new \Patient\Model\PatientMealRecordFoodGroup());
        $this->_health->assign('associatedFoodGroups', $obj->getMealFoodGroups());
        $this->_health->assign('actionPage',$this->actionPage);
    }
}
