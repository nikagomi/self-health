<?php

namespace Survey\Model;

use Neptune\DbMapper;

/**
 * Description of SurveyQuestionResponse
 * @package oecs
 * @author nikagomi
 */
class SurveyQuestionResponse extends DbMapper {
    protected $_tableName = "survey_question_responses";
    protected $primaryKeyField = "survey_question_response_id";

    protected $uniqueCombo = [];
    protected $uniqueComboErrorMsg = "The question seems to already exist for the survey or another question shares the selected sort order";

    protected $fieldMapper = array(
        "id" => array("survey_question_response_id","I"),
        "surveyId" => array("survey_id","I"),
        "questionId" => array("question_id","I"),
        "response" => array("response","T")
    );
    
    protected $surveyId;
    protected $questionId;
    protected $response;
    
    protected $survey;
    protected $question;
    
    public function __construct() {
        parent::__construct();
        $this->survey = new Survey();
        $this->question = new Question();
    }
    
    public function getSurveyId() {
        return $this->surveyId;
    }

    public function getQuestionId() {
        return $this->questionId;
    }

    public function getResponse() {
        return $this->response;
    }

    public function getSurvey() {
        return $this->survey->getObjectById($this->getSurveyId());
    }

    public function getQuestion() {
        return $this->question->getObjectById($this->getQuestionId());
    }
    
    public function setSurveyId($surveyId) {
        $this->surveyId = $surveyId;
    }

    public function setQuestionId($questionId) {
        $this->questionId = $questionId;
    }

    public function setResponse($response) {
        $this->response = $response;
    }

    public function setSurvey($survey) {
        $this->survey = $survey;
    }

    public function setQuestion($question) {
        $this->question = $question;
    }






}
