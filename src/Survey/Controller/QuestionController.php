<?php

namespace Survey\Controller;

use Neptune\{BaseController, DbMapperUtility, HtmlHelper};
use Symfony\Component\HttpFoundation\{Request, Response};
/**
 * Description of QuestionController
 * @package oecs
 * @author nikagomi
 */
class QuestionController extends BaseController {
    protected $modelClass = "\Survey\Model\Question";
    protected $template = "survey/question.tpl";
    private $actionPage = "/question/save";
    
    public function save(Request $request){
        $question = new $this->modelClass();
        $questionIndicator = new \Survey\Model\QuestionIndicator();
        $question->mapFormToEntity($request->request);
        
        $question->pushObjectToDB(true);  
        $msg = HtmlHelper::toastWrapperStart();
        $msg .= HtmlHelper::generateToast($question->getOpStatus(), $question->getOpMessage());       
        if($question->getOpStatus()){
            $arr = (\count($request->request->get('ind')) > 0) ? $request->request->get('ind') : [];
            $result = $questionIndicator->assignQuestionIndicators($question->getId(), $arr);
            $tmpMsg = ($result) ? "Indicators were successfully updated." : "Sorry, an error occurred. Indicators could not be updated.";
            $msg .= HtmlHelper::generateToast($result, $tmpMsg);
            $question->clear();
        }
        $msg .= HtmlHelper::toastWrapperEnd();
        $this->setUpTemplateVars($question, $msg);
        return new Response($this->_oecs->display($this->template));
    }
    
    protected function setUpTemplateVars($obj, $msg = ''){
        $this->_oecs->assign('question',$obj);
        $this->_oecs->assign('msg',$msg);
        $this->_oecs->assign('list',$obj->getAll());
        $this->_oecs->assign('questionTypes', DbMapperUtility::convertObjectArrayToDropDown((new \Survey\Model\QuestionType())->getAllOrderBy("name")));
        $this->_oecs->assign('html',$this->html);
        
        $this->_oecs->assign('indicators', DbMapperUtility::convertObectArrayToCheckBoxArray((new \Survey\Model\Indicator())->getAllOrderBy("name")));
        $this->_oecs->assign('questionIndicators', DbMapperUtility::convertObjectArrayToIdArray($obj->getIndicators()));

        $this->_oecs->assign('title','Manage Questions');
        $this->_oecs->assign('actionPage',$this->actionPage);
    }
}
