<?php

namespace Clinical\Controller;

use Neptune\BaseController;

/**
 * Covid19VaccineController
 * @package self-health
 * @author Randal Neptune
 */
class Covid19VaccineController extends BaseController {
    protected $modelClass = "\Clinical\Model\Covid19Vaccine";
    protected $template = "clinical/covid19Vaccine.tpl";
    private $actionPage = "/covid19/vaccine/save";
    
    protected function setUpTemplateVars($obj, $msg = ''){
        $this->_health->assign('covid19Vaccine',$obj);
        $this->_health->assign('msg',$msg);
        $this->_health->assign('list',$obj->getAll());
        $this->_health->assign('html',$this->html);
        $this->_health->assign('title','Manage Covid19 Vaccines');
        $this->_health->assign('actionPage',$this->actionPage);
    }
}
