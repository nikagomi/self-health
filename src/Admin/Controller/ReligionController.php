<?php

namespace Admin\Controller;
use Neptune\BaseController;

/**
 * Description of ReligionController
 * @package smile
 * @author Randal Neptune
 */
class ReligionController extends BaseController {
    protected $modelClass = "\Admin\Model\Religion";
    protected $template = "admin/religion.tpl";
    private $actionPage = "/religion/save";
    
    protected function setUpTemplateVars($obj, $msg = ''){
        $this->_health->assign('religion',$obj);
        $this->_health->assign('msg',$msg);
        $this->_health->assign('list',$obj->getAll());
        $this->_health->assign('html',$this->html);
        $this->_health->assign('title','Manage Religions');
        $this->_health->assign('actionPage',$this->actionPage);
    }
}
