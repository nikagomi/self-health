<?php

namespace Neptune;
/**
 * @author Randal Neptune
 * Contact: randalneptune@gmail.com  (758) 719-1623 / (246) 835-1295
 * @copyright This notice MUST stay intact for legal use
 * DbMapper class (previously DbEntity) - OOP PHP implementation
 * @version DbMapper_3.0 
 * @since 18th September, 2011
 * @abstract
 */

abstract class DbMapper{
    
        /**
         * 
         * @var string holds the database table (schema) name that the class corresponds to
         */
        protected $_tableName;
        /**
         *
         * @var string holds the primary key field of the class table in database 
         */
	protected $primaryKeyField;
        /**
         * An associative array classProperty => array(dbField, dbFieldType)
         * Field Types: D - date/datetime; I - Integer; T - Text/string; B - Boolean; R - Real/double/numeric
         * @var array maps the class properties to the database fields
         */
	protected $fieldMapper; 
        /**
         *
         * @var array An array of fields whose combination should always be unique
         */
	protected $uniqueCombo;
	protected $uniqueComboErrorMsg;
        protected $sequencer;
	
        protected $id; /** drill down inheritance */
	private $_link;
        
        /** $sequenceTable and $siteId are not being used in this implemenetation of DbMapper **/
	private $sequenceTable = "sequences";
	protected $className;
	private $opStatus;
	private $opMessage;
	protected $softDeleteFieldName = "alive";
        
        protected $dateDisplayStr = 'd/m/Y';
        protected $dateTimeDisplayStr = 'M j, Y g:i a';
        protected $dateTimeSortProperty;
        protected $labelSortProperty;
        
        public function __construct(){
            //$this->sequencer = new Sequence();
            $this->_link = DbMapperUtility::dBInstance();
            $this->className = get_class($this);
            $sdfn = $this->softDeleteFieldName;
            //$ex = null;
            $e = null;
            if($this->_link == false){
                $e = new \Error("The database link resource is null or invalid. Please review.", 2200);
            }elseif(empty($this->primaryKeyField)){
                $e = new \Error("The primary key field must be specified in the class.", 2201);
            }elseif(empty($sdfn)){
                $e = new \Error("The soft delete field must be used and specified to guarantee data integrity.",2202);
            }elseif(empty($this->fieldMapper) || !is_array($this->fieldMapper)){
                $e = new \Error("The field mapper property must be an array and cannot be empty.", 2203);
            }elseif(empty($this->_tableName)){
                $e = new \Error("Please specify the table name in the database that the class represents.", 2204);
            }
            
            if ($e !== NULL) {
                \Error\Model\ExceptionHandler::logException($e);
            }
	}
	
	public function getLink(){
            return $this->_link;
	}
	
	public function getTableName(){
            return $this->_tableName;
	}
	
	public function getPK(){
            return $this->primaryKeyField;
	}
        
        public function getId(){
            return $this->id;
	}
	
        public function getDateDisplayStr(){
            return $this->dateDisplayStr;
        }
        
        public function setDateDisplayStr($dateDisplayStr) {
            $this->dateDisplayStr = $dateDisplayStr;
        }
        
        public function getDateTimeDisplayStr() {
            return $this->dateTimeDisplayStr;
        }

        public function setDateTimeDisplayStr($dateTimeDisplayStr) {
            $this->dateTimeDisplayStr = $dateTimeDisplayStr;
        }
        
        public function getDateTimeSortProperty() {
            return $this->dateTimeSortProperty;
        }

        public function setDateTimeSortProperty($dateTimeSortProperty) {
            $this->dateTimeSortProperty = $dateTimeSortProperty;
        }
        
        public function getLabelSortProperty() {
            if (\method_exists($this, "getLabel") && $this->labelSortProperty == "") {
                return "label";
            } else {
                return $this->labelSortProperty;
            }
        }

        public function setLabelSortProperty($labelSortProperty) {
            $this->labelSortProperty = $labelSortProperty;
        }

        public function setId($id){
            $this->id = $id;
	}

	public function getOpStatus(){
            return $this->opStatus;
        }
	
	public function setOpStatus($opStatus){
            $this->opStatus = $opStatus;
        }
	
	public function getClassName(){
            return get_class($this);
	}
	
	public function getUniqueComboErrorMsg(){
            return $this->uniqueComboErrorMsg;
	}
	
	public function getOpMessage(){
            return $this->opMessage;
	}
	
	public function setOpMessage($opMessage){
            $this->opMessage = $opMessage;
	}
	
	public function getSoftDeleteFieldName(){
            return $this->softDeleteFieldName;
	}
	
	public function setSoftDeleteFieldName($softDeleteFieldName){
            $this->softDeleteFieldName= $softDeleteFieldName;
	}
	
	public function getSequenceTable(){
            return $this->sequenceTable;
	}
	
	public function getSiteId(){
            return $this->siteId;
	}
	
	public function getFieldMapper(){
            return $this->fieldMapper;
	}
	
	public function getUniqueComboArray(){
            return $this->uniqueCombo;
	}
	
	public function getObjectVars(){
            return get_object_vars($this);
	}
        
        public function isYearMonthDateFormat ($date) {
            $dt = \DateTime::createFromFormat("Y-m-d", $date);
            return $dt !== false && !array_sum($dt->getLastErrors());
        }
        
        public function isDisplayDateFormat ($date) {
            $dt = \DateTime::createFromFormat($this->getDateDisplayStr(), $date);
            return $dt !== false && !array_sum($dt->getLastErrors());
        }
	
        public function formatSetDbDate ($date) {
            if ($date !== null || $date !== '') {
                if ($this->isYearMonthDateFormat($date)) {
                    return $date;
                } elseif ($this->isDisplayDateFormat($date)) {
                    $dbStartDate = \DateTime::createFromFormat($this->getDateDisplayStr(), $date);
                    return $dbStartDate->format("Y-m-d");
                } else {
                    return $date;
                }
            } else {
                return $date;
            }
        }
        
        /**
         * Determine is the current object is activated or not
         * @return bool
         */
        public function isAlive() : bool {
            $sql = "SELECT ".$this->getSoftDeleteFieldName()." FROM ".$this->getTableName()." WHERE ";
            $sql .= $this->getPK()." = ".$this->prepareId($this->getId());
            $result = $this->dbFetchArray($this->dbQuery($sql));
            return ($result[0] == 't' || $result[0] == 1) ? true : false;
        }
        
        /**
         * Simple method to return a string or numeric id.
         * Removed the strtoupper condition as ids should not be touched directly by the user
         * @return mixed 
         */
        public function prepareId($id = ''){
            $dbProperty = $this->fieldMapper['id'];
            if($id == ''){
                if($dbProperty[1] == 'T'){
                    $useId = "'".$this->getId()."'";
                }else{
                    $useId = $this->getId();
                }
            }else{
                if($dbProperty[1] == 'T'){
                    $useId = "'".$id."'";
                }else{
                    $useId = $id;
                }
            }
            return $useId;
        }
        
