<?php

namespace Survey\Model;

use Neptune\DbMapper;

/**
 * Description of QuestionOption
 * @package oecs
 * @author nikagomi
 */
class QuestionOption extends DbMapper{
    protected $_tableName = "question_options";
    protected $primaryKeyField = "question_option_id";

    protected $uniqueCombo = [["optionText","questionId","sortOrder"]]; //, ["questionId","sortOrder"]
    protected $uniqueComboErrorMsg = "The indicated option or sort order seems to have already been defined for the question";

    protected $fieldMapper = array(
        "id" => array("question_option_id","I"),
        "optionText" => array("option_text","T"),
        "questionId" => array("question_id","I"),
        "sortOrder" => array("sort_order","I")
    );
    
    protected $optionText;
    protected $questionId;
    protected $sortOrder;
    
    protected $question;
    
    public function __construct() {
        parent::__construct();
        $this->question = new Question();
    }
    
    public function getOptionText() {
        return $this->optionText;
    }

    public function getQuestionId() {
        return $this->questionId;
    }

    public function getSortOrder() {
        return $this->sortOrder;
    }

    public function getQuestion() {
        return $this->question->getObjectById($this->getQuestionId());
    }

    public function setOptionText($optionText) {
        $this->optionText = $optionText;
    }

    public function setQuestionId($questionId) {
        $this->questionId = $questionId;
    }

    public function setSortOrder($sortOrder) {
        $this->sortOrder = $sortOrder;
    }

    public function setQuestion($question) {
        $this->question = $question;
    }

    public function getByQuestion ($questionId) {
        return $this->getObjectsByMultipleCriteria(["questionId"], [$questionId], TRUE, "id", $this->getClassName(), TRUE, "sortOrder");
    }

}
