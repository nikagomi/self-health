<?php

namespace Survey\Model;

use Neptune\DbMapper;

/**
 * Description of Survey
 * @package oecs
 * @author nikagomi
 */
class Survey extends DbMapper {
    protected $_tableName = "surveys";
    protected $primaryKeyField = "survey_id";

    protected $uniqueCombo = [["identifier","year"],["title","year"],["identifier"]];
    protected $uniqueComboErrorMsg = "The survey seems to already exists";

    protected $fieldMapper = array(
        "id" => array("survey_id","I"),
        "identifier" => array("identifier","T"),
        "year" => array("year","I"),
        "title" => array("title","T"),
    );
    
    protected $identifier;
    protected $year;
    protected $title;
    
    public function getYear() {
        return $this->year;
    }

    public function getTitle() {
        return $this->title;
    }

    public function setYear($year) {
        $this->year = $year;
    }

    public function setTitle($title) {
        $this->title = $title;
    }
    
    public function getIdentifier() {
        return $this->identifier;
    }

    public function setIdentifier($identifier) {
        $this->identifier = $identifier;
    }

    public function getByYear ($year = '') {
        $yr = ($year == '') ? \date("Y") : $year;
        return $this->getObjectsByMultipleCriteria(["year"], [$yr], TRUE, "id", $this->getClassName(), TRUE, "year");
    }
    
    public function getLabel() {
        return $this->getIdentifier()." - ".$this->getYear();
    }
    
    public function getQuestions () {
        return (new SurveyQuestion())->getObjectsByMultipleCriteria(["surveyId"], [$this->getId()], TRUE, "questionId", "\Survey\Model\Question", TRUE, "sortOrder");
    }
    
    public function getNumberOfQuestions () {
        return \count($this->getQuestions());
    }
    
}
