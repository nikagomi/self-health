<?php

namespace Clinical\Controller;

use Neptune\BaseController;

/**
 * VitalTestController
 * @package self-health
 * @author Randal Neptune
 */
class VitalTestController extends BaseController {
    protected $modelClass = "\Clinical\Model\VitalTest";
    protected $template = "clinical/vitalTest.tpl";
    private $actionPage = "/vital/test/save";
    
    protected function setUpTemplateVars($obj, $msg = ''){
        $this->_health->assign('vitalTest',$obj);
        $this->_health->assign('msg',$msg);
        $this->_health->assign('list',$obj->getAll());
        $this->_health->assign('html',$this->html);
        $this->_health->assign('componentOrder', ['' => "", 1 => 1, 2 => 2]);
        $this->_health->assign('title','Manage Vital Tests');
        $this->_health->assign('actionPage',$this->actionPage);
    }
}
