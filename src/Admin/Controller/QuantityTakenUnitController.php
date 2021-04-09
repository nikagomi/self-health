<?php

namespace Admin\Controller;

use Neptune\BaseController;

/**
 * QuantityTakenUnitController
 * @package self-health
 * @author Randal Neptune
 */
class QuantityTakenUnitController extends BaseController {
    protected $modelClass = "\Admin\Model\QuantityTakenUnit";
    protected $template = "admin/quantityTakenUnit.tpl";
    private $actionPage = "/quantity/taken/unit/save";
    
    protected function setUpTemplateVars($obj, $msg = ''){
        $this->_health->assign('quantityTakenUnit',$obj);
        $this->_health->assign('msg',$msg);
        $this->_health->assign('list',$obj->getAll());
        $this->_health->assign('html',$this->html);
        $this->_health->assign('title','Manage Quantity Taken Units');
        $this->_health->assign('actionPage',$this->actionPage);
    }
}
