<?php


namespace Admin\Model;
use Neptune\Logger;

/**
 * Represents the language locales for the users
 * @package sarms
 * @author Randal Neptune
 */
class EduLocale extends Logger{
    protected $_tableName = "edu_locales";
    protected $primaryKeyField = "locale_id";

    protected $uniqueCombo = array(array("code"), array("definition"));
    protected $uniqueComboErrorMsg = "The locale code or definition is already recorded";

    protected $fieldMapper = array(
        "id" => array("locale_id","T"),
        "code" => array("locale_code","T"),
        "definition" => array("definition")
    );
    
    protected $code;
    protected $definition;
    
    public function getCode() {
        return $this->code;
    }

    public function getDefinition() {
        return $this->definition;
    }

    public function setCode($code) {
        $this->code = $code;
    }

    public function setDefinition($definition) {
        $this->definition = $definition;
    }
    
    public function getLabel(){
        return $this->getDefinition();
    }

}