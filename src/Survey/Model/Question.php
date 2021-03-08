<?php

namespace Survey\Model;

use Neptune\{DbMapper, HtmlHelper, DbMapperUtility};

/**
 * Description of Question
 * @package oecs
 * @author nikagomi
 */
class Question extends DbMapper {
    protected $_tableName = "questions";
    protected $primaryKeyField = "question_id";

    protected $uniqueCombo = [["questionTypeId","questionText"],["questionText"]];
    protected $uniqueComboErrorMsg = "The question seems to already exists";

    protected $fieldMapper = array(
        "id" => array("question_id","I"),
        "questionText" => array("question_text","T"),
        "questionTypeId" => array("question_type_id","I"),
        "tooltipDescription" => array("tooltip_description","T"),
    );

    protected $questionText;
    protected $questionTypeId;
    protected $tooltipDescription;
    
    protected $questionType;
    
    public function __construct() {
        parent::__construct();
        $this->questionType = new QuestionType();
    }

    public function getQuestionText() {
        return $this->questionText;
    }

    public function getQuestionTypeId() {
        return $this->questionTypeId;
    }

    public function getTooltipDescription() {
        return $this->tooltipDescription;
    }

    public function getQuestionType() {
        return $this->questionType->getObjectById($this->getQuestionTypeId());
    }
    
    public function setQuestionText($questionText) {
        $this->questionText = $questionText;
    }

    public function setQuestionTypeId($questionTypeId) {
        $this->questionTypeId = $questionTypeId;
    }

    public function setTooltipDescription($tooltipDescription) {
        $this->tooltipDescription = $tooltipDescription;
    }

    public function setQuestionType($questionType) {
        $this->questionType = $questionType;
    }

    public function getTruncatedQuestion ($strLen = 30) {
        return (new HtmlHelper())->truncateString($this->getQuestionText(), $strLen);
    }
    
    public function getLabel() {
        return $this->getQuestionText();
    }
    
    public function getByQuestionType ($questionTypeId) {
        return $this->getObjectsByMultipleCriteria(["questionTypeId"], [$questionTypeId], TRUE, "id", $this->getClassName(), TRUE, "questionText");
    }
    
    public function getOptions () {
        return (new QuestionOption())->getByQuestion($this->getId());
    }
    
    public function getNumberOfOptions () {
        return \count($this->getOptions());
    }
    
    public function getOptionListHTML () {
        $objs = $this->getOptions();
        $list = "";
        if (\count($objs) > 0) {
            foreach ($objs as $idx => $obj) {
                $list .= $obj->getOptionText();
                if ($idx < (\count($objs) - 1)) {
                    $list .= "<br/>";
                }
            }
        }
        return $list;
    }
    
    public function getIndicators () {
        return (new QuestionIndicator())->getIndicatorsByQuestion($this->getId());
    }
    
    public function getIndicatorList () {
        $indicators = $this->getIndicators();
        $list = [];
        foreach ($indicators as $indicator) {
            \array_push($list, $indicator->getLabel());
        }
        return \join(", ", $list);
    }
    
}
