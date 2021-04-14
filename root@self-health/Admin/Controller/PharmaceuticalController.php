<?php

namespace Admin\Controller;

use Neptune\BaseController;

/**
 * PharmaceuticalController
 * @package self-health
 * @author Randal Neptune
 */
class PharmaceuticalController extends BaseController {
    protected $modelClass = "\Admin\Model\Pharmaceutical";
    protected $template = "admin/pharmaceutical.tpl";
    private $actionPage = "/pharmaceutical/save";
    
    protected function setUpTemplateVars($obj, $msg = ''){
        $this->_health->assign('pharmaceutical',$obj);
        $this->_health->assign('msg',$msg);
        $this->_health->assign('list',$obj->getAll());
        $this->_health->assign('html',$this->html);
        $this->_health->assign('title','Manage Pharmaceuticals');
        $this->_health->assign('actionPage',$this->actionPage);
    }
}
