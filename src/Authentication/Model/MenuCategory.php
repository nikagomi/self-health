<?php

namespace Authentication\Model;

use Neptune\DbMapper;

/**
 * MenuCategory: Level 1 labels on horizontal menu
 * @package hiags
 * @author Randal Neptune
 */
class MenuCategory extends DbMapper{
    protected $_tableName = "menu_categories";
    protected $primaryKeyField = "category_id";
    protected $uniqueCombo = array(array("name"));
    protected $uniqueComboErrorMsg;
    protected $fieldMapper = array(
        "id" => array("category_id", "I"),
        "name" => array("name", "T"),
        "order" => array("order", "I"),
        "messageResource" => array("message_resource","T")
    );
    protected $name;
    protected $order;
    protected $messageResource;

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function getOrder() {
        return $this->order;
    }
    
    public function getMessageResource() {
        return $this->messageResource;
    }

    public function setMessageResource($messageResource) {
        $this->messageResource = $messageResource;
    }

    public function setOrder($order) {
        $this->order = $order;
    }

    public function getLabel() {
        return $this->getName();
    }

}