        /**
         * Custom error message can be set here.
         * May be overridden in child classes.
         */
        public function setUniqueComboErrorMsg(){
            if(@empty($this->uniqueComboErrorMsg)){
                $this->uniqueComboErrorMsg = "Could not perform operation because it will create a duplicate entry";
            }else{
                return $this->uniqueComboErrorMsg;
            }
        }
	
	/**
         * Determines whether the id property of the object exists or not.
         * This tends to inform a save or update operation.
         * @return boolean 
         */
	public function isIdEmpty(){
            if(@empty($this->id) or $this->id == ''){
                return (bool) true;
            }else{
                return (bool) false;
            }
	}
	
        /**
         * Executes the entered sql against the database.
         * A wrapper function.
         * @param string $sql
         * @return resource 
         */
	public function dbQuery($sql){
            $result = pg_query(DbMapperUtility::dBInstance(),$sql);
            return (!$result) ? false : $result;
	}
	
        /**
         * Returns the result array held in the resource passed to it.
         * This resource would be as a result of the function
         * @see dbQuery()
         * @param resource $result
         * @return array 
         */
	public function dbFetchArray($result){
            return pg_fetch_array($result,null,PGSQL_BOTH);
	}
        
        /**
         * Returns the result rows of a database query but with field names as
         * the associative array index
         * @param resource $result
         * @return array 
         */
        public function dbFetchArrayAssociative($result){
            return pg_fetch_array($result,null,PGSQL_ASSOC);
	}
	
        /**
         * Counts the number of result rows returned from the database.
         * @param resource $result
         * @return integer 
         */
	public function dbNumRows($result){
            return pg_num_rows($result);
	}
        
        /**
         * Returns the number of rows affected by a DB operation
         * @param resource $result
         * @return integer
         */
        public static function dbRowsAffected($result){
            return pg_affected_rows($result);
        }
	
        /**
         * Returns the field name of the db result that corresponds to the index $i specified
         * @param resource $result
         * @param integer $i
         * @return string 
         */
	public function dbFieldName($result,$i){
            return @pg_field_name($result,$i);
	}
        
        /**
         * Cleans up a string value for insertion into database.
         * Especially useful when dealing with single and double quotes.
         * @param string $var
         * @return string 
         */
        protected function dbEscapeString($var){
            return pg_escape_string($var);
        }
        
	
	/**
	* Core class function. Returns object of class. Object values corresponds to row in
	* database table identified by primary key value passed to function.
	* Returns an object instance of the class
        * @param integer $id
        * @return DbMapper
	*/
	public function getEntityById($id){
	    $sql = "SELECT * FROM ".$this->getTableName()." WHERE ".$this->getPk()." = ".$this->prepareId(\trim($id));
            $result = $this->dbQuery($sql);
            return $this->mapFieldValues($result);
	}
        
        /**
         * A more OOP sounding name for getEntityById
         * @param mixed $id
         * @return \Neptune\DbMapper
         */
        public function getObjectById($id){
	    return $this->getEntityById(\trim($id));
	}
	
	/**
      	* Core class function. Maps database field values to property values of the object.
        * The $result parameter is the result of a SELECT sql statement (with the full row returned)
        * @param resource $result
        * @return DbMapper
	*/
	protected function mapFieldValues($result){
            if($this->dbNumRows($result) > 0 and is_array($this->fieldMapper) ){
                $res = $this->dbFetchArray($result);
                $numFields = pg_num_fields($result);
                for($i = 0; $i < $numFields; $i++){
                    foreach($this->fieldMapper as $propertyField => $dbFields){
                        $dbFieldName = $this->dbFieldName($result,$i);
                        if($dbFields[0] == $dbFieldName){
                            $this->$propertyField = $res[$dbFieldName];
                            //echo $propertyField ." =  ".$res[$dbFieldName]." ".$this->className."<br/>";
                            break;
                         }
                    }
                }
            } else {
                $this->clear();
            }		
            return $this;
	}
        
        public function copyFrom ($obj) {
            if ($this->getClassName() == $obj->getClassName()) {
                foreach ($this->fieldMapper as $propertyField => $dbFields) {
                     $getter = "get".\ucwords($propertyField);
                     $setter = "set".\ucwords($propertyField);
                     $this->$setter($obj->$getter());
                }
            } else {
                $this->clear();
            }
            return $this;
        }
        
        /**
	* Method to return all active (soft delete field name  = true) entities of this type 
        * from the database.
	* Returns an array of objects
        * @return array
	*/
	public function getAll($withSoftDeleteField = true){
            $objArr = array();
            $whereClause = ($withSoftDeleteField) ? " WHERE ".$this->getSoftDeleteFieldName()." = true" : "";
            $sql= "SELECT ".$this->getPk()." FROM ".$this->getTableName().$whereClause;
            $result = $this->dbQuery($sql);
            $num = $this->dbNumRows($result);
            if($num > 0){
                $j = 0;
                while($res = $this->dbFetchArray($result)){
                    $newInstance = new $this->className();
                    $objArr[$j] = $newInstance->getEntityById($res[0]); 
                    $j++;
                }
            }
            return $objArr;
	}
	
       /**
	* Method to prepare form values to be inserted into db via sql statements
	* Accepts values of types below:
	* D - date, TS - timestamp; I - Integer; T - Text/string; B - Boolean; R - Real/double/numeric, HTML - html text, BN - Nullable boolean
        * The letter identifiers (D,I,T,B,R,HTML) correspond to the fieldMapper array identifiers
        * @param mixed $val
        * @param string $type
        * @return mixed
	*/
	public function prepSqlValues($val, $type){
            if (\strtoupper($type) == 'T') {
                $result  = (\trim($val) != "") ? "'".$this->dbEscapeString(\str_replace('"',"'",\trim(\strip_tags($val)," ")))."'" : "null";
            } elseif (\strtoupper($type) == 'HTML') {
                $result  = (\trim($val) != "") ? "'".\htmlspecialchars(str_replace('script'," ",$val),ENT_QUOTES)."'" : "null"; 
            } elseif (\strtoupper($type) == 'D' || \strtoupper($type) == 'TS') {
                if ($val == '') {
                    $result = "null";
                } else {
                    $result  = "'".\strip_tags($val)."'";
                }//\htmlspecialchars(str_replace('script'," ",$val),ENT_QUOTES)
            } elseif (\strtoupper($type) == 'B') {
                if ($val === '1' or $val === 1 or $val === 't' or $val === true or \strtoupper($val) == "TRUE") {
                     $result = "true";
                } else {
                    $result = "false";
                }
            } elseif (\strtoupper($type) == 'BN') {
                if ($val === '1' or $val === 1 or $val === 't' or $val === true or \strtoupper($val) == "TRUE") {
                     $result = "true";
                } elseif (\is_null($val) && (int)$val !== 0) {
                    $result = "null";
                } else {
                    $result = "false";
                }
            } elseif (\strtoupper($type) == 'I') {
                if ((\is_null($val) && (int)$val !== 0) || $val === "" || !isset($val)) {
                    $result = "null";
                } else {
                    $result = (\is_integer(intval($val))) ? $val : "null";
                }

            } elseif (strtoupper($type) == 'R') {
                if ((\is_null($val) && ((double)$val !== 0.00)) || $val === '' || !isset($val)) {
                    $result = "null";
                } else {
                    $result = (\is_numeric((double)$val)) ? $val : "null";
                }
            } else {
                $result = $val;
            }

            return $result;
	}
	
