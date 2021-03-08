<?php

namespace Survey\Model;

use Neptune\DbMapper;

/**
 * Description of QuestionType
 * @package oecs
 * @author nikagomi
 */
class QuestionType extends DbMapper {
    protected $_tableName = "question_types";
    protected $primaryKeyField = "question_type_id";

    protected $uniqueCombo = array(array("name"), array("constant"));
    protected $uniqueComboErrorMsg = "The question type already exists";

    protected $fieldMapper = array(
        "id" => array("question_type_id","I"),
        "name" => array("name","T"),
        "constant" => array("constant","T")
    );
    
    public static $LIKERT = "LIKERT";
    public static $SCALE_TEN = "SCALE_TEN";
    public static $QUALITATIVE = "QUALITATIVE";
    public static $SINGLE_CHOICE= "SINGLE_CHOICE";

    protected $name;
    protected $constant;

    public function getName() {
        return $this->name;
    }
    
    public function getConstant() {
        return $this->constant;
    }

    public function setConstant($constant) {
        $this->constant = \strtoupper($constant);
    }

    public function setName($name) {
        $this->name = \ucwords($name);
    }
    
    public function getLabel() {
        return $this->getName();
    }
    
    public function needsChoiceDefinition () {
        return (\strtoupper($this->getConstant()) == self::$SINGLE_CHOICE) ? (bool) true : (bool) false;
    }
}
