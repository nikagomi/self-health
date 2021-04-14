<?php

namespace Utility\Controller;

use Neptune\BaseController;

/**
 * Description of AgeRangeController
 * @package self-health
 * @author Randal Neptune
 */
class AgeRangeController extends BaseController {
    protected $modelClass = "\Utility\Model\AgeRange";
    protected $template = "utility/ageRange.tpl";
    private $actionPage = "/age/range/save";
    
    protected function setUpTemplateVars($obj, $msg = ''){
        $this->_health->assign('ageRange',$obj);
        $this->_health->assign('msg',$msg);
        $this->_health->assign('list',$obj->getAll());
        $this->_health->assign('html',$this->html);
        $this->_health->assign('title','Manage Age Ranges');
        $this->_health->assign('actionPage',$this->actionPage);
    }
}
