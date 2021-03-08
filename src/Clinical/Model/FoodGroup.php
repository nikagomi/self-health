<?php

namespace Clinical\Model;

use Neptune\DbMapper;

/**
 * FoodGroup
 * @package self-health
 * @author Randal Neptune
 */
class FoodGroup extends DbMapper {
    protected $_tableName = "food_groups";
    protected $primaryKeyField = "food_group_id";

    protected $uniqueCombo = [["name"], ["imageName"]];
    protected $uniqueComboErrorMsg = "The food group has already been defined";

    protected $fieldMapper = array(
        "id" => array("food_group_id","T"),
        "name" => array("name","T"),
        "imageName" => ["image_name","T"],
        "originalImageName" => ["original_image_name","T"]
    );

    protected $name;
    protected $imageName;
    protected $originalImageName;

    public function getName() {
        return $this->name;
    }
    
    public function getImageName() {
        return $this->imageName;
    }

    public function getOriginalImageName() {
        return $this->originalImageName;
    }

    public function setImageName($imageName) {
        $this->imageName = $imageName;
    }

    public function setOriginalImageName($originalImageName) {
        $this->originalImageName = $originalImageName;
    }

    public function setName($name) {
        $this->name = $name;
    }
    
    public function getLabel() {
        return $this->getName();
    }
}
