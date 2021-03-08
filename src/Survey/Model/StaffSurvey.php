<?php

namespace Survey\Model;

use Neptune\DbMapper;

/**
 * Description of StaffSurvey
 * @package oecs
 * @author nikagomi
 */
class StaffSurvey extends DbMapper {
    protected $_tableName = "staff_surveys";
    protected $primaryKeyField = "staff_survey_id";

    protected $uniqueCombo = [["email"],["email","firstName","lastName"]];
    protected $uniqueComboErrorMsg = "The staff member seems to have already been defined";

    protected $fieldMapper = array(
   	"id" => array("staff_survey_id","I"),
	"surveyId" => array("survey_id","I"),
        "staffId" => array("staff_id","I"),
        "code" => array("code","T"),
        "email" => array("email","T"),
        "completed" => array("completed","B"),
        "started" => array("started","B")
    );
    
    protected $surveyId;
    protected $staffId;
    protected $code;
    protected $email;
    protected $completed;
    protected $started;
    
    protected $survey;
    protected $staff;
    
    
    public function __construct() {
        parent::__construct();
        $this->survey = new Survey();
        $this->staff = new \HR\Model\Staff();
    }
    
    public function getSurveyId() {
        return $this->surveyId;
    }

    public function getStaffId() {
        return $this->staffId;
    }

    public function getCode() {
        return $this->code;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getCompleted() {
        return $this->completed;
    }

    public function getStarted() {
        return $this->started;
    }

    public function getSurvey() {
        return $this->survey->getObjectById($this->getSurveyId());
    }

    public function getStaff() {
        return $this->staff->getObjectById($this->getStaffId());
    }
    
    public function setSurveyId($surveyId) {
        $this->surveyId = $surveyId;
    }

    public function setStaffId($staffId) {
        $this->staffId = $staffId;
    }

    public function setCode($code) {
        $this->code = $code;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setCompleted($completed) {
        $this->completed = $completed;
    }

    public function setStarted($started) {
        $this->started = $started;
    }

    public function setSurvey($survey) {
        $this->survey = $survey;
    }

    public function setStaff($staff) {
        $this->staff = $staff;
    }

}
