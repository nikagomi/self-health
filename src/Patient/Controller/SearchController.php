<?php

namespace Patient\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Neptune\{BaseController, DbMapperUtility, PropertyService};
use \Authentication\Model\PermissionManager;

/**
 * Description of SearchController
 * @package smile
 * @author Randal Neptune
 */
class SearchController extends BaseController{
    protected $modelClass = "\Patient\Model\Patient";
    protected $template = "patient/search.tpl";
    private $actionPage = "/patient/search";
    
    
    public function setForm(){
        $this->setTemplateVariables("");
        $this->_health->assign("searchResults",[]);
        $response = new Response($this->_health->display($this->template));
        return $response;
    }
    
    protected function setTemplateVariables($msg){
        $this->_health->assign("genders",(new \Admin\Model\Gender())->getAllOrderBy("name"));
        $this->_health->assign("countries", DbMapperUtility::convertObjectArrayToDropDown((new \Admin\Model\Country())->getAllOrderBy("name")));
        $this->_health->assign("msg",$msg);
        $this->_health->assign("title","Patient Search");
        $this->_health->assign('actionPage',$this->actionPage);
    }
    
    
    
    public function search(Request $request){
        $genderId = $request->request->get("genderId");
        $firstName = \trim($request->request->get("firstName"));
        $lastName = \trim($request->request->get("lastName"));
        //$facilityId = $request->request->get("facilityId");
        //$registrationNumber = $request->request->get("registrationNumber");
        $countryId = $request->request->get("countryId");
        $ageStart = $request->request->get("aStart");
        $ageEnd = $request->request->get("aEnd");
        
        /*$searchResults = [];
        if (\trim($registrationNumber) != "") {
            
            $singlePatient = (new $this->modelClass())->getObjectById(\strtoupper(\trim($registrationNumber)));
            if (!$singlePatient->isIdEmpty()) {
                $searchResults[0] = $singlePatient;
            }
        } else {*/
            $limit = PropertyService::getProperty("maximum.returned.search.results","200");
            $searchResults = (new $this->modelClass())->search($firstName, $lastName, $countryId,$genderId, $limit, $ageStart, $ageEnd);
       // }
        $this->_health->assign("searchResults",$searchResults);
        
        // - Guarantee that if there is only one result, that we can go to automatic view only if: commented section below (By-passed for now)
        if (\count($searchResults) == 2){ 
            $patient = $searchResults[0];
            
            //- Create one result search message
            $msg = '';
            if (PermissionManager::userHasPermission("SEARCH.PATIENTS", $_SESSION['userId'])) {
                $msg .= "<div style='color:#444;font-family:Arial;margin-left:25px;margin-bottom:10px;font-weight:bold;font-variant:small-caps;'>";;
                $msg .= "Only <span style='color:green;'>ONE</span> result was found. If this is not the correct patient you can <a style='font-weight:bold;' href='/patient/search/form'>search again</a>";
                $msg .= "</div>";
            }
            
            (new \Patient\Controller\PatientController())->setUpTemplateVars($patient, $msg);
            return new Response($this->_health->display("patient/main.tpl"));
        }else{
            $this->_health->assign("searched",true);
            //Assign variables to template so user knows what was searched for
            $this->_health->assign("firstName",$firstName);
            $this->_health->assign("lastName",$lastName);
            $this->_health->assign("countryId",$countryId);
            $this->_health->assign("genderId",$genderId);
            $this->_health->assign("aStart",$ageStart);
            $this->_health->assign("aEnd",$ageEnd);
        }
            
        $this->setTemplateVariables("");
        return new Response($this->_health->display($this->template));
    }
    
    /*public function searchAll (){
        $limit = 0; //PropertyService::getProperty("maximum.returned.search.results","200");
        $searchResults = (new $this->modelClass())->getAllOrderByWithLimit("lastName", true, $limit);
        $this->_edu->assign("searchResults",$searchResults);
        $this->_edu->assign("searched",true);
        $this->setTemplateVariables("");
        return new Response($this->_edu->display($this->template));
        
    }*/
}
