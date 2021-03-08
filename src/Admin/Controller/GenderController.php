<?php

namespace Admin\Controller;

/**
 * Description of GenderController
 * @package oecs
 * @author Randal Neptune
 */
class GenderController extends \Neptune\BaseController{
    protected $modelClass = "\Admin\Model\Gender";
    protected $template = "admin/gender.tpl";
    private $actionPage = "/gender/save";
    
    protected function setUpTemplateVars($obj, $msg = ''){
        $this->_edu->assign('gender',$obj);
        $this->_edu->assign('msg',$msg);
        $this->_edu->assign('list',$obj->getAll());
        $this->_edu->assign('html',$this->html);
        $this->_edu->assign('title','Manage Genders');
        $this->_edu->assign('actionPage',$this->actionPage);
    }
}