       /**
	* Method to retrieve an entity by multiple criteria
	* Accepts two arrays: the field names and values
	* hasSoftDelete: if the entity carries a soft delete field.
        * @param array $classProperties
        * @param array $values
        * @param boolean $useSoftDelete
        * @return DbMapper
	*/
        public function getEntityByMultipleCriteria(array $classProperties, array $values, $useSoftDelete = true){
            $sql  = " SELECT * FROM ".$this->getTableName()." WHERE ";
            if(count($classProperties) == count($values)){
                for($i = 0; $i < count($classProperties); $i++){
                    $sql .= ($i != 0) ? " AND " : "";
                        //Get corresponding dbfield
                        $dbFieldDetails = $this->getDbFieldFromPropertyName($classProperties[$i]);
                        $sql .= $dbFieldDetails[0] ." = ".$this->prepSqlValues($values[$i],$dbFieldDetails[1]);
                }
                if($useSoftDelete){
                        $sql .= " AND ".$this->getSoftDeleteFieldName()." = true";
                }
                $sql .= " LIMIT 1"; //only on entity to be returned
            }
            //echo $sql."<br/>";
            $result = $this->dbQuery($sql);
            $obj = $this->mapFieldValues($result);
            //echo $obj->getId();
            return $obj;
        }
        
        /**
	* Method to retrieve an entity by a single criteria
	* Accepts two arrays: the field names and values
	* hasSoftDelete: if the entity carries a soft delete field.
        * @param string $propertyName
        * @param mixed $propertyValue
        * @param boolean $hasSoftDeleteField 
        * @return DbMapper
	*/
        public function getEntityByCriteria($propertyName, $propertyValue, $hasSoftDeleteField = TRUE){
            $dbFieldDetails = $this->getDbFieldFromPropertyName($propertyName);
            $sql  = " SELECT ".$this->getPK()." FROM ".$this->getTableName()." WHERE ";
            $sql .= " upper(".$dbFieldDetails[0].") = ".\strtoupper($this->prepSqlValues($propertyValue, $dbFieldDetails[1]));
            
            if($hasSoftDeleteField){
                $sql .= " AND ".$this->getSoftDeleteFieldName()." = true";
            }
            $res = $this->dbFetchArray($this->dbQuery($sql));
            if(!empty($res[0])){
                return $this->getEntityById($res[0]);
            }else{
                return $this;
            }
	}
        
   	/**
	* Function to delete / deactivate records in the database
	* Sets the soft delete field to FALSE
        * @return DbMapper
	*/
	public function deleteById($id){
            $this->getEntityById($id);
            return $this->delete();
	}
	
		
	/**
	 * Function to delete / deactivate records in the database
         * Sets the soft delete field to FALSE. Using object.
         * @return DbMapper 
         */
	public function delete(){
            $sql  = "UPDATE ".$this->getTableName()." SET ".$this->getSoftDeleteFieldName()." = false ";
            $sql .= " WHERE ".$this->getPk()." = ".$this->prepareId($this->getId());
            if($this->dbQuery($sql)){
                $this->setOpStatus(true);
                $this->setOpMessage("The operation was successfully completed");
                return $this;
            }else{
                $this->setOpStatus(false);
                $this->setOpMessage("Could not complete the operation. A database error occurred.");
                return $this;
            }
	}
        
        /**
         * Generates the sql to be executed for the delete action.
         * @return string
         */
        public function generateDeleteSql(){
            $sql  = "UPDATE ".$this->getTableName()." SET ".$this->getSoftDeleteFieldName()." = false ";
            $sql .= " WHERE ".$this->getPk()." = ".$this->prepareId($this->getId()).";";
            return $sql;
        }
        
                
        /**
         * Physically removes the record from the database
         * @return \Neptune\DbMapper
         */
        public function hardDelete(){
            $sql  = "DELETE FROM ".$this->getTableName()." WHERE ".$this->getPk()." = ".$this->prepareId($this->getId());
            //echo $sql;
            if($this->dbQuery($sql)){
                $this->setOpStatus(true);
                $this->setId("");
                $this->setOpMessage("The operation was successfully completed");
                return $this;
            }else{
                $this->setOpStatus(false);
                $this->setOpMessage("Could not complete the operation. A database error occurred.");
                return $this;
            }
        }
	
        /**
         * Method to reactivate a deactivated object.
         * @uses $object->reactivate()
         * Where $object is a previously deactivated object i.e. softDeleteField = false
         * @return DbMapper 
         */
        public function reactivate(){
            $sql = $this->generateReactivateSql();
            //echo $sql."<br>";
            if($this->dbQuery($sql)){
                $this->setOpStatus(true);
                $this->setOpMessage("The entity was successfully reactivated");
            }else{
                $this->setOpStatus(false);
                $this->setOpMessage("Error: The entity could not be reactivated");
            }
            return $this;
        }
	
        /**
         * Generates the sql to be executed for the reactivate action.
         * @return string
         */
        public function generateReactivateSql(){
            $sql  = "UPDATE ".$this->getTableName()." SET ".$this->getSoftDeleteFieldName()." = true";
            $sql .= " WHERE ".$this->getPK()." = ".$this->prepareId().";";
            return $sql;
        }
	
	/**
	* Method to return an array of id and name for an html drop down listbox
	* Suitable for tables with these fields
        * @return array
	*/
	public function getDropDownArray($labelFieldName){
	    $resultArray = array();
            $resultArray[''] = '';
            $sql = " SELECT ".$this->getPk().", ".$labelFieldName." FROM ".$this->getTableName()." WHERE ";
            $sql .= $this->getSoftDeleteFieldName()." = true ORDER BY name ASC";
            //echo $sql;
            $result = $this->dbQuery($sql);
            while($res = $this->dbFetchArray($result)){
                $idx = $res[0];
                    $resultArray[$idx] = $res[1];
            }
            return $resultArray;
	}
        
