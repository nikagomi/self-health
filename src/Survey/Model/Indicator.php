<?php

namespace Survey\Model;

use Neptune\DbMapper;

/**
 * Description of Indicator
 * @package oecs
 * @author nikagomi
 */
class Indicator extends DbMapper {
    protected $_tableName = "indicators";
    protected $primaryKeyField = "indicator_id";

    protected $uniqueCombo = [["name"]];
    protected $uniqueComboErrorMsg = "The indicator seems to already exists";

    protected $fieldMapper = array(
        "id" => array("indicator_id","I"),
        "name" => array("name","T")
    );
    
    protected $name;
    
    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = \ucwords($name);
    }


    public function getLabel () {
        return $this->getName();
    }
}
