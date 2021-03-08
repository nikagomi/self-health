<?php

namespace Clinical\Controller;

use Neptune\BaseController;

/**
 * LabTestController
 * @package self-health
 * @author Randal Neptune
 */
class LabTestController extends BaseController {
    protected $modelClass = "\Clinical\Model\LabTest";
    protected $template = "clinical/labTest.tpl";
    private $actionPage = "/lab/test/save";
    
    protected function setUpTemplateVars($obj, $msg = ''){
        $this->_health->assign('labTest',$obj);
        $this->_health->assign('msg',$msg);
        $this->_health->assign('list',$obj->getAll());
        $this->_health->assign('html',$this->html);
        
        $this->_health->assign('title','Manage Lab Tests');
        $this->_health->assign('actionPage',$this->actionPage);
    }
}