        /**
         * Takes an array of objects and converts into a structure for a drop down array (smarty primarily)
         * @param type $objArr
         * @param type $labelFunc
         * @return array
         */
        public function convertObjectArrayToDropDown($objArr){
	    $resultArray = array();
            $resultArray[''] = '';
            foreach($objArr as $obj){
                $idx = $obj->getId();
                $resultArray[$idx] = $obj->getLabel();
            }
            return $resultArray;
        }
        
        
        /**
         * Returns an associative array of index => value for checkbox population.
         * @param string $labelFieldName
         * @return array 
         */
        public function getCheckBoxArray($labelFieldName){
	    $resultArray = array();
            $sql = " SELECT ".$this->getPk().", ".$labelFieldName." FROM ".$this->getTableName()." WHERE ";
            $sql .= $this->getSoftDeleteFieldName()." = true ORDER BY name ASC";
            $result = $this->dbQuery($sql);
            while($res = $this->dbFetchArray($result)){
                $idx = $res[0];
                    $resultArray[$idx] = $res[1];
            }
            return $resultArray;
	}
		
	/**
	 * Method to map form values to db entity
	 * Accepts the $_POST /$_GET global arrays from the submitted form
	 * To make use of this method the element names in form MUST coincide with property
	 * names of the class. 
         * @param array $request
         * @return DbMapper
	*/
	public function mapFormToEntity($request){
		//$newInstance = new $this->className();
		foreach($request as $param => $val){
                    foreach($this->fieldMapper as $propertyField => $dbFields){
                        if($param == $propertyField){
                            $setterName = "set".\ucwords($propertyField);
                            $this->$setterName($val);
                            break;
                        }
                    }
		}
		return $this;
	}
        
        /**
         * Method to reset object properties to null / no value.
         * @return DbMapper
         */
        public function clear(){
            foreach($this->fieldMapper as $propertyField => $dbFields){
                $this->$propertyField = null;
            }
            return $this;
        }
        
        /**
         * Takes care of doing additional specialized uniqueness checks
         * @param array $arr
         * @return boolean
         */
        public function additionalUniqueCheck(array $arr, $id){
            //array("__maxCount:1","active:true", "studentId");
            $passed = true;
            if(count($arr) > 1){ // make sure the structure is valid
                $actionValue = explode(":",$arr[0]);
                $max = $actionValue[1];
                $sql = " SELECT count(*) FROM ".$this->getTableName()." WHERE ";
                for ($i = 1; $i < count($arr); $i++) {
                    //position zero is reserved for the method and intended result.
                    $propertyValue = explode(":",$arr[$i]);
                    $dbFieldType = $this->fieldMapper[$propertyValue[0]]; //pass class property to get corresponding db field and type array
                    if ($i > 1) {//puts AND clause if there are multiple criteria
                        $sql .= " AND ";
                    }
                    $methodName = "get".\ucwords($propertyValue[0]);
                    $val = '';
                    if ($propertyValue[1] != "") {
                        $val = $this->prepSqlValues($propertyValue[1], $dbFieldType[1]);
                        $sql .= $dbFieldType[0]." = ".$val;
                    } else {
                        $val = $this->prepSqlValues($this->$methodName(),$dbFieldType[1]);
                        $sql .= ($val == "null") ? $dbFieldType[0]." is null " : $dbFieldType[0]." = ".$val;
                    }
                    
                }
                $sql .= " AND ".$this->softDeleteFieldName." = true";
                if ($id != '') {
                    $sql .= " AND ".$this->getPK()." <> ".$this->prepareId($id);
                }
            }
            //echo $sql;
            $res = $this->dbFetchArray($this->dbQuery($sql)); //res[0] contains the count
            switch ($actionValue[0]) {
                case "__maxCount":
                    $passed = ($res[0] < $max); /* OJO */
                    break;
                default:
                    $passed = true;
            }
            return (bool) $passed;
        }
        
