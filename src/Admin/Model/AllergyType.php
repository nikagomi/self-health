<?php

namespace Admin\Model;

use Neptune\DbMapper;

/**
 * AllergyType
 * @package self-health
 * @author Randal Neptune
 */
class AllergyType extends DbMapper {
    protected $_tableName = "allergy_types";
    protected $primaryKeyField = "allergy_type_id";

    protected $uniqueCombo = array(array("name"));
    protected $uniqueComboErrorMsg = "The allergy type is already defined";

    protected $fieldMapper = array(
         "id" => array("allergy_type_id","T"),
         "name" => array("name","T")
    );

    protected $name;

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }
    
    public function getLabel() {
        return $this->getName();
    }
}
