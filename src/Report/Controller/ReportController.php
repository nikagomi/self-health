<?php

namespace Report\Controller;

use Neptune\BaseController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Neptune\{DbMapperUtility, Config};
use Authentication\Model\PermissionManager;

/**
 * ReportController
 * @package self-health
 * @author Randal Neptune
 */
class ReportController extends BaseController {
    
    public function patientDistributionDetailForm(){
        $this->_health->assign('actionPage',"/report/patient/distribution/details");
        $this->_health->assign("countryIds", DbMapperUtility::convertObjectArrayToDropDown((new \Admin\Model\Country())->getAllOrderBy("name")));
        $this->_health->assign("ageRangeIds", DbMapperUtility::convertObjectArrayToDropDown((new \Utility\Model\AgeRange())->getAllOrderBy("name"), "All"));
        $this->_health->assign("genderIds", DbMapperUtility::convertObjectArrayToDropDown((new \Admin\Model\Gender())->getAllOrderBy("name"),"All"));
        $this->_health->assign('html',$this->html);
        $this->_health->assign('title',"Patient Distribution Detail Report");
        
        return new Response($this->_health->display("report/patientDistributionDetail.tpl"));
    }
    
    public function patientDistributionDetail(Request $request){
        $this->_health->assign('actionPage',"/report/patient/distribution/details");
        $this->_health->assign("countryIds", DbMapperUtility::convertObjectArrayToDropDown((new \Admin\Model\Country())->getAllOrderBy("name")));
        $this->_health->assign("ageRangeIds", DbMapperUtility::convertObjectArrayToDropDown((new \Utility\Model\AgeRange())->getAllOrderBy("name"), "All"));
        $this->_health->assign("genderIds", DbMapperUtility::convertObjectArrayToDropDown((new \Admin\Model\Gender())->getAllOrderBy("name"),"All"));
        $this->_health->assign('html', $this->html);
        $this->_health->assign('title',"Patient Distribution Detail Report");
        
        $countryId = $request->query->get("countryId");
        $genderId = $request->query->get("genderId");
        $ageRangeId = $request->query->get("ageRangeId");
        
        if ($ageRangeId != '') {
            $ageRange = (new \Utility\Model\AgeRange())->getObjectById($ageRangeId);
            $ageRangeClause = " AND EXTRACT(YEAR FROM age(date_of_birth)) <= ".$ageRange->getUpperLimit()." AND EXTRACT(YEAR FROM age(date_of_birth)) >= ".$ageRange->getLowerLimit();
        } else {
            $ageRangeClause = "";
        }
        
        $genderClause = ($genderId != '') ? " AND gender_id = '".$genderId."' " : "";
        
        $patients = [];
        $sql = "SELECT patient_id FROM patients WHERE country_id = '".$countryId."' ". $ageRangeClause. $genderClause;
        $sql .= " AND alive = true";
        //echo $sql;
       
        $result = DbMapperUtility::dbQuery($sql);
        if (DbMapperUtility::dbNumRows($result) > 0) {
            while ($res = DbMapperUtility::dbFetchArray($result)) {
                \array_push($patients, (new \Patient\Model\Patient())->getObjectById($res[0]));
            }
        }
        
        $this->_health->assign('patients', $patients);
        $this->_health->assign('submit', 1); 
        $this->_health->assign('countryId', $countryId); 
        $this->_health->assign('ageRangeId', $ageRangeId); 
        $this->_health->assign('genderId', $genderId); 
            
        return new Response($this->_health->display("report/patientDistributionDetail.tpl"));
    }
    
    public function patientSmokingDrinkingForm(){
        $this->_health->assign('actionPage',"/report/patient/smoking/drinking");
        $this->_health->assign("countryIds", DbMapperUtility::convertObjectArrayToDropDown((new \Admin\Model\Country())->getAllOrderBy("name")));
        $this->_health->assign("ageRangeIds", DbMapperUtility::convertObjectArrayToDropDown((new \Utility\Model\AgeRange())->getAllOrderBy("name"), "All"));
        $this->_health->assign("genderIds", DbMapperUtility::convertObjectArrayToDropDown((new \Admin\Model\Gender())->getAllOrderBy("name"),"All"));
        $this->_health->assign('html',$this->html);
        $this->_health->assign('title',"Patient Smokers/Drinkers Report");
        
        return new Response($this->_health->display("report/patientSmokingDrinking.tpl"));
    }
    