        /**
         * Checks unique combination arrays
         * Returns true is there are duplicates and false if there are none.
         * @return boolean
         */
        public function checkUniqueFields(){
            if(is_array($this->uniqueCombo) && !empty($this->uniqueCombo)){
                for($i = 0; $i < count($this->uniqueCombo); $i++){
                    $uniqueFldArr = $this->uniqueCombo[$i];
                    $uniqueComboTypes = array();
                    $uniqueComboValues = array();
                    $uniqueComboFields = array();
                    if(is_array($uniqueFldArr)){
                        $pos = \strpos($uniqueFldArr[0],"__");
                        if($pos !== false){
                            if(!$this->additionalUniqueCheck($uniqueFldArr,$this->getId())){
                                $this->setOpStatus(false);
                                $this->setUniqueComboErrorMsg();
                                $this->setOpMessage($this->getUniqueComboErrorMsg());
                                return true; 
                            }
                        }else{
                            foreach($this->fieldMapper as $propertyField => $dbFields){
                                foreach(get_object_vars($this) as $prop => $val){
                                    if($propertyField == $prop && $propertyField != 'id'){
                                        for($x = 0; $x < count($uniqueFldArr); $x++){
                                            if($propertyField == $uniqueFldArr[$x]){
                                                $uniqueComboTypes[$x] = $dbFields[1];
                                                $uniqueComboValues[$x] = $val;
                                                $uniqueComboFields[$x] = $dbFields[0];
                                                break;
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                    if($this->isRecordPresent($uniqueComboFields,$uniqueComboValues,$uniqueComboTypes,$this->getId())){
                        $this->setOpStatus(false);
                        $this->setUniqueComboErrorMsg();
                        $this->setOpMessage($this->getUniqueComboErrorMsg());
                        return true; 
                    }
                }
            }
            return false;
        }
        
        
        /**
         * Convenience method to construct the primary key value (especially on a save)
         * What is returned depends on whether the primary key is an integer or not.
         * @return string 
         */
        public function constructPk(){
            $dbProperty = $this->fieldMapper['id'];
            if($dbProperty[1] == 'I'){
                $pk = $this->buildSequence();
            }else{
                try{
                    if(isset($_SESSION['code']) && !empty($_SESSION['code'])){
                        $pk = "'".$_SESSION['code'].$this->buildSequence()."'";
                    }elseif(\Neptune\PropertyService::getProperty("pk.code.prefix","") != ""){
                        /** Not sure about keeping this part **/
                        $code = \Neptune\PropertyService::getProperty("pk.code.prefix","");
                        $pk = "'".$code.$this->buildSequence()."'";
                    }else{
                        throw new \Exception("Code is not defined");
                    } 
                }catch(Exception $e){
                    $this->setOpMessage("<div align='center' class='errorMessage'>".$e->getMessage()."</div>");
                }   
            }
            $this->setId($pk);
            return $pk;
        }
        
	/**
         * Determines whether a value is empty based on the type
         * @param mixed $val
         * @param string $type
         * @return boolean 
         */
        public function isFieldEmpty($val,$type){
            if(\strtoupper($type) == 'B' || \strtoupper($type) == 'BN'){
                if($val !== ''){
                    return true;
                }else{
                    return false;
                }
            }else{
                if($val != ''){
                    return true;
                }else{
                    return false;
                }
            }
        }
        
        /**
         * Returns the db field name that corresponds to the class property supplied 
         * @param string $propertyName
         * @return array
         */
        public function getDbFieldFromPropertyName($propertyName){
            $dbDetails = array();
            foreach($this->fieldMapper as $propertyField => $dbFields){
                if( (\strtoupper($propertyName) == \strtoupper($propertyField)) || (\strtoupper($dbFields[0]) == \strtoupper($propertyName)) ){
                    $dbDetails = $dbFields;
                }
            }
            return $dbDetails;
        }
        
        public function getFieldNameFromProperty($propertyName){
            $dbDetails = array();
            foreach($this->fieldMapper as $propertyField => $dbFields){
                if( (\strtoupper($propertyName) == \strtoupper($propertyField)) || (\strtoupper($dbFields[0]) == \strtoupper($propertyName)) ){
                    $dbDetails = $dbFields;
                }
            }
            return $dbDetails[0];
        }
        
	/**
	 * Method to save an entity to the database. This method should be called on the
	 * object whose properties contain the values that are to be saved.
         * Also checks to make sure unique value combinations are not duplicated in database.
         * @return DbMapper
	*/
	public function save(){
            $fieldList = '';
            $valueList = '';
            $i = 0;
            $z = 0;

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
                    $valueList = $val.",".$valueList;
            }else{//application specifies a specific id (may modify to forward to update method)
                    $fieldList = $this->getPK().",".$fieldList;
                    $val = $this->prepareId($this->getId());
                    $valueList = $val.",".$valueList;
            }
            $sql = "INSERT INTO ".$this->getTableName()." (".$fieldList.") VALUES (".$valueList.");";
            //echo $sql."<br/><br/>";
            if($this->dbQuery($sql) !== false){
                $this->setOpStatus(TRUE);
                $this->setId(trim($val,"'"));
                $this->setOpMessage("The information entered was successfully saved");
                return $this;
            }else{
                $this->setId("");
                $this->setOpStatus(FALSE);
                $this->setOpMessage("Error: Could not save the information entered. Please try again or contact your administrator.");
                return $this;
            }
        }
        
        /**
         * Returns sql statement to be executed for the save action
         * @return string
         */
        public function generateSaveSql(){
            
            $fieldList = '';
            $valueList = '';
            $i = 0;
            $sql = '';
            //$z = 0;

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
                    return $this->getOpMessage();
                    //return $this;
            }   
            
            //Serves for all databases - change if using autoincrement pks and 
            if($this->isIdEmpty()){//no value provided for id field 
                    $fieldList = $this->getPK().",".$fieldList;
                    $val = $this->constructPk();
                    $valueList = $val.",".$valueList;
                    $this->setId($val);
            }else{//application specifies a specific id (may modify to forward to update method)
                    $fieldList = $this->getPK().",".$fieldList;
                    $val = $this->prepareId($this->getId());
                    $valueList = $val.",".$valueList;
            }
            $sql = "INSERT INTO ".$this->getTableName()." (".$fieldList.") VALUES (".$valueList.");";
            return $sql;
        }
        
       
	/**
         * Updates an entity in the database based on the associated object.
         * Does not take into account fields that have null or empty values.
         * @return DbMapper 
         */
	public function update(){
            $sql = $this->generateUpdateSql();
            //echo $sql."<br/><br/>";
            if($this->dbQuery($sql)){
                $this->setOpStatus(true);
                $this->setOpMessage("The changes were successfully saved");
                return $this;
            }else{
                $this->setOpStatus(false);
                $this->setOpMessage("Error: Could not save your changes. Please try again or contact your administrator.");
                return $this;
            }
	}
        
        
        public function generateUpdateSql(){
           $fieldValuePair = '';
            $i = 0;
            foreach($this->fieldMapper as $propertyField => $dbFields){
                foreach(get_object_vars($this) as $prop => $val){
                  //if($val !== ''){
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
                return $this->getOpMessage();
                //return $this;
            } 
            $sql = "UPDATE ".$this->getTableName()." SET ". $fieldValuePair ." WHERE ".$this->getPK()." = ".$this->prepareId().";";
            return $sql;
        }
        
        /**
         * Method that updates entity in database and takes into account the fields that are empty.
         * This means that if a field is empty it assigns it updates its value to null in the database.
         * @return DbMapper 
         */
        public function updateIncludeEmptyFields(){
            
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
		
		$sql = "UPDATE ".$this->getTableName()." SET ". $fieldValuePair ." WHERE ".$this->getPK()." = ".$this->prepareId();
                //echo $sql;
                if($this->dbQuery($sql)){
                    $this->setOpStatus(true);
                    $this->setOpMessage("Your changes were successfully saved.");
                    return $this;
		}else{
                    $this->setOpStatus(false);
                    $this->setOpMessage("Error: Could not save your changes. Please try again or contact your administrator.");
                    return $this;
		}
	}
        
         public function generateUpdateWithEmptyFieldsSql(){
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
            return $sql;
        }
      
	/**
	* Method to save/update entity in the database.
	* Decides whether the object should be saved or updated (if/)whether or not id field has a value in the object)
	* This function is a convenience function.
        * When input parameter is true it creates update statement taking into account
        * fields that are empty and setting them to null in database.
        * @param boolean $includeEmpty
        * @return DbMapper
	*/
	public function pushObjectToDB($includeEmpty=false){
            if($this->isIdEmpty()){
                return $this->save();
            }elseif($includeEmpty == true){
                return $this->updateIncludeEmptyFields();
            }else{
                return $this->update();
            }
	}
	
        /**
         * More flexible function for creating arrays to be used with smarty {htmnl_options} to create listboxes.
         * Allows for the specification of the display field, and the order by field and the sorting order.
         * @param string $labelFieldName
         * @param string $orderByField
         * @param string $direction
         * @return array 
         */
	public function getDropDownArrayOrder($labelFieldName, $orderByField, $direction){
	    $resultArray = array();
            $resultArray[''] = '';
            $sql = " SELECT ".$this->getPk().", ".$labelFieldName." FROM ".$this->getTableName()." WHERE ";
            $sql .= $this->getSoftDeleteFieldName()." = TRUE order by ".$orderByField." ".$direction;
            //echo $sql;
            $result = $this->dbQuery($sql);
            while($res = $this->dbFetchArray($result)){
                $idx = $res[0];
                $resultArray[$idx] = $res[1];
            }
            return $resultArray;
        }
        
       
	/**
	* Method to retrieve one  or more entities by multiple criteria
	* Accepts two arrays: the class property names and values
	* hasSoftDeleteField if the entity carries a soft delete field value.
	* Returns an array of objects.
        * @param array $whereClauseProperties
        * @param array $whereClauseValues
        * @param boolean $hasSoftDeleteField
        * @param string $selectProperty
        * @param string $resultObjectClass
        * @return array
	*/
        public function getObjectsByMultipleCriteria(array $whereClauseProperties, array $whereClauseValues, $hasSoftDeleteField = true, $selectProperty = "id", $resultObjectClass="", $ascending=true, $orderBy = ""){
            $resultClass = ($resultObjectClass == "") ? $this->className : $resultObjectClass;
            $qryField = $this->getDbFieldFromPropertyName($selectProperty);
	    $objArr = array();
            $sql  = " SELECT ".$qryField[0]." FROM ".$this->getTableName()." WHERE ";
            if(count($whereClauseProperties) == count($whereClauseValues)){
                for($i = 0; $i < count($whereClauseProperties); $i++){
                    $sql .= ($i != 0) ? " AND " : "";
                    $dbDetails = $this->getDbFieldFromPropertyName($whereClauseProperties[$i]);
                    if($whereClauseValues[$i] === ''){
                        $sql .= $dbDetails[0] ." is null";
                    }else{
                        $sql .= $dbDetails[0] ." = ".$this->prepSqlValues($whereClauseValues[$i], $dbDetails[1]);
                    }
                }
                if($hasSoftDeleteField){
                    $sql .= " AND ".$this->getSoftDeleteFieldName()." = true";
                }
                /* An order by field has been provided*/
                if($orderBy != ""){
                    $direction = ($ascending) ? "ASC" : "DESC";
                    $dbField = $this->getDbFieldFromPropertyName($orderBy);
                    $sql .= " ORDER BY ".$dbField[0]." ".$direction;
                }
            }
            //echo $sql;
            $result = $this->dbQuery($sql);
            //echo $sql."<br/>rows: ".$this->dbNumRows($result)."<br/><br/>";
            if($this->dbNumRows($result) > 0){
                $i = 0;
                while($res = $this->dbFetchArray($result)){
                    $newInstance = new $resultClass();
                    $objArr[$i] = $newInstance->getEntityById($res[0]);
                    $i++;
                }
            }
            return $objArr;
	}
        /*
         * conditions : >, <, <>, >=, <= , =, is not, is, like, not like
         * whereClause = array(["classProperty" => "property", "propertyValue" => "value", "condition" => "=", "orProperty" => "otherClassProperty"])
         */
        public function retrieveObjectsByMultipleCriteria(array $whereClause, $hasSoftDeleteField = true, $ascending = true, $orderBy = "", $limit = 0, $selectProperty = "id", $resultObjectClass=""){
            $resultClass = ($resultObjectClass == "") ? $this->className : $resultObjectClass;
            $qryField = $this->getDbFieldFromPropertyName($selectProperty);
	    $objArr = array();
            $sql  = " SELECT ".$qryField[0]." FROM ".$this->getTableName()." WHERE ";
            $i = 0;
            foreach($whereClause as $clause){
                $sql .= ($i != 0) ? " AND " : "";
                $dbDetails = $this->getDbFieldFromPropertyName($clause["classProperty"]);
                $cond = (\array_key_exists('condition', $clause) && \trim($clause["condition"]) != "") ? \trim($clause["condition"]) : "=";
                if (\array_key_exists('orProperty', $clause)) {
                    if ($clause['orProperty'] != "") {
                        $orDbDetails = $this->getDbFieldFromPropertyName($clause["orProperty"]);
                        $sql .= (\trim(\strtoupper($clause["propertyValue"])) == 'NULL') ? " (".$dbDetails[0] ." ".$cond." NULL" : " (".$dbDetails[0] ." ".$cond." ".$this->prepSqlValues($clause["propertyValue"], $dbDetails[1]);
                        $sql .= " OR ". $orDbDetails[0] ." ".$cond." ".$this->prepSqlValues($clause["propertyValue"], $orDbDetails[1]).") ";
                    }
                } else {
                    $sql .= (\trim(\strtoupper($clause["propertyValue"])) == 'NULL') ?  $dbDetails[0] ." ".$cond." NULL" : $dbDetails[0] ." ".$cond." ".$this->prepSqlValues($clause["propertyValue"], $dbDetails[1]);
                }
                $i++;
            }
            if($hasSoftDeleteField){
                $sql .= " AND ".$this->getSoftDeleteFieldName()." = true";
            }
            
            /* An order by field has been provided*/
            if($orderBy != ""){
                $direction = ($ascending) ? "ASC" : "DESC";
                $dbField = $this->getDbFieldFromPropertyName($orderBy);
                $sql .= " ORDER BY ".$dbField[0]." ".$direction;
            }
            
            if($limit > 0){
                $sql .= " LIMIT ".$limit;
            }
            //echo $sql;
            $result = $this->dbQuery($sql);
            if($this->dbNumRows($result) > 0){
                    $i = 0;
                    while($res = $this->dbFetchArray($result)){
                        $newInstance = new $resultClass();
                        $objArr[$i] = $newInstance->getEntityById($res[0]);
                        $i++;
                    }
            }
            return $objArr;
	}
        
        public function retrieveDistinctObjectsByMultipleCriteria(array $whereClause, $hasSoftDeleteField = true, $selectProperty = "id", $resultObjectClass=""){
            $resultClass = ($resultObjectClass == "") ? $this->className : $resultObjectClass;
            $qryField = $this->getDbFieldFromPropertyName($selectProperty);
	    $objArr = array();
            $sql  = " SELECT distinct ".$qryField[0]." FROM ".$this->getTableName()." WHERE ";
            $i = 0;
            foreach($whereClause as $clause){
                $sql .= ($i != 0) ? " AND " : "";
                $dbDetails = $this->getDbFieldFromPropertyName($clause["classProperty"]);
                $cond = (\trim($clause["condition"]) != "") ? \trim($clause["condition"]) : "=";
                if (\array_key_exists('orProperty', $clause)) {
                    if (\trim($clause['orProperty']) != "") {
                        $orDbDetails = $this->getDbFieldFromPropertyName($clause["orProperty"]);
                        $sql .= " (".$dbDetails[0] ." ".$cond." ".$this->prepSqlValues($clause["propertyValue"], $dbDetails[1]);
                        $sql .= " OR ". $orDbDetails[0] ." ".$cond." ".$this->prepSqlValues($clause["propertyValue"], $orDbDetails[1]).") ";
                    }
                } else {
                    $sql .= $dbDetails[0] ." ".$cond." ".$this->prepSqlValues($clause["propertyValue"], $dbDetails[1]);
                }
                $i++;
            }
            if($hasSoftDeleteField){
                $sql .= " AND ".$this->getSoftDeleteFieldName()." = true";
            }
            //echo $sql;
            $result = $this->dbQuery($sql);
            if($this->dbNumRows($result) > 0){
                    $i = 0;
                    while($res = $this->dbFetchArray($result)){
                        $newInstance = new $resultClass();
                        $objArr[$i] = $newInstance->getEntityById($res[0]);
                        $i++;
                    }
            }
            return $objArr;
	}
        
        /**
         * Returns an array of elements (type: mixed) based on the criteria provided
         * @param array $whereClauseProperties
         * @param array $whereClauseValues
         * @param string $selectProperty
         * @param boolean $hasSoftDeleteField
         * @return array
         */
        public function getArrayByCriteria(array $whereClauseProperties, array $whereClauseValues, $selectProperty, $hasSoftDeleteField = true){
            $qryField = $this->getDbFieldFromPropertyName($selectProperty);
	    $objArr = array();
            $sql  = " SELECT ".$qryField[0]." FROM ".$this->getTableName()." WHERE ";
            if(count($whereClauseProperties) == count($whereClauseValues)){
                for($i = 0; $i < count($whereClauseProperties); $i++){
                    $sql .= ($i != 0) ? " AND " : "";
                        $dbDetails = $this->getDbFieldFromPropertyName($whereClauseProperties[$i]);
                        $sql .= $dbDetails[0] ." = ".$this->prepSqlValues($whereClauseValues[$i], $dbDetails[1]);
                }
                if($hasSoftDeleteField){
                    $sql .= " AND ".$this->getSoftDeleteFieldName()." = true";
                }
            }
            $result = $this->dbQuery($sql);
            if($this->dbNumRows($result) > 0){
                    $i = 0;
                    while($res = $this->dbFetchArray($result)){
                        $objArr[$i] = $res[0];
                        $i++;
                    }
            }
            return $objArr;
        }
        
        
        public function countByCriteria(array $whereClauseProperties, array $whereClauseValues, $hasSoftDeleteField = true){
            $sql  = " SELECT count(*) FROM ".$this->getTableName()." WHERE ";
            if(count($whereClauseProperties) == count($whereClauseValues)){
                for($i = 0; $i < count($whereClauseProperties); $i++){
                    $sql .= ($i != 0) ? " AND " : "";
                    $dbDetails = $this->getDbFieldFromPropertyName($whereClauseProperties[$i]);
                    if($whereClauseValues[$i] === ''){
                        $sql .= $dbDetails[0] ." is null";
                    }else{
                        $sql .= $dbDetails[0] ." = ".$this->prepSqlValues($whereClauseValues[$i], $dbDetails[1]);
                    }
                }
                if($hasSoftDeleteField){
                    $sql .= " AND ".$this->getSoftDeleteFieldName()." = true";
                }
            }
            $result = $this->dbFetchArray($this->dbQuery($sql));
            return $result[0];
        }
        
        /**
         * Return an array of entities ordered by specific property and in specific order
         * @param string $orderByProperty
         * @param string $ascending
         * @return array 
         */
        public function getAllOrderBy($orderByProperty, $ascending = true){
	    $resultArray = array();
            $orderByField = $this->getDbFieldFromPropertyName($orderByProperty);
            $direction = ($ascending) ? 'ASC' : 'DESC';
            $sql = " SELECT ".$this->getPk()." FROM ".$this->getTableName()." WHERE ";
            $sql .= $this->getSoftDeleteFieldName()." = TRUE order by ".$orderByField[0]." ".$direction;
            //echo $sql;
            $result = $this->dbQuery($sql);
            if($this->dbNumRows($result) > 0){
                $i = 0;
                while($res = $this->dbFetchArray($result)){
                    $newInst = new $this->className();
                    $resultArray[$i] = $newInst->getEntityById($res[0]);
                    $i++;
                }
            }
            return $resultArray;
        }
        
        /**
	* Method to return an array of objects based on an sql criteria
	* @param string $criteria
        * @param string $orderByField
        * @param boolean $sortAscending
        * @return array
	*/
        public function getObjectsBySqlCriteria($criteria,$orderByField,$sortAscending = true){
            $dir = ($sortAscending) ? 'ASC' : 'DESC';
            $objArr = array();
            $sql = " SELECT ".$this->getPk()." FROM ".$this->getTableName()." WHERE ".$criteria;
            $sql .= " AND ".$this->getSoftDeleteFieldName()." = true ORDER BY ".$orderByField." ".$dir;
            $result = $this->dbQuery($sql);
            if($this->dbNumRows($result) > 0){
                $i = 0;
                while($res = $this->dbFetchArray($result)){
                    $newInstance = new $this->className();
                    $objArr[$i] = $newInstance->getEntityById($res[0]);
                    $i++;
                }
            }
            return $objArr;
        }
	
        
        /**
         * To build sequences for insert statements
         * @return int 
         */
	public function buildSequence(){
            $upperLimit = 200000000;
            $lowerLimit = 1;
            $currentId = 0;
            $newId = 0;
                
            $sql = "SELECT lower_limit, upper_limit, current_value FROM ".$this->getSequenceTable()." WHERE ";
            $sql .= " table_name = '".$this->getTableName()."' AND sequence_flag = 'C'";
            $result = $this->dbQuery($sql);
            
           
            if($this->dbNumRows($result) == 0){// a new sequence entry into the db.
            
                //Construct new sequence pk
                $resultado = [];
                $maxPkSql = "SELECT split_part(sequence_id, '".\strtoupper($_SESSION['code'])."', 2) FROM ".$this->getSequenceTable().";";
                $RESULT = $this->dbQuery($maxPkSql);
                while($res = $this->dbFetchArray($RESULT)) {
                    if (\trim($res[0]) != '') {
                        \array_push($resultado, \intval($res[0]));
                    }
                }
                
                $newPKNum = \intval(max($resultado)) + 1;
                $newPk = \strtoupper($_SESSION['code']).$newPKNum;
                
                $currentId = $lowerLimit;
                $qryEntry = "INSERT INTO ".$this->getSequenceTable();
                $qryEntry .= " (sequence_id, table_name,lower_limit,upper_limit,current_value,sequence_flag)";
                $qryEntry .= "values('".$newPk."','".$this->getTableName()."',".$lowerLimit.",".$upperLimit.",".$currentId.",'C')";
                $this->dbQuery($qryEntry);
                $newId = $currentId;
                return $newId;
            }//End of new entry section.
            else{ //An entry already exists in the table
                    $res = $this->dbFetchArray($result);
                    $upperLimit = $res['upper_limit'];
                    $currentId = $res['current_value'];

                    if($currentId < $upperLimit){//There are still available ids in the current block.
                        $newId = $currentId + 1;
                        $qry = "UPDATE ".$this->getSequenceTable()." SET current_value = ".$newId." WHERE ";
                        $qry .= " table_name = '".$this->getTableName()."' AND sequence_flag = 'C'";
                        //echo $qry."<br/>";
                        if($this->dbQuery($qry)){
                            return $newId;
                        }else{
                            return false;
                        }
                    }
                    else{ //the current value is equal to the upper limit.
                            $qry = "UPDATE ".$this->getSequenceTable()." SET sequence_flag = 'F' WHERE ";
                            $qry .= " table_name = '".$this->getTableName()."' AND sequence_flag = 'C'";
                       if($this->dbQuery($qry)){
                            $sql = "SELECT max(upper_limit) FROM ".$this->getSequenceTable()." WHERE ";
                            $sql .= " table_name = '".$this->getTableName()."'";
                            $result = $this->dbQuery($sql);
                            $res = $this->dbFetchArray($result);
                            $lowerLimit = $res[0] + 1;
                            $currentId = $lowerLimit;
                            $newId = $currentId;
                            $upperLimit = $res[0] + 200000000;
                            
                            //Construct new sequence pk
                            $maxPkSql = "SELECT max(split_part(sequence_id, '".\strtoupper($_SESSION['code'])."', 2)::numeric) FROM edu_sequences;";
                            $maxPk = $this->dbFetchArray($this->dbQuery($maxPkSql));
                            $newPKNum = \intval($maxPk[0]) + 1;
                            $newPk = \strtoupper($_SESSION['code']).$newPKNum;
                            
                            $qryEntry = "INSERT INTO ".$this->getSequenceTable()." (sequence_id, table_name,";
                            $qryEntry .= "lower_limit,upper_limit,current_value,sequence_flag ";
                            $qryEntry .= " values('".$newPk."','".$this->getTableName()."',".$lowerLimit.",".$upperLimit.",".$currentId.",'C')";
                            return ($this->dbQuery($qryEntry)) ? $newId : false;
                        }
                    }
            }
	}
        
	
	/**
	* Method to ascertain whether or not a similar record is present or not in the db
	* Accepts three arrays: the field names, values and types
	* Along with the primary key value when the action is an update
        * D - date/timestamp, I - integer, T - text, B - Boolean, R - Real/double/numeric, BN - Nullable boolean
        * @param array $fieldNameArr
        * @param array $fieldValueArr
        * @param array $fieldTypeArr
        * @return boolean
	*/
	public function isRecordPresent($fieldNameArr,$fieldValueArr,$fieldTypeArr,$pkId){
                $statement = '';
		$comma = 'AND';
		
		$len = count($fieldTypeArr);
		for($i = 0; $i < $len; $i++){
			if($i == 0){$comma = '';}
			if($fieldTypeArr[$i] == 'T'){
				$statement .= " ".$comma." upper(".$fieldNameArr[$i].") = '".\strtoupper($fieldValueArr[$i])."'";
			}
                        elseif(($fieldTypeArr[$i] =='D' || $fieldTypeArr[$i] =='I' || $fieldTypeArr[$i] =='R') && ($fieldValueArr[$i] === "null" || $fieldValueArr[$i] === '')){
				$statement .= " ".$comma."  ".$fieldNameArr[$i]." is ".$fieldValueArr[$i];
			}
                        elseif($fieldTypeArr[$i] =='D'){
                            $statement .= " ".$comma." ".$fieldNameArr[$i]." = '".$fieldValueArr[$i]."'";
                        }
			else{
				$statement .= " ".$comma."  ".$fieldNameArr[$i]." = ".$fieldValueArr[$i];
			}
			$comma = 'AND';
		}
		if(empty($pkId)){
			$sql  = "SELECT count(*) as total FROM ".$this->getTableName()." WHERE ".$statement." and ";
			$sql .= $this->getSoftDeleteFieldName()." = true"; 
		}else{
			$sql = "SELECT count(*) as total FROM ".$this->getTableName()." WHERE ".$statement." and ";
			$sql .= $this->getSoftDeleteFieldName()." = true and ".$this->getPK()." <> ".$this->prepareId($pkId); 
		}
		//echo $sql."<br/>";
		$result = $this->dbQuery($sql);
		$res = $this->dbFetchArray($result);
		if($res['total'] > 0){
                    return (bool) true;
		}else{
                    return (bool) false;               
		}
	}

        /**
         * Converts object of class to a json array with its associated properties / fields
         * @return array
         */
        public function convertObjectToJsonArray(){
            $jsonArr = array();
            foreach($this->fieldMapper as $propertyField => $dbFields){
                foreach(get_object_vars($this) as $prop => $val){
                    if($propertyField == $prop){
                       $getter = 'get'.\ucwords($prop);
                       $jsonArr[$prop] = $this->$getter(); //$val; 
                    }
                }
            }
             return json_encode($jsonArr);
        }
        
        /**
         * Converts an array of objects to a json array with json objects
         * @param array $objArr
         * @return array
         */
        public function convertObjectArrToJsonArray(array $objArr){
            $resultArr = array();
            foreach($objArr as $obj){
               $jsonArr = array();
                foreach($obj->fieldMapper as $propertyField => $dbFields){
                    foreach(get_object_vars($obj) as $prop => $val){
                        if($propertyField == $prop){
                           $jsonArr[$prop] = $val; 
                        }
                    }
                }
                array_push($resultArr, $jsonArr);
            }
            return json_encode($resultArr);
        }
        
        public function hasName(){
            /*$hasName = false;
            foreach(get_object_vars($this)  as $prop => $val){
                if(\strtoupper($prop) == \strtoupper("name")){
                    $hasName = true;
                    break;
                }
            } 
            return $hasName;*/
            $instance = new $this->className();
            return \method_exists($instance, 'getName');
        }
        
        public function hasLabel(){
            $instance = new $this->className();
            return \method_exists($instance, 'getLabel');
        }
        
        /**
         * Returns an array of the values in the name field of the class if it exists.
         * @return array
         */
        public function getNames(){
            $nameArr = [];
            if($this->hasName()){
                $objs = (new $this->className())->getAllOrderBy("name");
                foreach($objs as $object){
                    array_push($nameArr, \ucfirst($object->getName()));
                }
            } 
            return $nameArr;
        }
         
        /**
         * Returns the corresponding object by the name field if it exists
         * @param type $name
         * @return mixed
         */
        public function getByName($name){
            return ($this->hasName()) ? $this->getEntityByCriteria("name", $name, TRUE) : new $this->className();
        }
        
	/**
	* Class destructor
	*/
	public function __destruct(){
	
	}
        
        /** Sequence table structure **/
        /*
         CREATE TABLE prefix_sequences(
          sequence_id character varying(80) NOT NULL,
          table_name character varying(60) NOT NULL,
          lower_limit integer NOT NULL,
          upper_limit integer NOT NULL,
          current_value integer NOT NULL,
          sequence_flag character(1) NOT NULL,
          CONSTRAINT pk_sequence_id PRIMARY KEY (sequence_id )
        );
        ALTER TABLE edu_sequences OWNER TO postgres;
        GRANT ALL ON TABLE edu_sequences TO postgres;
        GRANT SELECT, UPDATE, INSERT ON TABLE edu_sequences TO public;
       */

        /*
         __countMax 
  
         */
}

