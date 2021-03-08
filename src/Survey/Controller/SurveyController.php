<?php

namespace Survey\Controller;

use Neptune\{BaseController, DbMapperUtility, Config};
use Symfony\Component\HttpFoundation\{Request, Response, RedirectResponse};
use Elasticsearch\ClientBuilder;

/**
 * Description of SurveyController
 * @package oecs
 * @author nikagomi
 */
class SurveyController extends BaseController {
    protected $modelClass = "\Survey\Model\Survey";
    protected $template = "survey/surveyForm.tpl";
    private $actionPage = "/survey/save";
    
    protected function setUpTemplateVars($obj, $msg = ''){
        $this->_oecs->assign('survey',$obj);
        $this->_oecs->assign('msg',$msg);
        $this->_oecs->assign('list',$obj->getAll());
        $this->_oecs->assign('years', $this->generateYears());
        $this->_oecs->assign('html',$this->html);
        $this->_oecs->assign('title','Manage Surveys');
        $this->_oecs->assign('actionPage',$this->actionPage);
    }
    
    private function generateYears ($startYear = 2016) {
        $years = [];
        $years[''] = '';
        for($i = (\date("Y")+2); $i >= $startYear; $i--) {
            $years[$i] = $i;
        }
        return $years;
    }
    
    public function surveyQuestionForm ($id) {
        $survey = (new $this->modelClass())->getObjectById($id);
        if (!$survey->isIdEmpty()) {
            $this->_oecs->assign('survey', $survey);
            $this->_oecs->assign('questions', (new \Survey\Model\Question())->getAllOrderBy("questionText"));
            $this->_oecs->assign('surveyQuestions', (new \Survey\Model\SurveyQuestion())->getSurveyQuestions($survey->getId()));
            $this->_oecs->assign('html',$this->html);
            $this->_oecs->assign('title','Add Questions to Survey');
            return new Response($this->_oecs->display("survey/surveyQuestion.tpl"));
        } else {
            return new RedirectResponse("/access/denied");
        }
    }
    
    public function ajaxAssociateQuestion (Request $request) {
        /*$request = Request::create(
            '/ajax/associate/survey/question',
            'POST',
            array('questionId' => '9', 'surveyId' => '1')
        );*/
        $surveyId = $request->request->get("surveyId");
        $questionId = $request->request->get("questionId");
        $result = false;
        $sortOrder = (new \Survey\Model\SurveyQuestion())->getMaxSortOrderBySurvey($surveyId);
        $chkSq = (new \Survey\Model\SurveyQuestion())->getEntityByMultipleCriteria(["surveyId","questionId"], [$surveyId, $questionId], FALSE);
        if ($chkSq->isIdEmpty()) {//A first time addition
            $chkSq->setId("");
            $chkSq->setSurveyId($surveyId);
            $chkSq->setQuestionId($questionId);
            $chkSq->setSortOrder(($sortOrder+1));
            $chkSq->save();
            $result = $chkSq->getOpStatus();
        } else {
            $sql = $chkSq->generateReactivateSql();
            $chkSq->setSortOrder(($sortOrder+1));
            $sql .= $chkSq->generateUpdateSql();
            
            //echo "BEGIN TRANSACTION; " . $sql ." COMMIT;";
            
            $resource = DbMapperUtility::dbQuery("BEGIN TRANSACTION; " . $sql ." COMMIT;");
            $result = ($resource !==  false);
        }
        $response = new Response(\json_encode($result));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }
    
    public function ajaxRemoveSurveyQuestion (Request $request) {
        $surveyId = $request->request->get("surveyId");
        $questionId = $request->request->get("questionId");
        
        $chkSq = (new \Survey\Model\SurveyQuestion())->getEntityByMultipleCriteria(["surveyId","questionId"], [$surveyId, $questionId], TRUE);
        $chkSq->delete();
        $response = new Response(\json_encode($chkSq->getOpStatus()));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }
    
