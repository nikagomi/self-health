<?php

namespace Admin\Model;

use Neptune\DbMapper;

/**
 * RelationshipType
 * @package self-health
 * @author Randal Neptune
 */
class RelationshipType extends DbMapper {
    protected $_tableName = "relationship_types";
    protected $primaryKeyField = "relationship_type_id";

    protected $uniqueCombo = [["name"]];
    protected $uniqueComboErrorMsg = "The relationship type is already defined";

    protected $fieldMapper = array(
         "id" => array("relationship_type_id","T"),
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
