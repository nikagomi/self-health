<?php

namespace Survey\Controller;

use Neptune\{BaseController, DbMapperUtility};
use Symfony\Component\HttpFoundation\{RedirectResponse, Response, Request};

/**
 * Description of QuestionOptionController
 * @package oecs
 * @author nikagomi
 */
class QuestionOptionController extends BaseController {
    protected $modelClass = "\Survey\Model\QuestionOption";
    protected $template = "survey/questionOptions.tpl";
    
    
    public function loadForm ($questionId) {
        $question = (new \Survey\Model\Question())->getObjectById($questionId);
        if (!$question->isIdEmpty()) {
            $this->_oecs->assign('question', $question);
            $this->_oecs->assign('options', (new $this->modelClass())->getByQuestion($questionId));
            $this->_oecs->assign('html',$this->html);
            $this->_oecs->assign('title','Manage Question Options');
            return new Response($this->_oecs->display($this->template));
        } else {
            return new RedirectResponse ("/access/denied");
        }
    }
    
    public function ajaxSave (Request $request) {
        $option = (new \Survey\Model\QuestionOption())->mapFormToEntity($request->request);
        $option->pushObjectToDB();
        $result = [];
        $result['id'] = $option->getId();
        $result['status'] = $option->getOpStatus();
        $response = new Response(\json_encode($result));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }
    
    public function ajaxRemove ($id) {
        $option = (new \Survey\Model\QuestionOption())->getObjectById($id);
        $option->delete();
        
        $response = new Response(\json_encode($option->getOpStatus()));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }
    
    public function ajaxUpdateSortOrder (Request $request) {
        $ids = \explode(",", $request->request->get("ids"));
        $orders = \explode(",", $request->request->get("orders"));
        
        $sql = '';
        foreach ($ids as $idx => $id) {
            $opt = (new \Survey\Model\QuestionOption())->getObjectById($id);
            $opt->setSortOrder($orders[$idx]);
            $sql .= $opt->generateUpdateSql();
        }
        
        $transaction = "BEGIN TRANSACTION; " . $sql ." COMMIT;";
        $result = DbMapperUtility::dbQuery($transaction);
        $response = new Response(\json_encode($result));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }
    
    
}
