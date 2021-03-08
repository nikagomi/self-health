<?php

namespace Admin\Model;

use Neptune\Logger;

/**
 * Manages titles eg. Dr, Mr, Mrs, Miss
 * @package sarms
 * @author Randal Neptune
 */
class Title extends Logger{
    
   protected $_tableName = "titles";
   protected $primaryKeyField = "title_id";
   
   protected $uniqueComboErrorMsg;
   protected $uniqueCombo = array(array("name"));
     
   protected $fieldMapper = array(
   	"id" => array("title_id","I"), 
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
