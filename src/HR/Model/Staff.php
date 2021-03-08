<?php

namespace HR\Model;

use Neptune\DbMapper;
/**
 * Description of Staff
 * @package oecs
 * @author nikagomi
 */
class Staff extends DbMapper {
    protected $_tableName = "staff";
    protected $primaryKeyField = "staff_id";

    protected $uniqueCombo = [["email"],["email","firstName","lastName"]];
    protected $uniqueComboErrorMsg = "The staff member seems to have already been defined";

    protected $fieldMapper = array(
   	"id" => array("staff_id","I"),
	"firstName" => array("first_name","T"),
        "lastName" => array("last_name","T"),
        "genderId" => array("gender_id","I"),
        "email" => array("email","T"),
        "retired" => array("retired","B"),
        "retiredDate" => array("retired_date","D")
    );
    
    protected $firstName;
    protected $lastName;
    protected $genderId;
    protected $email;
    protected $retired;
    protected $retiredDate;
    
    protected $gender;
    
    public function __construct() {
        parent::__construct();
        $this->gender = new \Admin\Model\Gender();
    }
    
    public function getFirstName() {
        return $this->firstName;
    }

    public function getLastName() {
        return $this->lastName;
    }

    public function getGenderId() {
        return $this->genderId;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getRetired() {
        return $this->retired;
    }
    
    public function isRetired() {
        return ($this->retired == 1 || $this->retired == 't') ? (bool) true : (bool) false;
    }

    public function getRetiredDate() {
        return $this->retiredDate;
    }

    public function getGender() {
        return $this->gender->getObjectById($this->getGenderId());
    }

    public function setFirstName($firstName) {
        $this->firstName = $firstName;
    }

    public function setLastName($lastName) {
        $this->lastName = $lastName;
    }

    public function setGenderId($genderId) {
        $this->genderId = $genderId;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setRetired($retired) {
        $this->retired = $retired;
    }

    public function setRetiredDate($retiredDate) {
        $this->retiredDate = $retiredDate;
    }

    public function setGender($gender) {
        $this->gender = $gender;
    }

    public function getLabel () {
        return $this->getFirstName()." ".$this->getLastName();
    }
    
    public function __toString() {
        return $this->getLabel();
    }
}
