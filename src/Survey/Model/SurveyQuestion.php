<?php

namespace Survey\Model;

use Neptune\DbMapper;

/**
 * Description of SurveyQuestion
 * @package oecs
 * @author nikagomi
 */
class SurveyQuestion extends DbMapper {
    protected $_tableName = "survey_questions";
    protected $primaryKeyField = "survey_question_id";

    protected $uniqueCombo = [["surveyId","questionId"]];/*,["surveyId","sortOrder"]*/
    protected $uniqueComboErrorMsg = "The question seems to already exist for the survey or another question shares the selected sort order";

    protected $fieldMapper = array(
        "id" => array("survey_question_id","I"),
        "surveyId" => array("survey_id","I"),
        "questionId" => array("question_id","I"),
        "sortOrder" => array("sort_order","I"),
    );
    
    protected $surveyId;
    protected $questionId;
    protected $sortOrder;
    
    protected $survey;
    protected $question;
    
    protected $labelSortProperty = "sortOrder";
    
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

    public function getSortOrder() {
        return $this->sortOrder;
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

    public function setSortOrder($sortOrder) {
        $this->sortOrder = $sortOrder;
    }

    public function setSurvey($survey) {
        $this->survey = $survey;
    }

    public function setQuestion($question) {
        $this->question = $question;
    }

    public function getBySurvey ($surveyId) {
        return $this->getObjectsByMultipleCriteria(["surveyId"], [$surveyId], TRUE, "id", $this->getClassName(), TRUE, "sortOrder");
    }
    
    public function getSurveyQuestions ($surveyId) {
        return $this->getObjectsByMultipleCriteria(["surveyId"], [$surveyId], TRUE, "questionId", "\Survey\Model\Question", TRUE, "sortOrder");
    }
    
    public function getBySurveyAndQuestion($surveyId, $questionId) {
        return $this->getEntityByMultipleCriteria(["surveyId","questionId"], [$surveyId, $questionId], TRUE);
    }
    
    public function getMaxSortOrderBySurvey ($surveyId) {
        $sql = "SELECT max(sort_order) FROM ".$this->getTableName()." WHERE survey_id = ".$surveyId. " AND alive = true";
        $result = $this->dbQuery($sql);
        $res = $this->dbFetchArray($result);
        return ($res[0] == null || $res[0] == '') ? 0 : $res[0];
    }

}
