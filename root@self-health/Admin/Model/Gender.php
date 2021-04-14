<?php

namespace Admin\Model;

use Neptune\DbMapper;
/**
 * Represents people's genders.
 * @package sarms
 * @author Randal Neptune
 */
class Gender extends DbMapper{
    protected $_tableName = "genders";
    protected $primaryKeyField = "gender_id";

    protected $uniqueCombo = [["name"]];
    protected $uniqueComboErrorMsg;

    protected $fieldMapper = array(
   	"id" => array("gender_id","T"),
	"name" => array("name","T"),
    );
   
    public static $FEMALE = "FEMALE";
    public static $MALE = "MALE";

    protected $name;
    protected $constant;

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = \ucwords($name);
    }

     public function getLetter(){
        return strtoupper(substr($this->getName(),0,1));
    }

    public function getLabel() {
        return \ucwords($this->getName());
    }
}
