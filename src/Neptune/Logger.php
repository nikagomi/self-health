<?php

/**
 * Any child that extends this class will have any changes made to the entity logged.
 * Also forces the implemetation of the iModifiable interface.
 * @package sarms
 * @author Randal Neptune
 */

namespace Neptune;

use Neptune\{Log, PropertyService};

abstract class Logger extends DbMapper { //implements iModifiable
   
        protected static $create = "CREATE";
        protected static $update = "UPDATE";
        protected static $delete = "DELETE";
        protected static $reactivate = "REACTIVATE";
        protected $noReplicate = 0;
        protected $allowLogging;
        protected $logOps = true;
        
        
        public function __construct() {
            parent::__construct();
            $this->allowLogging = true && $this->logOps;
        }
        
        public function getNoReplicate(){
            return $this->noReplicate;
        }
        
        /**
         * Save and log the changes in the database
         * @return Logger 
         */
        public function save(){
            $this->saveTest();
            if($this->getOpStatus()){
               $this->logEntity(self::$create);
            }
        }
        
        public function reactivate(){
            $this->reactivateTest();
            if($this->getOpStatus()){
               $this->logEntity(self::$reactivate);
            }
        }
        
        
        /**
         * To update entity in the database and log the action
         * @return Logger 
         */
        public function update(){
            $this->updateTest();
            if($this->getOpStatus()){
                $this->logEntity(self::$update, false);
            }
        }
        
        
        /**
         * To update entity in database and log the action. Will modify empty fields.
         * @return Logger
         */
        public function updateIncludeEmptyFields() {
            $this->updateIncludeEmptyFieldsTest();
            if($this->getOpStatus()){
                $this->logEntity(self::$update, true);
            }
            //return $this;
        }
        
        
        /**
         * To delete the entity from the interface. 
         * This sets the softdeletefield flag to false in database.
         * Maintains data integrity.
         * @return Logger 
         */
        public function delete(){
           $this->deleteTest();
           if($this->getOpStatus()){
               $this->logEntity(self::$delete);
           }
          //return $this;
	}
        
        
        /**
         * Convenience method to delete entity pasing the id (usually primary key).
         * @param mixed $id
         * @return Logger
         */
        public function deleteById($id){
            $this->getEntityById($id);
            return $this->delete();
	}
        
        
        /**
         * To generate the string of values.
         * @param Logger $obj
         * @return string 
         */
        public function getValueString($obj){
            $valString = "";
            foreach($obj->fieldMapper as $propertyField => $dbFields){
                $valString .= ";_".$dbFields[0]. "=" .$obj->$propertyField;
            }
            return $valString;
        }
        
        /**
         * Returns a sql statement for the log table and the 
         * class in question
         * @return string
         */
        public function generateSaveSql() {
           
            $sql = "";
            $this->saveTest();
            if($this->getOpStatus()){
                if ($this->allowLogging) {
                    $log = new Log();
                    $newVals = $this->getValueString($this);
                    //set the log values
                    $log->setNewValues($newVals);
                    $log->setPreviousValues("");
                    $log->setAction(self::$create);
                    $log->setStatement($this->dbEscapeString($this->getOpMessage())); //contains sql statement
                    $log->setRecordId($this->getId());
                    $log->setLogDate("now()");
                    $log->setLogTime("now()");
                    $log->setTable($this->getTableName());
                    $log->setUserId($_SESSION['userId']);
                    $log->setNoReplicate($this->getNoReplicate());
                    $sql .=  $log->generateSaveSql()." ".parent::generateSaveSql();
                } else {
                    $sql =  parent::generateSaveSql();
                }
            }
            //echo $sql;
            return $sql;
        }
        
        /**
         * Returns a sql statement for the log table and the 
         * class in question
         * @return string
         */
        public function generateUpdateSql() {
            $sql = "";
            $this->updateTest();
            if($this->getOpStatus()){
                if ($this->allowLogging) {
                    $obj = new $this->className();
                    $log = new Log();

                    $obj->getEntityById($this->getId());
                    $prevValues = $this->getValueString($obj);
                    $newVals = $this->getValueString($this);

                    //set the log values
                    $log->setNewValues($newVals);
                    $log->setPreviousValues($prevValues);
                    $log->setAction(self::$update);
                    $log->setStatement($this->dbEscapeString($this->getOpMessage())); //contains sql statement
                    $log->setRecordId($this->getId());
                    $log->setLogDate("now()");
                    $log->setLogTime("now()");
                    $log->setTable($this->getTableName());
                    $log->setUserId($_SESSION['userId']);
                    $log->setNoReplicate($this->getNoReplicate());
                    $sql .= $log->generateSaveSql()." ".parent::generateUpdateSql();
                } else {
                    $sql = parent::generateUpdateSql();
                }
            }
            return $sql;
        }
        
