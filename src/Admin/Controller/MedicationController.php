<?php

namespace Admin\Controller;

use Neptune\{BaseController, DbMapperUtility};

/**
 * MedicationController
 * @package self-health
 * @author Randal Neptune
 */
class MedicationController extends BaseController {
    protected $modelClass = "\Admin\Model\Medication";
    protected $template = "admin/medication.tpl";
    private $actionPage = "/medication/save";
    
    protected function setUpTemplateVars($obj, $msg = ''){
        $this->_health->assign('medication',$obj);
        $this->_health->assign('msg', $msg);
        $this->_health->assign('list',$obj->getAll());
        $this->_health->assign('html',$this->html);
        $this->_health->assign('pharmaceuticalIds', DbMapperUtility::convertObjectArrayToDropDown((new \Admin\Model\Pharmaceutical())->getAllOrderBy("name")));
        $this->_health->assign('title','Manage Medications');
        $this->_health->assign('actionPage',$this->actionPage);
    }
}
