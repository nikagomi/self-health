<?php

namespace Admin\Controller;

use Neptune\BaseController;

/**
 * AllergyTypeController
 * @package self-health
 * @author Randal Neptune
 */
class AllergyTypeController extends BaseController {
    protected $modelClass = "\Admin\Model\AllergyType";
    protected $template = "admin/allergyType.tpl";
    private $actionPage = "/allergy/type/save";
    
    protected function setUpTemplateVars($obj, $msg = ''){
        $this->_health->assign('allergyType', $obj);
        $this->_health->assign('msg', $msg);
        $this->_health->assign('list', $obj->getAll());
        $this->_health->assign('html', $this->html);
        $this->_health->assign('title','Manage Allergy Types');
        $this->_health->assign('actionPage', $this->actionPage);
    }
}
