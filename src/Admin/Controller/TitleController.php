<?php

namespace Admin\Controller;
/**
 * Description of TitleController
 *
 * @author randal
 */
class TitleController extends \Neptune\BaseController{
    protected $modelClass = "\Admin\Model\Title";
    protected $template = "admin/title.tpl";
    private $actionPage = "/title/save";
    
    protected function setUpTemplateVars($obj, $msg = ''){
        $this->_edu->assign('titulo',$obj);
        $this->_edu->assign('msg',$msg);
        $this->_edu->assign('list',$obj->getAll());
        $this->_edu->assign('html',$this->html);
        $this->_edu->assign('title','Manage Titles');
        $this->_edu->assign('actionPage',$this->actionPage);
    }
}
