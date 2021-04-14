<?php

namespace Patient\Controller;


use Neptune\{BaseController, HtmlHelper, DbMapperUtility};
use Authentication\Model\PermissionManager;
use Symfony\Component\HttpFoundation\{Request, Response, RedirectResponse};

/**
 * PatientChronicDiseaseController
 * @package self-health
 * @author Randal Neptune
 */
class PatientChronicDiseaseController extends BaseController {
    protected $modelClass = "\Patient\Model\PatientChronicDisease";
    protected $template = "self_report/patientChronicDisease.tpl";
    private $actionPage = "/patient/chronic/disease/save";
    
    public function save(Request $request){
        $pcd = (new $this->modelClass())->mapFormToEntity($request->request);
        
        
        $years = [];
        $chronicDiseaseIds = ($request->request->has("chronicDiseaseId")) ? $request->request->get("chronicDiseaseId") : [];
        foreach ($chronicDiseaseIds as $chronicDiseaseId) {
            \array_push($years, $request->request->get("year_".$chronicDiseaseId));
        }

        $result = (new \Patient\Model\PatientChronicDisease())->recordChronicDiseases($request->request->get("patientId"), $chronicDiseaseIds, $years);
        $txt = ($result) ? "The chronic disease(s) were successfully recorded." : "An error occurred. Could not record the chronic disease(s). Please try again later";
        
        $msg = HtmlHelper::composeToastMessage([$result => $txt]);
        
        $this->setUpTemplateVars ((new $this->modelClass()), $msg);
        return new Response($this->_health->display($this->template));
    }
    
    protected function setUpTemplateVars ($obj, $msg = ''){
        $this->_health->assign('patientChronicDisease', $obj);
        $this->_health->assign('msg',$msg);
        
        $this->_health->assign('html',$this->html);
        $this->_health->assign('chronicDiseases', (new \Admin\Model\ChronicDisease())->getAllOrderBy("name"));
        $this->_health->assign('title','Record Chronic Diseases');
        $this->_health->assign('pcd', new \Patient\Model\PatientChronicDisease());
        $this->_health->assign('yearIds', DbMapperUtility::generateYearDropDown(1980));
        $this->_health->assign('associatedChronicDiseases', (new $this->modelClass())->getAssociatedChronicDiseases());
        $this->_health->assign('actionPage',$this->actionPage);
    }
}
