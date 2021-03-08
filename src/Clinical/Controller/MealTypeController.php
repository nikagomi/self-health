<?php

namespace Clinical\Controller;

use Neptune\BaseController;

/**
 * MealTypeController
 * @package self-health
 * @author Randal Neptune
 */
class MealTypeController extends BaseController {
    protected $modelClass = "\Clinical\Model\MealType";
    protected $template = "clinical/mealType.tpl";
    private $actionPage = "/meal/type/save";
    
    protected function setUpTemplateVars($obj, $msg = ''){
        $this->_health->assign('mealType',$obj);
        $this->_health->assign('msg',$msg);
        $this->_health->assign('list',$obj->getAll());
        $this->_health->assign('html',$this->html);
        $this->_health->assign('title','Manage Meal Types');
        $this->_health->assign('actionPage',$this->actionPage);
    }
}
