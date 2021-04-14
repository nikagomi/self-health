<?php

namespace Admin\Controller;

use Neptune\BaseController;

/**
 * ChronicDiseaseController
 * @package self-health
 * @author Randal Neptune
 */
class ChronicDiseaseController extends BaseController {
    protected $modelClass = "\Admin\Model\ChronicDisease";
    protected $template = "admin/chronicDisease.tpl";
    private $actionPage = "/chronic/disease/save";
    
    protected function setUpTemplateVars($obj, $msg = ''){
        $this->_health->assign('chronicDisease', $obj);
        $this->_health->assign('msg', $msg);
        $this->_health->assign('list', $obj->getAll());
        $this->_health->assign('html', $this->html);
        $this->_health->assign('title','Manage Chronic Disease');
        $this->_health->assign('actionPage', $this->actionPage);
    }
}
