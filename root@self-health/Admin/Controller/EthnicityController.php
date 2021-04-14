<?php

namespace Admin\Controller;
use Neptune\BaseController;

/**
 * Description of EthnicityController
 * @package sarms
 * @author Randal Neptune
 */
class EthnicityController extends BaseController{
    protected $modelClass = "\Admin\Model\Ethnicity";
    protected $template = "admin/ethnicity.tpl";
    private $actionPage = "/ethnicity/save";
    
    protected function setUpTemplateVars($obj, $msg = ''){
        $this->_health->assign('ethnicity',$obj);
        $this->_health->assign('msg',$msg);
        $this->_health->assign('list',$obj->getAll());
        $this->_health->assign('html',$this->html);
        $this->_health->assign('title','Manage Ethnicities');
        $this->_health->assign('actionPage',$this->actionPage);
    }
}