    public function patientSmokingDrinking(Request $request){
        $this->_health->assign('actionPage',"/report/patient/smoking/drinking");
        $this->_health->assign("countryIds", DbMapperUtility::convertObjectArrayToDropDown((new \Admin\Model\Country())->getAllOrderBy("name")));
        $this->_health->assign("ageRangeIds", DbMapperUtility::convertObjectArrayToDropDown((new \Utility\Model\AgeRange())->getAllOrderBy("name"), "All"));
        $this->_health->assign("genderIds", DbMapperUtility::convertObjectArrayToDropDown((new \Admin\Model\Gender())->getAllOrderBy("name"),"All"));
        $this->_health->assign('html', $this->html);
        $this->_health->assign('title',"Patient Smokers/Drinkers Report");
        
        $countryId = $request->request->get("countryId");
        $genderId = $request->request->get("genderId");
        $ageRangeId = $request->request->get("ageRangeId");
        $asOfDateObj = \DateTime::createFromFormat("M d, Y", $request->request->get("asOfDate"));
        
        if ($ageRangeId != '') {
            $ageRange = (new \Utility\Model\AgeRange())->getObjectById($ageRangeId);
            $ageRangeClause = " AND EXTRACT(YEAR FROM age(p.date_of_birth)) <= ".$ageRange->getUpperLimit()." AND EXTRACT(YEAR FROM age(p.date_of_birth)) >= ".$ageRange->getLowerLimit();
        } else {
            $ageRangeClause = "";
        }
        
        $genderClause = ($genderId != '') ? " AND p.gender_id = '".$genderId."' " : "";
        
        $patients = [];
        $sql = "SELECT p.patient_id FROM patients p, patient_smoking_drinking_statuses psds WHERE p.country_id = '".$countryId."' ". $ageRangeClause. $genderClause;
        $sql .= " AND p.alive = true AND psds.patient_id = p.patient_id AND ( (psds.drinker = true AND (psds.stopped_drinking = false OR (psds.stopped_drinking = true AND psds.stop_drinking_date >= '".$asOfDateObj->format("Y-m-d")."'))) ";
        $sql .= " OR (psds.smoker = true AND (psds.stopped_smoking = false OR (psds.stopped_smoking = true AND psds.stop_smoking_date >= '".$asOfDateObj->format("Y-m-d")."'))) )";
        //echo $sql;
       
        $result = DbMapperUtility::dbQuery($sql);
        if (DbMapperUtility::dbNumRows($result) > 0) {
            while ($res = DbMapperUtility::dbFetchArray($result)) {
                \array_push($patients, (new \Patient\Model\Patient())->getObjectById($res[0]));
            }
        }
        
        $this->_health->assign('patients', $patients);
        $this->_health->assign('submit', 1); 
        $this->_health->assign('countryId', $countryId); 
        $this->_health->assign('asOfDate', $request->request->get("asOfDate"));
        $this->_health->assign('ageRangeId', $ageRangeId); 
        $this->_health->assign('genderId', $genderId); 
        $this->_health->assign('compareDate', $asOfDateObj->format("Y-m-d")); 
            
        return new Response($this->_health->display("report/patientSmokingDrinking.tpl"));
    }
    
    public function patientPhysicalActivityForm(){
        $this->_health->assign('actionPage',"/report/patient/physical/activity");
        $this->_health->assign("countryIds", DbMapperUtility::convertObjectArrayToDropDown((new \Admin\Model\Country())->getAllOrderBy("name")));
        $this->_health->assign("ageRangeIds", DbMapperUtility::convertObjectArrayToDropDown((new \Utility\Model\AgeRange())->getAllOrderBy("name"), "All"));
        $this->_health->assign("genderIds", DbMapperUtility::convertObjectArrayToDropDown((new \Admin\Model\Gender())->getAllOrderBy("name"),"All"));
        $this->_health->assign("physicalActivityIds", DbMapperUtility::convertObjectArrayToDropDown((new \Admin\Model\PhysicalActivity())->getAllOrderBy("name"),"All"));
        $this->_health->assign('html',$this->html);
        $this->_health->assign('title',"Patient Physical Activity Report");
        
        return new Response($this->_health->display("report/patientPhysicalActivity.tpl"));
    }
    
