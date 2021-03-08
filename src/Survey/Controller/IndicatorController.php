<?php

namespace Survey\Controller;

use Neptune\BaseController;
/**
 * Description of IndicatorController
 * @pckage oecs
 * @author nikagomi
 */
class IndicatorController extends BaseController {
    protected $modelClass = "\Survey\Model\Indicator";
    protected $template = "survey/indicator.tpl";
    private $actionPage = "/indicator/save";
    
    protected function setUpTemplateVars($obj, $msg = ''){
        $this->_oecs->assign('indicator',$obj);
        $this->_oecs->assign('msg',$msg);
        $this->_oecs->assign('list',$obj->getAll());
        $this->_oecs->assign('html',$this->html);
        $this->_oecs->assign('title','Manage Indicators');
        $this->_oecs->assign('actionPage',$this->actionPage);
    }
}