        /**
         * 
         * @return string
         */
        public function generateUpdateWithEmptyFieldsSql() {
            $sql = "";
            $this->updateIncludeEmptyFieldsTest();
            if($this->getOpStatus()){
                if ($this->allowLogging) {
                    $obj = new $this->className();
                    $log = new Log();

                    $obj->getEntityById($this->getId());
                    $prevValues = $this->getValueString($obj);
                    $newVals = $this->getValueString($this);

                    //set the log values
                    $log->setNewValues($newVals);
                    $log->setPreviousValues($prevValues);
                    $log->setAction(self::$update);
                    $log->setStatement($this->dbEscapeString($this->getOpMessage())); //contains sql statement
                    $log->setRecordId($this->getId());
                    $log->setLogDate("now()");
                    $log->setLogTime("now()");
                    $log->setTable($this->getTableName());
                    $log->setUserId($_SESSION['userId']);
                    $log->setNoReplicate($this->getNoReplicate());
                    $sql .= $log->generateSaveSql()." ".parent::generateUpdateWithEmptyFieldsSql();
                } else {
                    $sql = parent::generateUpdateWithEmptyFieldsSql();
                }
            }
            return $sql;
        }
        
        /**
         * 
         * @return string
         */
        public function generateDeleteSql() {
            $sql = "";
            $this->deleteTest();
            if($this->getOpStatus()){
                if ($this->allowLogging) {
                    $log = new Log();
                    $prevVals = $this->getValueString($this);
                    //set the log values
                    $log->setNewValues("");
                    $log->setPreviousValues($prevVals);
                    $log->setAction(self::$delete);
                    $log->setStatement($this->dbEscapeString($this->getOpMessage())); //contains sql statement
                    $log->setRecordId($this->getId());
                    $log->setLogDate("now()");
                    $log->setLogTime("now()");
                    $log->setTable($this->getTableName());
                    $log->setUserId($_SESSION['userId']);
                    $log->setNoReplicate($this->getNoReplicate());
                    $sql .= $log->generateSaveSql()." ".parent::generateDeleteSql();
                }
                $sql .= parent::generateDeleteSql();
            }
            //echo "lah";
            return $sql;
        }
        
        /**
         * 
         * @return string
         */
        public function generateReactivateSql() {
            $sql = "";
            $this->reactivateTest();
            if($this->getOpStatus()){
                if ($this->allowLogging) {
                    $obj = new $this->className();
                    $log = new Log();

                    $obj->getEntityById($this->getId());
                    $prevValues = $this->getValueString($obj);
                    $newVals = $this->getValueString($this);

                    //set the log values
                    $log->setNewValues($newVals);
                    $log->setPreviousValues($prevValues);
                    $log->setAction(self::$reactivate);
                    $log->setStatement($this->dbEscapeString($this->getOpMessage())); //contains sql statement
                    $log->setRecordId($this->getId());
                    $log->setLogDate("now()");
                    $log->setLogTime("now()");
                    $log->setTable($this->getTableName());
                    $log->setUserId($_SESSION['userId']);
                    $log->setNoReplicate($this->getNoReplicate());
                    $sql .= $log->generateSaveSql()." ".parent::generateReactivateSql();
                }
                $sql .= parent::generateReactivateSql();
            }
            return $sql;
        }
        
