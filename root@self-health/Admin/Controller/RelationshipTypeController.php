<?php

namespace Admin\Controller;

use Neptune\BaseController;

/**
 * RelationshipTypeController
 * @package self-health
 * @author Randal Neptune
 */
class RelationshipTypeController extends BaseController {
    protected $modelClass = "\Admin\Model\RelationshipType";
    protected $template = "admin/relationshipType.tpl";
    private $actionPage = "/relationship/type/save";
    
    protected function setUpTemplateVars($obj, $msg = ''){
        $this->_health->assign('relationshipType', $obj);
        $this->_health->assign('msg', $msg);
        $this->_health->assign('list', $obj->getAll());
        $this->_health->assign('html', $this->html);
        $this->_health->assign('title','Manage Relationship Types');
        $this->_health->assign('actionPage', $this->actionPage);
    }
}