    public function surveyPreview ($id) {
        $survey = (new $this->modelClass())->getObjectById($id);
        if (!$survey->isIdEmpty()) {
            $this->_oecs->assign('survey', $survey);
            $this->_oecs->assign('surveyQuestions', (new \Survey\Model\SurveyQuestion())->getBySurvey($survey->getId()));
            $this->_oecs->assign('html',$this->html);
            
            $this->_oecs->assign('title','Survey Form Preview');
            return new Response($this->_oecs->display("survey/surveyPreview.tpl"));
        } else {
            return new RedirectResponse("/access/denied");
        }
    }
    
    public function userSurveyForm ($id) {
        $survey = (new $this->modelClass())->getObjectById($id);
        if (!$survey->isIdEmpty()) {
            $this->_oecs->assign('survey', $survey);
            $this->_oecs->assign('surveyQuestions', (new \Survey\Model\SurveyQuestion())->getBySurvey($survey->getId()));
            $this->_oecs->assign('html',$this->html);
            $this->_oecs->assign('actionPage', '/survey/response/submit');
            $this->_oecs->assign('title','Survey Form Preview');
            return new Response($this->_oecs->display("survey/userSurveyForm.tpl"));
        } else {
            return new RedirectResponse("/access/denied");
        }
    }
    
    public function saveSurveySubmission (Request $request) {
        $survey = (new \Survey\Model\Survey())->getObjectById($request->request->get("surveyId"));
        $sql = '';
        
        $es_username = 'rneptune';
        $es_passwd = 'nikagomi';
        $client = ClientBuilder::create()->setHosts(["http://".Config::$ELASTICSEARCH_HOST.":".Config::$ELASTICSEARCH_PORT])->setBasicAuthentication($es_username, $es_passwd)->build(); 

        $params = ['body' => []];
        $param2 = ['body' => []];

        $questions = $survey->getQuestions();
        foreach ($questions as $question) {
            $sqr = (new \Survey\Model\SurveyQuestionResponse());
            $sqr->setQuestionId($question->getId());
            $sqr->setSurveyId($survey->getId());
            $sqr->setResponse($request->request->get("quest_".$question->getId()));
            $sql .= $sqr->generateSaveSql();
            
            //Do the indicator addition
            foreach ($question->getIndicators() as $indicator) {
                $param2['body'][] = [
                'index' => [
                    '_index' => 'survey_indicator_responses',
                    '_id' => $sqr->getId()." - ".$indicator->getId()
                    ]
                ];
                
                $param2['body'][] = [
                    'survey year' => $sqr->getSurvey()->getYear(),
                    'survey title' => $sqr->getSurvey()->getTitle(),
                    'question' => $question->getQuestionText(),
                    'response' => $sqr->getResponse(),
                    'indicator' => $indicator->getName(),
                    'question type' => $question->getQuestionType()->getLabel()
                ];
            }
            
            //Now for elasticsearch stuff
            $params['body'][] = [
                'index' => [
                    '_index' => 'survey_responses',
                    '_id' => $sqr->getId()
                    ]
            ];

            $params['body'][] = [
                'survey year' => $survey->getYear(),
                'survey title' => $survey->getTitle(),
                'question' => $sqr->getQuestion()->getQuestionText(),
                'response' => $sqr->getResponse(),
                'indicator' => $sqr->getQuestion()->getIndicatorList(),
                'question type' => $sqr->getQuestion()->getQuestionType()->getLabel()
            ];
        }
        
        //Save the response to teh database now
        $transaction = "BEGIN TRANSACTION; " . $sql ." COMMIT;";
        $result = DbMapperUtility::dbQuery($transaction);
        
        if ($result !== false) {
            $client->bulk($params);
            $client->bulk($param2);
        }
        $this->_oecs->assign("survey", $survey);
        return new Response($this->_oecs->display("survey/userSurveyFormComplete.tpl"));
        
    }
}

