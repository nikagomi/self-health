<?php

namespace Admin\Controller;

use Neptune\BaseController;

/**
 * PhysicalActivityController
 * @package self-health
 * @author Randal Neptune
 */
class PhysicalActivityController extends BaseController {
    protected $modelClass = "\Admin\Model\PhysicalActivity";
    protected $template = "admin/physicalActivity.tpl";
    private $actionPage = "/physical/activity/save";
    
    protected function setUpTemplateVars($obj, $msg = ''){
        $this->_health->assign('physicalActivity',$obj);
        $this->_health->assign('msg',$msg);
        $this->_health->assign('list',$obj->getAll());
        $this->_health->assign('html',$this->html);
        $this->_health->assign('title','Manage Physical Activities');
        $this->_health->assign('actionPage',$this->actionPage);
    }
}
