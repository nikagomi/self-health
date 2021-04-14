<?php

namespace Admin\Model;
use Neptune\Logger;

/**
 * Religion
 * @package smile
 * @author Randal Neptune
 */
class Religion extends Logger{
    protected $_tableName = "religions";
    protected $primaryKeyField = "religion_id";

    protected $uniqueCombo = array(array("name"));
    protected $uniqueComboErrorMsg;

    protected $fieldMapper = array(
         "id" => array("religion_id","T"),
         "name" => array("name","T")
    );

    protected $name;

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }
}