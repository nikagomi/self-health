<?php

namespace Survey\Model;

use Neptune\DbMapper;

/**
 * Description of QuestionIndicator
 * @package oecs
 * @author nikagomi
 */
class QuestionIndicator extends DbMapper {
    protected $_tableName = "question_indicators";
    protected $primaryKeyField = "question_indicator_id";

    protected $uniqueCombo = [["questionId","indicatorId"]];
    protected $uniqueComboErrorMsg = "The indicator seems to already exists";

    protected $fieldMapper = array(
        "id" => array("question_indicator_id","I"),
        "questionId" => array("question_id","I"),
        "indicatorId" => array("indicator_id","I")
    );
    
    protected $questionId;
    protected $indicatorId;
    
    protected $question;
    protected $indicator;
    
    public function __construct() {
        parent::__construct();
        $this->question = new Question();
        $this->indicator = new Indicator();
    }
    
    public function getQuestionId() {
        return $this->questionId;
    }

    public function getIndicatorId() {
        return $this->indicatorId;
    }

    public function getQuestion() {
        return $this->question->getObjectById($this->getQuestionId());
    }

    public function getIndicator() {
        return $this->indicator->getObjectById($this->getIndicatorId());
    }
    
    public function setQuestionId($questionId) {
        $this->questionId = $questionId;
    }

    public function setIndicatorId($indicatorId) {
        $this->indicatorId = $indicatorId;
    }

    public function setQuestion($question) {
        $this->question = $question;
    }

    public function setIndicator($indicator) {
        $this->indicator = $indicator;
    }

    public function getIndicatorsByQuestion ($questionId) {
        return $this->getObjectsByMultipleCriteria(["questionId"], [$questionId], TRUE, "indicatorId", "\Survey\Model\Indicator");
    }

    public function assignQuestionIndicators ($questionId, array $indicatorArr){
        
        $sql = "";
        $propertyArr = ["questionId","indicatorId"];
        $objs = $this->getObjectsByMultipleCriteria(["questionId"], [$questionId], TRUE);
        foreach($objs as $obj){
            $sql .= $obj->generateDeleteSql();
        }
        if (\count($indicatorArr) > 0) {
            for($i = 0; $i < count($indicatorArr); $i++){
                $newInstance =  new $this->className();
                $newInstance->getEntityByMultipleCriteria($propertyArr, [$questionId, $indicatorArr[$i]], false);
                if($newInstance->getId() != ''){//already exists in table
                    $sql .= $newInstance->generateReactivateSql();
                }else{// insert a new record
                    $newInstance->setQuestionId($questionId);
                    $newInstance->setIndicatorId($indicatorArr[$i]);
                    $newInstance->setId('');
                    $sql .= $newInstance->generateSaveSql();
                }
            }
        }
        if ($sql != '') {
            $dbTransaction = "BEGIN TRANSACTION; ".$sql." COMMIT;";
            $result = $this->dbQuery($dbTransaction);
            return ($result !== false);
        } else {
            return true;
        }
        
    }
}
