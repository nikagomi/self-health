<?php

namespace Survey\Controller;

use Neptune\BaseController;

/**
 * Description of QuestionTypeController
 * @package oecs
 * @author nikagomi
 */
class QuestionTypeController extends BaseController {
    protected $modelClass = "\Survey\Model\QuestionType";
    protected $template = "survey/questionType.tpl";
    private $actionPage = "/question/type/save";
    
    protected function setUpTemplateVars($obj, $msg = ''){
        $this->_oecs->assign('questionType',$obj);
        $this->_oecs->assign('msg',$msg);
        $this->_oecs->assign('list',$obj->getAll());
        $this->_oecs->assign('html',$this->html);
        $this->_oecs->assign('title','Manage Question Types');
        $this->_oecs->assign('actionPage',$this->actionPage);
    }
}
