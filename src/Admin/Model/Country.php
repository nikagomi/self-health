<?php

/**
 * Description of EduCountry
 * @package sarms
 * @author Randal Neptune
 */

namespace Admin\Model;

use Neptune\DbMapper;

class Country extends DbMapper {
    protected $_tableName = "countries";
    protected $primaryKeyField = "country_id";

    protected $uniqueCombo = array(array("name"));
    protected $uniqueComboErrorMsg = "The country already exists";

    protected $fieldMapper = array(
         "id" => array("country_id","T"),
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
