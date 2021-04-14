<?php

namespace Patient\Controller;

use Neptune\{BaseController, DbMapperUtility};
use Authentication\Model\PermissionManager;
use Symfony\Component\HttpFoundation\{Request, Response, RedirectResponse};

/**
 * Description of PatientCovid19VaccinationController
 * @package self-health
 * @author Randal Neptune
 */
class PatientCovid19VaccinationController extends BaseController {
    protected $modelClass = "\Patient\Model\PatientCovid19Vaccination";
    protected $template = "patient/covid19.tpl";
    private $actionPage = "/patient/covid19/vaccination/save";
    
    public function viewPatientCovid19Vaccinations ($patientId) {
        $patient = (new \Patient\Model\Patient())->getObjectById($patientId);
        if (!$patient->isIdEmpty() && ($_SESSION['patientId'] == $patientId || PermissionManager::userHasPermission("SEARCH.PATIENTS", $_SESSION['userId']))) {
            $this->_health->assign('covid19Vaccinations', (new $this->modelClass())->getByPatientId($patientId));
            $this->_health->assign('html',$this->html);
            
            return new Response($this->_health->display("patient/covid19View.tpl"));
        } else {
            return new RedirectResponse("/access/denied/simple");
        }
    }
    
    public function getCovid19VaccineDoseCount($id) {
        $vax = (new \Clinical\Model\Covid19Vaccine())->getObjectById($id);
        $response = new Response(\json_encode($vax->getDoseAmount()));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }
    
    private function generateDoseNumberDropDownArr($vax) {
        $arr = [];
        $arr[''] = '';
        if ($vax->getDoseAmount() != ''){
            for($i = 1; $i <= $vax->getDoseAmount(); $i++) {
                $arr[$i] = $i;
            }
        }
        return $arr;
    }
    
    protected function setUpTemplateVars($obj, $msg = ''){
        $this->_health->assign('covid19Vax',$obj);
        $this->_health->assign('msg', $msg);
        $this->_health->assign('list',$obj->getByPatientId($_SESSION['patientId']));
        $this->_health->assign('html',$this->html);
        $this->_health->assign('covid19VaccineIds', DbMapperUtility::convertObjectArrayToDropDown((new \Clinical\Model\Covid19Vaccine())->getAllOrderBy("manufacturer")));
        $this->_health->assign('doseNumbers', $this->generateDoseNumberDropDownArr($obj->getCovid19Vaccine()));
        $this->_health->assign('title','Record Patient Covid19 Vaccinations');
        $this->_health->assign('actionPage', $this->actionPage);
    }
}