        /**
         * Function to save logs into database.
         * @param type $action
         * @return Logger 
         */
        public function logEntity($action = "CREATE",$includeEmptyFields = false){
            
            
            if(\strtoupper($action) == self::$create){
                $dbSql = "BEGIN TRANSACTION; ".$this->generateSaveSql()." COMMIT;";
                //echo $dbSql;
                if($this->dbQuery($dbSql)){
                    $this->setOpStatus(true);
                    $this->setOpMessage("The information entered was successfully saved");
                }else{
                    $this->setId("");
                    $this->setOpStatus(false);
                    $this->setOpMessage("Error: The entered information could not be saved. Please try again or contact Administrator.");
                }
                return $this;
                
            }elseif(\strtoupper($action) == self::$update || \strtoupper($action) == self::$reactivate){
                              
                if(\strtoupper($action) == self::$reactivate){
                    $dbSql = "BEGIN TRANSACTION; ".$this->generateReactivateSql()." COMMIT;";
                }elseif(!$includeEmptyFields){
                    $dbSql = "BEGIN TRANSACTION; ".$this->generateUpdateSql()." COMMIT;";
                }else{
                    $dbSql = "BEGIN TRANSACTION; ".$this->generateUpdateWithEmptyFieldsSql()." COMMIT;";
                }
                //echo $dbSql;
                if($this->dbQuery($dbSql)){
                    $this->setOpStatus(true);
                    $this->setOpMessage("The changes were successfully updated");
                }else{
                    $this->setId("");
                    $this->setOpStatus(false);
                    $this->setOpMessage("Error: Changes could not be updated. Please try again or contact the Administrator.");
                }
                return $this;
            }elseif(\strtoupper($action) == self::$delete){
                
                $dbSql = "BEGIN TRANSACTION; ".$this->generateDeleteSql()." COMMIT;";
                //echo $dbSql;
                if($this->dbQuery($dbSql)){
                    $this->setOpStatus(true);
                    $this->setOpMessage("The selection was successfully deleted");
                }else{
                    $this->setId("");
                    $this->setOpStatus(false);
                    $this->setOpMessage("Error: The selection was not deleted. Please try again or contact the Administrator.");
                }
                return $this;
            }else{
                $this->setOpStatus(false);
                $this->setOpMessage("Could not identify the log operation");
                return $this;
            }
        }
         
        
        /**
         * Tests whether the delete action on the entity will be successful.
         * @return Logger 
         */
        public function deleteTest(){
            $sql  = "UPDATE ".$this->getTableName()." SET ".$this->getSoftDeleteFieldName()." = false ";
            $sql .= " WHERE ".$this->getPk()." = ".$this->prepareId().";";
            $transaction = "BEGIN TRANSACTION; ". $sql ." ROLLBACK;";
            //echo $transaction."<br/><br/>";
            if($this->dbQuery($transaction)){
                $this->setOpStatus(true);
                $this->setOpMessage($sql);
                return $this;
            }else{
                $this->setOpStatus(false);
                $this->setOpMessage("Could not complete the operation. Try again or contact your Administrator.");
                return $this;
            }
	}
        
        
        public function reactivateTest(){
            $sql  = "UPDATE ".$this->getTableName()." SET ".$this->getSoftDeleteFieldName()." = true ";
            $sql .= " WHERE ".$this->getPk()." = ".$this->prepareId().";";
            $transaction = "BEGIN TRANSACTION; ". $sql ." ROLLBACK;";
            if($this->dbQuery($transaction)){
                $this->setOpStatus(true);
                $this->setOpMessage($sql);
                return $this;
            }else{
                $this->setOpStatus(false);
                $this->setOpMessage("Could not complete the operation. Try again or contact your Administrator.");
                return $this;
            }
	}
        
        
        /**
         * Test whether the save action on the entity will be successful.
         * @return Logger 
         */
         public function saveTest(){
           
            $fieldList = '';
            $valueList = '';
            $i = 0;
            foreach($this->fieldMapper as $propertyField => $dbFields){
               foreach(get_object_vars($this) as $prop => $val){
                    if($propertyField == $prop && $propertyField != 'id'){
                        if($i > 0){
                            $fieldList .= ",";
                            $valueList .= ",";
                        }
                        $fieldList .= $dbFields[0];
                        $valueList .= $this->prepSqlValues($val,$dbFields[1]);
                        $i++;
                        break;	
                    }
                }
            }
            /** Check to see if will duplicate what's in db **/
            if($this->checkUniqueFields()){
                    $this->setOpStatus(false);
                    $this->setUniqueComboErrorMsg();
                    $this->setOpMessage($this->getUniqueComboErrorMsg());
                    return $this;
            }   
            
            //Serves for all databases - change if using autoincrement pks and 
            if($this->isIdEmpty()){//no value provided for id field 
                    $fieldList = $this->getPK().",".$fieldList;
                    $val = $this->constructPk();
                    $this->setId($val);
                    $valueList = $val.",".$valueList;
            }else{//application specifies a specific id (may modify to forward to update method)
                    $fieldList = $this->getPK().",".$fieldList;
                    $val = $this->prepareId($this->getId());
                    $valueList = $val.",".$valueList;
            }
         
            $sql = " INSERT INTO ".$this->getTableName()." (".$fieldList.") VALUES (".$valueList.");";
            $transaction = " BEGIN TRANSACTION; " .$sql. " ROLLBACK;";
            //echo $transaction;
            if($this->dbQuery($transaction)){
                $this->setOpStatus(true);
                $this->setId(trim($val,"'"));
                $this->setOpMessage($sql); //return the sql statement in this field
                //self::$statement = $sql;
                return $this;
            }else{
                $this->setId("");
                $this->setOpStatus(false);
                $this->setOpMessage("Error: Could not save your changes. Please try again or contact your administrator.");
                return $this;
            }
         }
         
        
        /**
         * To test the whether the update action will be succesful.
         * @return Logger 
         */
        public function updateTest(){
            
                $fieldValuePair = '';
		$i = 0;
		foreach($this->fieldMapper as $propertyField => $dbFields){
                    foreach(get_object_vars($this) as $prop => $val){
                      
                       if($prop == $propertyField && $propertyField != 'id'){
                          if($this->isFieldEmpty($val,$dbFields[1])){
                            if($i > 0){
                                $fieldValuePair .= ", ";
                            }
                            $fieldValuePair .= $dbFields[0]." = ".$this->prepSqlValues($val,$dbFields[1]);
                            $i++;
                            break;	
                        }
                    }
                  }
		}
		/** Check to see if will duplicate what's in db **/
		if($this->checkUniqueFields()){
                    $this->setOpStatus(false);
                    $this->setUniqueComboErrorMsg();
                    $this->setOpMessage($this->getUniqueComboErrorMsg());
                    return $this;
                } 
                
		$sql = "UPDATE ".$this->getTableName()." SET ". $fieldValuePair ." WHERE ".$this->getPK()." = ".$this->prepareId('').";";
                $transaction = " BEGIN TRANSACTION; ". $sql ." ROLLBACK;";
                //echo $transaction."<br/><br/>";
                
                if($this->dbQuery($transaction)){
                    $this->setOpStatus(true);
                    $this->setOpMessage($sql);
                    return $this;
		}else{
                    $this->setOpStatus(false);
                    $this->setOpMessage("Error: Could not save your changes. Please try again or contact your administrator.");
                    return $this;
		}
	}
        
        
        /**
         * Method that tests entity updates in database and takes into account the fields that are empty.
         * This means that if a field is empty its value is updated to null in the database.
         * @return Logger 
         */
        public function updateIncludeEmptyFieldsTest(){
                $fieldValuePair = '';
		$i = 0;
		foreach($this->fieldMapper as $propertyField => $dbFields){
                    foreach(get_object_vars($this) as $prop => $val){
                        if($prop == $propertyField && $propertyField != 'id'){
                            if($i > 0){
                                $fieldValuePair .= ", ";
                            }
                            
                            /** Constructing the sql statement **/
                            $fieldValuePair .= $dbFields[0]." = ".$this->prepSqlValues($val,$dbFields[1]);
                            $i++;
                            break;	
                        }
                  }
		}
		/** Check to see if will duplicate what's in db **/
		if($this->checkUniqueFields()){
                    $this->setOpStatus(false);
                    $this->setUniqueComboErrorMsg();
                    $this->setOpMessage($this->getUniqueComboErrorMsg());
                    return $this;
                } 
		
		$sql = "UPDATE ".$this->getTableName()." SET ". $fieldValuePair ." WHERE ".$this->getPK()." = ".$this->prepareId().";";
                $transaction = "BEGIN TRANSACTION; " . $sql ." ROLLBACK;";
                //echo $transaction;
                if($this->dbQuery($transaction)){
                    $this->setOpStatus(true);
                    $this->setOpMessage($sql);
                    return $this;
		}else{
                    $this->setOpStatus(false);
                    $this->setOpMessage("Error: Could not save your changes. Please try again or contact your administrator.");
                    return $this;
		}
	}
   
}

?>
