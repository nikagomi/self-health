<?php

namespace Survey\Controller;

use Neptune\{BaseController, DbMapperUtility};
use Symfony\Component\HttpFoundation\{Response, Request};

/**
 * Description of SurveyQuestionController
 * @package oecs
 * @author nikagomi
 */
class SurveyQuestionController extends BaseController {
    protected $modelClass = "\Survey\Model\SurveyQuestion";
    
    public function ajaxUpdateSortOrder (Request $request) {
        $ids = \explode(",", $request->request->get("ids"));
        $orders = \explode(",", $request->request->get("orders"));
        
        $sql = '';
        foreach ($ids as $idx => $id) {
            $opt = (new \Survey\Model\SurveyQuestion())->getObjectById($id);
            $opt->setSortOrder($orders[$idx]);
            $sql .= $opt->generateUpdateSql();
        }
        
        $transaction = "BEGIN TRANSACTION; " . $sql ." COMMIT;";
        $result = DbMapperUtility::dbQuery($transaction);
        $response = new Response(\json_encode($result));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    } 
    
    public function ajaxUpdateResponse (Request $request) {
        $questionId = $request->request->get("questionId");
        $qResponse = $request->request->get("response");
        $surveyId = $request->request->get("surveyId");
        
        $instance = (new \Survey\Model\SurveyQuestionResponse())->getEntityByCriteria(["surveyId","questionId"], [$surveyId, $questionId], TRUE);
        if ($instance->isIdEmpty()) {//does not exist yet
            $instance->setId("");
            $instance->setquestionId($questionId);
            $instance->setResponse($qResponse);
            $instance->setSurveyId($surveyId);
            //$instance->setStaffId();
            $instance->save();
        } else {
            $instance->setResponse($qResponse);
            $instance->update();
        }
        
        $response = new Response(\json_encode($instance->getOpStatus()));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }
}
