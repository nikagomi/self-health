<?php

namespace Admin\Controller;

class CountryController extends \Neptune\BaseController{
    
    protected $modelClass = "\Admin\Model\Country";
    protected $template = "admin/country.tpl";
    private $actionPage = "/country/save";
    
    protected function setUpTemplateVars($obj, $msg = ''){
        $this->_health->assign('country',$obj);
        $this->_health->assign('msg',$msg);
        $this->_health->assign('list',$obj->getAll());
        $this->_health->assign('html',$this->html);
        $this->_health->assign('title','Manage Countries');
        $this->_health->assign('actionPage',$this->actionPage);
    }
}