     public function patientPhysicalActivity(Request $request){
        $this->_health->assign('actionPage',"/report/patient/physical/activity");
        $this->_health->assign("countryIds", DbMapperUtility::convertObjectArrayToDropDown((new \Admin\Model\Country())->getAllOrderBy("name")));
        $this->_health->assign("ageRangeIds", DbMapperUtility::convertObjectArrayToDropDown((new \Utility\Model\AgeRange())->getAllOrderBy("name"), "All"));
        $this->_health->assign("genderIds", DbMapperUtility::convertObjectArrayToDropDown((new \Admin\Model\Gender())->getAllOrderBy("name"),"All"));
        $this->_health->assign("physicalActivityIds", DbMapperUtility::convertObjectArrayToDropDown((new \Admin\Model\PhysicalActivity())->getAllOrderBy("name"),"All"));
        $this->_health->assign('html', $this->html);
        $this->_health->assign('title',"Patient Smokers/Drinkers Report");
        
        $countryId = $request->request->get("countryId");
        $genderId = $request->request->get("genderId");
        $ageRangeId = $request->request->get("ageRangeId");
        $physicalActivityId = $request->request->get("physicalActivityId");
        $dStart = (\trim($request->request->get("dStart")) != '') ? \trim($request->request->get("dStart")) : '';
        $dEnd = (\trim($request->request->get("dEnd")) != '') ? \trim($request->request->get("dEnd")) : '';
        
        
        if ($ageRangeId != '') {
            $ageRange = (new \Utility\Model\AgeRange())->getObjectById($ageRangeId);
            $ageRangeClause = " AND EXTRACT(YEAR FROM age(p.date_of_birth)) <= ".$ageRange->getUpperLimit()." AND EXTRACT(YEAR FROM age(p.date_of_birth)) >= ".$ageRange->getLowerLimit();
        } else {
            $ageRangeClause = "";
        }
        
        $genderClause = ($genderId != '') ? " AND p.gender_id = '".$genderId."' " : "";
        $physicalActivityClause = ($physicalActivityId != '') ? " AND pa.physical_activity_id = '".$physicalActivityId."' " : '';
        $durationClause = ($dStart != '' && $dEnd != '') ? " AND pa.duration_in_minutes >= ".$dStart." AND pa.duration_in_minutes <= ".$dEnd : '';
        
        $phyActs = [];
        $sql = "select pa.patient_physical_activity_id FROM patient_physical_activities pa, patients p WHERE p.patient_id = pa.patient_id AND p.country_id = '".$countryId."' AND pa.alive = true AND p.alive = true ";
        $sql .=  $durationClause. $ageRangeClause. $genderClause . $physicalActivityClause;
        echo $sql;
       
        $result = DbMapperUtility::dbQuery($sql);
        if (DbMapperUtility::dbNumRows($result) > 0) {
            while ($res = DbMapperUtility::dbFetchArray($result)) {
                \array_push($phyActs, (new \SelfReport\Model\PatientPhysicalActivity())->getObjectById($res[0]));
            }
        }
        
        $this->_health->assign('phyActs', $phyActs);
        $this->_health->assign('submit', 1); 
        $this->_health->assign('countryId', $countryId); 
        $this->_health->assign('ageRangeId', $ageRangeId); 
        $this->_health->assign('genderId', $genderId); 
        $this->_health->assign('physicalActivityId', $physicalActivityId); 
        $this->_health->assign('dStart', $dStart);
        $this->_health->assign('dEnd', $dEnd); 
            
        return new Response($this->_health->display("report/patientPhysicalActivity.tpl"));
    }
}
