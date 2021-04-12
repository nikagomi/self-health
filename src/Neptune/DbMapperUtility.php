<?php

namespace Neptune;
/**
 * @author Randal Neptune
 * Contact: randalneptune@gmail.com  (758) 719-1623 / (246) 835-1295
 * @copyright This notice MUST stay intact for legal use
 * DbMapperUtility class - OOP PHP implementation
 * @see DbMapper
 * @version 3.0 
 * @since 18th September, 2011
 */

class DbMapperUtility{
        private static $instance = NULL;
	private $opStatus;
	private $opMessage;
        private $rowsAffected;
        
        private function __construct(){
            
        }
        
        /**
         * This function returns a connection to the database.
         * @return resource
         */
        public static function dBInstance(){
            if(!self::$instance){
                $conn_str = "host=localhost port=5432 dbname=health user=postgres password=postgres";
                self::$instance = pg_connect($conn_str);
                if (!self::$instance) {
                    $e = new \Error("The database link resource is null or invalid. Please review.", 2200);
                    \Error\Model\ExceptionHandler::logException($e);
                }
            }
            return self::$instance;
        }
	
	public function getOpStatus(){
            if($this->opStatus){
                return (bool) true;
            }else{
                return (bool) false;
            }
	}
	
	public function setOpStatus($opStatus){
            $this->opStatus = $opStatus;
	}
	
	public function getOpMessage(){
            return $this->opMessage;
	}
	
	public function setOpMessage($opMessage){
            $this->opMessage = $opMessage;
	}
        
        public function getRowsAffected() {
            return $this->rowsAffected;
        }

        public function setRowsAffected($rowsAffected) {
            $this->rowsAffected = $rowsAffected;
        }

        	
        private function __clone(){
            
        }
        
        /**
         * Convenience method when executing sql statements outside of an instance of DbMapper.
         * @see DbMapper
         * @param string $sql
         * @return resource 
         */
        public static function dbQuery($sql){
            $result = pg_query(self::dBInstance(),$sql);
            return (!$result) ? false : $result;
        }
	
        /**
         * Convenience method when executing sql statements outside of an instance of DbMapper.
         * @see DbMapper
         * @param resource $result
         * @return array 
         */
	public static function dbFetchArray($result){
            return pg_fetch_array($result);
	}
        
         /**
         * Returns the result rows of a database query but with field names as
         * the associative array index
         * @param resource $result
         * @return array 
         */
        public static function dbFetchArrayAssociative($result){
            return pg_fetch_array($result,null,PGSQL_ASSOC);
	}
	
        /**
         * Convenience method when executing sql statements outside of an instance of DbMapper.
         * @see DbMapper
         * @param resource $result
         * @return integer 
         */
	public static function dbNumRows($result){
            return pg_num_rows($result);
	}
	
        /**
         * @see DbMapper
         * @param resource $result
         * @return integer
         */
        public static function dbRowsAffected($result){
            return pg_affected_rows($result);
        }
	
	/**
	 * Method to save an array of objects to the database
	 * Accepts an array of objects (all must be inherited from DbMapper)
	 * Operation status and status message are returned as part of an object
	 * Duplicate checking is not done here (the save is a transactional: all or nothing)
         * @param array $objArray
         * @return DbMapperUtility
	*/
	public static function saveObjects(array $objArray){
            $resultObj = new self();
            if(count($objArray) > 0){
		$transaction = "BEGIN TRANSACTION;";
		
		if(is_array($objArray)){
			foreach($objArray as $obj){
                            if($obj instanceof DbMapper){
                                $fieldList = '';
                                $valueList = '';
                                $i = 0;
                                foreach($obj->getFieldMapper() as $propertyField => $dbFields){
                                   foreach($obj->getObjectVars() as $prop => $val){
                                        if($propertyField == $prop && $propertyField != 'id'){
                                            if($i > 0){
                                                $fieldList .= ",";
                                                $valueList .= ",";
                                            }
                                            $fieldList .= $dbFields[0];
                                            $valueList .= $obj->prepSqlValues($val,$dbFields[1]);
                                            $i++;
                                            break;	
                                        }
                                    }
                                }
                                if($obj->isIdEmpty()){//no value provided for id field 
                                        // uncomment following for non-autoincrement pk field ids
                                        $fieldList = $obj->getPK().",".$fieldList;
                                        $val = $obj->constructPk();
                                        $valueList = $val.",".$valueList;
                                }else{//object specifies a specific id
                                        $fieldList = $obj->getPK().",".$fieldList;
                                        $val = $obj->prepareId($obj->getId());
                                        $valueList = $val.",".$valueList;
                                }
                                $sql = "INSERT INTO ".$obj->getTableName()." (".$fieldList.") VALUES (".$valueList.");";
                                $transaction .= $sql;
                        }else{
                          throw new \Exception("Operation aborted. One of the array elements is not an object of DbMapper.",3301);
                        }
                    }
		}else{
                    throw new \Exception("Operation aborted. The argument passed to the function is not an array.",3302);
		}
		//Done cycling through the array. Now to save to the database;
		$transaction .= "COMMIT;";
                //echo $transaction."<br/>";
                if($obj->dbQuery($transaction)){
                    	$resultObj->setOpStatus(true);
			$resultObj->setOpMessage("Your changes were successfully saved");
			return $resultObj;
		}else{
			$resultObj->setOpStatus(false);
                        $resultObj->setOpMessage("Error: Could not save your changes. Please try again or contact your administrator.");
			return $resultObj;
		}
            }else{
                $resultObj->setOpStatus(true);
                $resultObj->setOpMessage("Nothing to update");
                return $resultObj;
            }
	}
	
	/**
	 * Method to update an array of objects in the database
	 * Accepts an array of objects (must be inherited from DbMapper)
	 * Operation status and status message are return as part of an object
	 * Duplicate checking is not done here (the save is a transaction: all or nothing)
         * @param array $objArray
         * @return DbMapperUtility
	*/
	public static function updateObjects(array $objArray){
            $resultObj = new self();
            if(count($objArray) > 0){
		$transaction = "BEGIN TRANSACTION;";
		if(is_array($objArray)){
                    foreach($objArray as $obj){
                        if($obj instanceof DbMapper){
                                $fieldValuePair = '';
                                $i = 0;
                                foreach($obj->getFieldMapper() as $propertyField => $dbFields){
                                   foreach($obj->getObjectVars() as $prop => $val){
                                       if($prop == $propertyField){
                                            if($i > 0){
                                                $fieldValuePair .= ", ";
                                            }

                                            /** Constructing the sql statement **/
                                            $fieldValuePair .= $dbFields[0]." = ".$obj->prepSqlValues($val,$dbFields[1]);
                                            $i++;
                                            break;	
                                        }
                                   }
                                }

                                $sql = "UPDATE ".$obj->getTableName()." SET ". $fieldValuePair ." WHERE ";
                                $sql .= $obj->getPK()." = ".$obj->prepareId($obj->getId()).";";
                                $transaction .= $sql;
                        }else{
                          throw new \Exception("Operation aborted. One of the array elements is not an object of DbMapper.",3301);
                        }
                    }
		}else{
			throw new \Exception("Operation aborted. The argument passed to the function is not an array.",3302);
		}
		//Done cycling through the array. Now to save to the database;
		$transaction .= "COMMIT;";
		//echo $transaction."<br/><br/>";	
                if($obj->dbQuery($transaction)){
			$resultObj->setOpStatus(true);
			$resultObj->setOpMessage("Your changes were successfully saved");
			return $resultObj;
		}else{
			$resultObj->setOpStatus(false);
                        $resultObj->setOpMessage("Error: Could not save your changes. Please try again or contact your administrator.");
			return $resultObj;
		}
            }else{
                $resultObj->setOpStatus(true);
                $resultObj->setOpMessage("Nothing to update");
                return $resultObj;
            }
	}
	
	
		
	/**
	 * Method to save an entity to the database.
	 * Checks to make sure unique value combinations are not duplicated in db
         * @param DbMapper $obj
         * @return DbMapper
	 */
	public static function saveObject(DbMapper $obj){
		$resultObj = new self();
	 	if($obj instanceof DbMapper){
			$fieldList = '';
			$valueList = '';
			$uniqueComboValues = array();
			$uniqueComboTypes = array();
			$uniqueComboFields = array();
			
			$i = 0;
			
			foreach($obj->getFieldMapper() as $propertyField => $dbFields){
			   foreach($obj->getObjectVars() as $prop => $val){
			     if($propertyField == $prop && $propertyField != 'id'){
                                    if($i > 0){
                                        $fieldList .= ",";
                                        $valueList .= ",";
                                    }
                                    $fieldList .= $dbFields[0];
                                    $valueList .= $obj->prepSqlValues($val,$dbFields[1]);

                                    $i++;
                                    break;	
                                }
                            }
			}
			/** Check to see if will duplicate what's in db **/
			if($obj->checkUniqueFields()){
                                $obj->setOpStatus(false);
                                $obj->setUniqueComboErrorMsg();
                                $obj->setOpMessage($this->getUniqueComboErrorMsg());
                                return $obj;
                        }  
                        /* Populate the primary key value */
                        $fieldList = $obj->getPK().",".$fieldList;
                        $val = $obj->constructPk();
                        $valueList = $val.",".$valueList;
                        
			$sql = "INSERT INTO ".$obj->getTableName()." (".$fieldList.") VALUES (".$valueList.")";
                        $sql .= " RETURNING ".$obj->getPK();
                        
                        $val = $obj->dbFetchArray($obj->dbQuery($sql));
                        if($val[0] != false){
                            $obj->setOpStatus(true);
                            $obj->setOpMessage("Your changes were successfully saved.d");
                            $obj->setId($val[0]);
                            $resultObj->setOpStatus(true);
                            $resultObj->setOpMessage("Your changes were successfully saved.");
                            return $resultObj;
                        }else{
                            $obj->setId("");
                            $obj->setOpStatus(false);
                            $obj->setOpMessage("Error: Could not save your changes. Please try again or contact your administrator.");
                            $resultObj->setOpStatus(false);
                            $resultObj->setOpMessage("Error: Could not save your changes. Please try again or contact your administrator.");
                            return $resultObj;
                        }
                }else{
			throw new Exception("Operation aborted. The argument passed does not inherit from DbMapper class.",3303);
		}
		
	}
	
	
	
	/**
	 * Method to update an entity to the database
	 * Checks to make sure unique value combinations are not duplicated in db
         * @param DbMapper $obj
         * @return DbMapper
	 */
	public static function updateObject(DbMapper $obj){
		$resultObj = new self();
		if($obj instanceof DbMapper){
			$fieldValuePair = '';
			$uniqueComboValues = array();
			$uniqueComboTypes = array();
					
			$i = 0;
			
			foreach($obj->getFieldMapper() as $propertyField => $dbFields){
                            foreach($obj->getObjectVars() as $prop => $val){
                               if($prop == $propertyField){
                                    if($i > 0){
                                        $fieldValuePair .= ", ";
                                    }
                                    
                                    /** Constructing the sql statement **/
                                    $fieldValuePair .= $dbFields[0]." = ".$obj->prepSqlValues($val,$dbFields[1]);
                                    $i++;
                                    break;	
                                }
                            }
			}
			/** Check to see if will duplicate what's in db **/
			if($obj->checkUniqueFields()){
                                $obj->setOpStatus(false);
                                $obj->setUniqueComboErrorMsg();
                                $obj->setOpMessage($this->getUniqueComboErrorMsg());
                                return $obj;
                        }  
			
                        $sql = "UPDATE ".$obj->getTableName()." SET ". $fieldValuePair ." WHERE ".$obj->getPK()." = ".$obj->getId();
			//echo $sql;
			if($obj->dbQuery($sql)){
                            $obj->setOpStatus(true);
                            $obj->setOpMessage("Your changes were successfully saved.");
                            $resultObj->setOpStatus(true);
                            $resultObj->setOpMessage("Your changes were successfully saved.");
                            return $resultObj;
			}else{
                            $obj->setOpStatus(false);
                            $obj->setOpMessage("Error: Could not save your changes. Please try again or contact your administrator.");
                            $resultObj->setOpStatus(false);
                            $resultObj->setOpMessage("Error: Could not save your changes. Please try again or contact your administrator.");
                            return $resultObj;
			}
		}else{
			throw new Exception("Operation aborted. The argument passed does not inherit from DbMapper class.",3303);
		}
	}


	
	
	/**
	 * Used to access other methods of the utility class.
	 * Accepts function name to be called along with an array of parameters.
	 * Returns an object of this class with error status and message.
         * Compatible with PHP versions 5.3+
         * @param string $funcName
         * @param array $param
	 */
	public static function handler($funcName,array $param){
	    try{
               $resultObj = call_user_func_array('self::'.$funcName,$param);//self::
            }catch(Exception $e){
                $resultObj = new self();
                $resultObj->setOpStatus(false);
                $resultObj->setOpMessage($e->getMessage());
            }
            return $resultObj;
	}

        /**
         * Method to covert a 24HR time to its 12HR representation
         * @param string $time
         * @return string
         */
        public static function twelveHrAmPm($time){
            if(!@empty($time)){
               $hr = @explode(":",$time);
               $longTime = @strtotime($time);
               return @date("g:i A",$longTime);
             }else{
                 return '';
             }
        }
        
        /**
         * Method to convert an sql date: yyyy-mm-dd to a more reader friendly version: Apr 16, 2012
         * @param string $date
         * @return string 
         */
        public static function formatSqlDate($date){
            if(@empty($date)){
                $dateFinal = '';
            }
            else{
                $dateArr = @explode("-",$date);
                $dateNumeric = @mktime(12,0,0,$dateArr[1],$dateArr[2],$dateArr[0]);
                $dateFinal = @date("M j, Y",$dateNumeric);
            }
            return $dateFinal;
        }
        
        /**
         * Method to convert an sql date: yyyy-mm-dd to a more reader friendly version: Apr 16, 2012
         * with day added
         * @param string $date
         * @return string 
         */
        public static function formatSqlDateWithDay($date){
            if(@empty($date)){
                $dateFinal = '';
            }
            else{
                $dateArr = @explode("-",$date);
                $dateNumeric = @mktime(12,0,0,$dateArr[1],$dateArr[2],$dateArr[0]);
                $dateFinal = @date("l, M j, Y",$dateNumeric);
            }
            return $dateFinal;
        }
        
        /**
         * COnverts from a display date format dd/mm/yyyy to sql date format yyyy-mm-dd
         * @param string $displayDate
         */
        public static function displayToSqlDate($displayDate){
            if(empty($displayDate)){
                $dateFinal = '';
            }else{
                $dateArr = @explode("/",$displayDate);
                $dateFinal = $dateArr[2]."-".$dateArr[1]."-".$dateArr[0];
            }
            return $dateFinal;
        }
        
        /**
        * Converts an sql datetime string to a user friendly version.
        * @param string $dateTime
        * @return string 
        */
       public static function formatSqlDateTime($dateTime){
          if(@empty($dateTime)){
                $dateTimeFinal = '';
            }
            else{
               $dateTimeArr = @explode(" ",$dateTime); 
               $time = $dateTimeArr[1];
               $date = $dateTimeArr[0];
               $dateTimeFinal = self::formatSqlDate($date)." ".self::twelveHrAmPm($time);
            }
            return $dateTimeFinal;
       }
        
               
        /**
         * Accepts a boolean value and returns yes or no if true or false respectively
         * @param boolean $val
         * @return string
         */
        public static function booleanYesNo($val){
            if($val){
                return 'Yes';
            }else{  
                return 'No';
            }
        }
        
        /**
         * Accepts a numeric value and 0 if it is empty or the value if not
         * @param string $val
         * @return string
         */
        public static function returnNumericValue($val){
            if(empty($val)){
                return 0;
            }else{  
                return $val;
            }
        }
        
        
        /**
         * Function to format money or other value type up to two decimal places.
         * @param double $number
         * @param integer $dplaces
         * @param string $moneyDecimal
         * @return double 
         */
        public static function formatDecimalPlaces($number, $dplaces = 1, $moneyDecimal = 'N') { // decimal places (dplaces): 0=never, 1=if needed, 2=always
          if (is_numeric($number)){ 
            if (!$number){
              $value = ($dplaces == 2 ? '0.00' : '0'); 
            }else{
               if(\strtoupper($moneyDecimal) == 'M'){ //this is for money
                  if (floor($number) == $number){
                    $value = number_format($number, ($dplaces == 2 ? 2 : 0),'.',''); 
                  } else { //cents
                    $value = number_format(round($number, 2), ($dplaces == 0 ? 0 : 2),'.',''); 
                  }
               }else{//for any other type of value
                  if (floor($number) == $number){ 
                    $value = number_format($number,($dplaces == 2 ? 2 : 0));
                  }else{ 
                    $value= number_format(round($number, 2), ($dplaces == 0 ? 0 : 2)); 
                  }  
               }
            } 
            return $value;
          } 
       } 
       
       /**
        * To get a list of all the applications table names.
        * @return array 
        */
       public static function getApplicationTableNames($prefix = ''){
           $objArr = array();
           $pf = (\trim($prefix) != '') ? " AND relname LIKE '".\trim($prefix)."%' " : "";
           $sql = "select relname from pg_stat_user_tables WHERE schemaname = 'public'" .$pf;
           $sql .= " AND relname <> 'edu_sequences' ORDER BY relname ASC";
           $result =  self::dbQuery($sql);
           $objArr[''] = '';
           while($res = self::dbFetchArray($result)){
               $name = str_replace(" ", "_", $res[0]);
               $objArr[$name] = $name;
           }
           return $objArr;
       }
       
        /**
         * Accepts an sql date and formats it to display date format dd/mm/yyyy
         * @param string $date
         * @return date
         */
        public static function sqlToDisplayDateFormat($date){
            if(!@empty($date)){
                $dateArray = @explode("-",$date);
                return @date('j/m/Y',mktime(0,0,0,intval((string)$dateArray[1]),intval((string)$dateArray[2]),intval((string)$dateArray[0])));
            }else{
                return '';
            }
        }
   
        /**
         * Takes an array of objects and converts into a structure for a drop down array (smarty primarily)
         * @param array $objArr
         * @param string $selectHint
         * @return array
         */
        public static function convertObjectArrayToDropDown(array $objArr, $selectHint=""){
	    $resultArray = array();
            $resultArray[''] = ($selectHint == "" ) ? \Neptune\MessageResources::i18n("hint.dropDown.please.select") : $selectHint;
            foreach($objArr as $obj){
                $idx = $obj->getId();
                $resultArray[$idx] = $obj->getLabel();
            }
            return $resultArray;
        }
        
         /**
         * Takes an array of objects and converts into an array of they identifiers (ids)
         * @param array $objArr
         * @return array
         */
        public static function convertObjectArrayToIdArray(array $objArr){
	    $resultArray = [];
            foreach($objArr as $obj){
                \array_push($resultArray, $obj->getId());
            }
            return $resultArray;
        }
        
        /**
         * Takes an array of objects and converts into a structire for a chckecbox array (smarty primarily)
         * @param array $objArr
         * @return array
         */
        public static function convertObectArrayToCheckBoxArray(array $objArr){
            $resultArray = array();
            $sortedObjs = self::sortObjectArray($objArr);
            foreach($sortedObjs as $obj){
                $idx = $obj->getId();
                $resultArray[$idx] = $obj->getLabel();
            }
            return $resultArray;
        }
        
        /**
         * Returns the current timestamp value in sql format (yyyy-mm-dd hh:ii:ss)
         * @return string
         */
        public static function now(){
            return date("Y-m-d HH:ii:ss");
        }
        
        /**
         * Returns current date in sql format (yyyy-mm-dd)
         * @return string
         */
        public static function currentDate(){
            return date("Y-m-d");
        }
        
        /**
         * Returns sorted array in ascending order by returned value of getLabel() method
         * @param array $objArr
         * @return array
         */
        public static function sortObjectArray(array $objArr){
            try{
                uasort($objArr, function($a, $b){
                   return strcasecmp($a->getLabel(), $b->getLabel());
                });
            }catch(\Exception $ex){
                //Nothing to do here. Most likely class doesn't have getLabel method and sort fails.
                //Just return original array.
            }
           return $objArr;
        }
        
        /**
        * Returns an array of hyperlinks that correspond to each object in the array supplied
        * @param string $url
        * @return array
        */
       public static function generateObjectArrayLinks($objArr, $url){
           $linkArr = array();
           if(\count($objArr) > 0){
               foreach($objArr as $arr){
                   $hrefClass = (\trim($url) == '') ? " class='objLinks' href='#' onclick='return false;'" : "href='".$url."/".$arr->getId()."'";
                   //$href = "href='#' onclick='return false;'";
                   $link = "<a id='".$arr->getId()."' ".$hrefClass.">".$arr->getLabel()."</a>";
                   array_push($linkArr, $link);
               }
           }
            return $linkArr;
       }
       
       public static function convertObjectToDropDown(\Neptune\DbMapper $obj){
            $resultArray = array();
            $resultArray[''] = '';
            $resultArray[$obj->getId()] = $obj->getLabel();
            return $resultArray;
       }
       
       /**
         * Converts an array of objects to a json array with jason objects
         * @param array $objArr
         * @return array
         */
        public static function convertObjectArrToJsonArray(array $objArr){
            $resultArr = array();
            foreach($objArr as $obj){
               $jsonArr = array();
                foreach($obj->getFieldMapper() as $propertyField => $dbFields){
                    foreach($obj->getObjectVars() as $prop => $val){
                        if($propertyField == $prop){
                           $jsonArr[$prop] = $val; 
                        }
                    }
                    if ($obj->hasLabel()) {
                        $jsonArr['label'] = $obj->getLabel();
                    }
                }
                array_push($resultArr, $jsonArr);
            }
            return json_encode($resultArr);
        }
        
        /**
         * Returns the ordinal suffix of the number supplied
         * @param float $num
         * @return string
         */
        public static function applyOrdinalSuffix($num){
            $newNum = $num % 100; // protect against large numbers
            if($newNum < 11 || $newNum > 13){
                 switch($newNum % 10){
                    case 1: return 'st';
                    case 2: return 'nd';
                    case 3: return 'rd';
                }
            }
            return 'th';
        }
        
        public static function addOrdinalSuffix($num){
            $suffix = self::applyOrdinalSuffix($num);
            return (\trim($num) != "" && \floatval($num) > 0) ? $num."<sup>".$suffix."</sup>" : "<sup>&nbsp;</sup>";
        }
        
        /**
         * Returns the time elapsed in minutes between two times (dates or timestamps)
         * @param string $referenceTime String representation of a timestamp
         * @param string $endTime String representation of a timestamp
         * @return int
         */
        public static function minutesElapsed($referenceTime, $endTime){
            $minutesElapsed = 0;
            $refTime = new \DateTime($referenceTime);
            $elapsed = $refTime->diff(new \DateTime($endTime));
            $minutesElapsed += ($elapsed->days * 24 * 60);
            $minutesElapsed += ($elapsed->h * 60);
            $minutesElapsed += ($elapsed->i);
            return $minutesElapsed;
        }
        
        /**
         * Returns the time elapsed  between two times (dates or timestamps)
         * @param string $referenceTime String representation of a timestamp
         * @param string $endTime String representation of a timestamp
         * @return string
         */
        public static function timeElapsed($referenceTime, $endTime){
            $timeElapsed = "0 mins";
            $refTime = new \DateTime($referenceTime);
            $elapsed = $refTime->diff(new \DateTime($endTime));
            if($elapsed->days == 0 && $elapsed->h == 0){
                $timeElapsed = $elapsed->i." mins";
            }else if($elapsed->days == 0){
                $timeElapsed = $elapsed->h." hours";
            }else{
                $timeElapsed = $elapsed->days." days";
            }
            return $timeElapsed;
        }
        
        public static function timeElapsedExpanded($referenceTime, $endTime){
            $refTime = new \DateTime($referenceTime);
            $elapsed = $refTime->diff(new \DateTime($endTime));
            $timeElapsed = $elapsed->days. " days " . $elapsed->h . " hours " .$elapsed->i ." mins";
            return $timeElapsed;
        }
        
        /**
         * Reconstructs the passed uri to remove ids and other variables to get the base url.
         * @param string $uri
         * @return string
         */
        public static function reconstructUri($uri){
            $uriArr = explode("/",$uri);
            $reconstructionArray = array();
            $i = 0;
           
            foreach($uriArr as $uriPart){
                $x = $i - 1;
                if(preg_match("/^[a-zA-Z]+$/", $uriPart)){
                    if($i <=1 or preg_match("/^[a-zA-Z]+$/",$uriArr[$x])){
                        array_push($reconstructionArray, $uriPart);
                    }
                }
                $i = $i+1;
            }
            return "/".implode("/",$reconstructionArray);
        }
        
        /**
         * Generates a random password
         * @return string
         */
        public static function generateRandomPassword(){
            $str = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890@!#$";
            $cad = "";
            for($i=0; $i<12; $i++) {
                $cad .= substr($str,rand(0,62),1);
            } 
            return $cad;
        }
        
        /**
         * Generates a random password
         * @return string
         */
        public static function generate2FABackupCode(){
            $str = "ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890@!#$";
            $cad = "";
            for($i=0; $i < 8; $i++) {
                $cad .= substr($str,rand(0,36),1);
            } 
            return $cad;
        }
        
        public static function getClosestMatch($needle, array $stringArray){
            $closest = "";
            $shortest = 9999;
            if(\count($stringArray) > 0 && \trim($needle) != ""){
                foreach($stringArray as $str){
                    $lev = \levenshtein(\strtolower(\trim($needle)), \strtolower(\trim($str)));
                    if ($lev == 0) {
                        // closest word is this one (exact match)
                        $closest = $str;
                        $shortest = 0;
                        // break out of the loop; we've found an exact match
                        break;
                    }
                    if ($lev <= $shortest || $shortest < 0) {
                        // set the closest match, and shortest distance
                        $closest  = $str;
                        $shortest = $lev;
                    }
                }
            }else{
                $closest = $needle;
            }
            return $closest;
        }
        
        public static function inverseDateTimeCompare (array $objArr) {
            \usort($objArr, ["\Neptune\DbMapperUtility","dateTimeCompareInverse"]);
            return $objArr;
        }
        
        public static function inverseLabelCompare (array $objArr) {
            \usort($objArr, ["\Neptune\DbMapperUtility","labelCompareInverse"]);
            return $objArr;
        }
        
        public static function ascDateTimeCompare (array $objArr) {
            \usort($objArr, ["\Neptune\DbMapperUtility","dateTimeCompare"]);
            return $objArr;
        }
        
        public static function ascLabelCompare (array $objArr) {
            \usort($objArr, ["\Neptune\DbMapperUtility","labelCompare"]);
            return $objArr;
        }
        
        public static function dateTimeCompare($a, $b) {
            $getters = [];
            $aVal = $a;
            $bVal = $b;
            if (\is_array($a->getDateTimeSortProperty())) {
                $getters = $a->getDateTimeSortProperty();
                for ($i = 0; $i < \count($getters); $i++) {
                    $getter = "get".\ucwords($getters[$i]);
                    $aVal = $aVal->$getter();
                    $bVal = $bVal->$getter();
                }
            } else {
                $getter = "get".\ucwords($a->getDateTimeSortProperty());
                $aVal = $aVal->$getter();
                $bVal = $bVal->$getter();
            }
            
            return strnatcasecmp(\strtotime($aVal), \strtotime($bVal));
        }
        
        public static function dateTimeCompareInverse($a, $b) {
            $getters = [];
            $aVal = $a;
            $bVal = $b;
            if (\is_array($a->getDateTimeSortProperty())) {
                $getters = $a->getDateTimeSortProperty();
                for ($i = 0; $i < \count($getters); $i++) {
                    $getter = "get".\ucwords($getters[$i]);
                    $aVal = $aVal->$getter();
                    $bVal = $bVal->$getter();
                }
            } else {
                $getter = "get".\ucwords($a->getDateTimeSortProperty());
                $aVal = $aVal->$getter();
                $bVal = $bVal->$getter();
            }
            return -1 * strnatcasecmp(\strtotime($aVal), \strtotime($bVal));
        }
        
        public static function labelCompare($a, $b) {
            $getters = [];
            $aVal = $a;
            $bVal = $b;
            if (\is_array($a->getLabelSortProperty())) {
                $getters = $a->getLabelSortProperty();
                for ($i = 0; $i < \count($getters); $i++) {
                    $getter = "get".\ucwords($getters[$i]);
                    $aVal = $aVal->$getter();
                    $bVal = $bVal->$getter();
                }
            } else {
                $getter = "get".\ucwords($a->getLabelSortProperty());
                $aVal = $aVal->$getter();
                $bVal = $bVal->$getter();
            }
            //$getter = "get".\ucwords($a->getLabelSortProperty());
            return strnatcasecmp($aVal, $bVal);
        }
        
        public static function labelCompareInverse($a, $b) {
            $getters = [];
            $aVal = $a;
            $bVal = $b;
            if (\is_array($a->getLabelSortProperty())) {
                $getters = $a->getLabelSortProperty();
                for ($i = 0; $i < \count($getters); $i++) {
                    $getter = "get".\ucwords($getters[$i]);
                    $aVal = $aVal->$getter();
                    $bVal = $bVal->$getter();
                }
            } else {
                $getter = "get".\ucwords($a->getLabelSortProperty());
                $aVal = $aVal->$getter();
                $bVal = $bVal->$getter();
            }
            //$getter = "get".\ucwords($a->getLabelSortProperty());
            return -1 * strnatcasecmp($aVal, $bVal);
        }
        
        
        public static function isObjectInArray($needle, array $haystack) {
            $inArray = false;
            if (\count($haystack) > 0) {
                foreach($haystack as $obj) {
                   if ($needle->getClassName() == $obj->getClassName() && $needle->getId() == $obj->getId()) {
                        $inArray = true;
                        break;
                    }
                }
            }
            return $inArray;
        }
        
        public static function removeObjectFromArray (array $objArr, $obj) {
            foreach($objArr as $key=> $val) {
                if ($obj->getId() == $val->getId()) {
                    unset($objArr[$key]);
                    break;
                }
            }
            return $objArr;
        }
        
        public static function objectArrayToNameList (array $objArr) {
            $nameList = "";
            if (\count($objArr) > 0) {
                $nameListArr = [];
                foreach ($objArr as $obj) {
                    \array_push($nameListArr, $obj->getLabel());
                }
                $nameList = \join(", ", \array_unique($nameListArr));
            }
            return $nameList;
        }
        
        public static function objectArrayToIdArray (array $objArr) {
            $idArr = [];
            $i = 0;
            if (\count($objArr) > 0) {
                foreach ($objArr as $obj) {
                    $idArr[$i] = $obj->getId();
                    $i++;
                }
            }
            return $idArr;
        }
        
        public static function objectArrayToIdArrayCustom (array $objArr, $idField) {
            $idArr = [];
            $getter = \ucwords($idField);
            $i = 0;
            if (\count($objArr) > 0) {
                foreach ($objArr as $obj) {
                    $idArr[$i] = $obj->$getter();
                    $i++;
                }
            }
            return $idArr;
        }
        
        
        
        public static function constructKeyedToSortArray (array $arrayTokey, array $keys) {
            $resultArr = [];
            foreach($arrayTokey as $obj) {
                foreach ($keys as $key ) {
                    $getter = "get".\ucwords($key);
                    $resultArr[$obj->getId()][$key] = $obj->$getter();
                }
                $resultArr[$obj->getId()]['id'] = $obj->getId();
            }
            return $resultArr;
        }
        
        /**
         * Callable function to sort an array on multiple keys.
         * @param array $keys contains the properties to sort by and the order of sorting
         * @return int
         */
        public static function complexSort($keys){
            return function($a, $b) use ($keys) {
		foreach ($keys as $k => $sortOrder){
                    if (\trim($sortOrder) == '' || \trim(\strtoupper($sortOrder)) == 'ASC') {
                        return strnatcasecmp($a[$k], $b[$k]);
                    } elseif (\trim(\strtoupper($sortOrder)) == 'DESC') {
                        return -1 * strcasecmp($a[$k], $b[$k]);
                    } else {
                        return strnatcasecmp($a[$k], $b[$k]);
                    }
                }
            };
        }
        
        /**
         * Converts a string to an associative array.
         * String must be in the form of an associative array elements.
         * E.g. 'elem' => 'value', 'elem2' =>'value', etc.
         * @param string $str
         * @return array
         */
        public static function convertStringToAssociativeArray ($str) {
            //$str = "'status' => '-1','level1' => '1', 'level2' => '1', 'level9' => '1', 'level10' => '1', 'start' => '2013-12-13', 'stop' => '2013-12-13'";
            $resultArr = [];
            $mstr = explode(",",$str);
            
            foreach($mstr as $nstr) {
                $narr = explode("=>",$nstr);
                $narr[0] = str_replace("\x98","",\trim($narr[0]));
                $ytr[1] = \trim($narr[1]);
                $resultArr[$narr[0]] = $ytr[1];
            }
            return $resultArr;
        }
        
        public static function isAssociativeArray (array $arr) {
            if (array() === $arr || \count($arr) == 0) return false;
            return array_keys($arr) !== range(0, count($arr) - 1);
        }
        
       
        
        /**
        * linear regression function
        * @param $x array x-coords
        * @param $y array y-coords
        * @returns array() m=>slope, b=>intercept
        */
        public static function linearRegression($x, $y) {

            // calculate number points
            $n = count($x);

            // ensure both arrays of points are the same size
            if ($n != count($y)) {
               trigger_error("linear_regression(): Number of elements in coordinate arrays do not match.", E_USER_ERROR);
            }

            // calculate sums
            $x_sum = array_sum($x);
            $y_sum = array_sum($y);

            $xx_sum = 0;
            $xy_sum = 0;

            for($i = 0; $i < $n; $i++) {

              $xy_sum+=($x[$i]*$y[$i]);
              $xx_sum+=($x[$i]*$x[$i]);

            }

            // calculate slope
            $m = (($n * $xy_sum) - ($x_sum * $y_sum)) / (($n * $xx_sum) - ($x_sum * $x_sum));

            // calculate intercept
            $b = ($y_sum - ($m * $x_sum)) / $n;

            // return result
            return array("slope"=>$m, "intercept"=>$b);

        }
        
        public static function endswith($string, $test) {
            $strlen = strlen($string);
            $testlen = strlen($test);
            if ($testlen > $strlen){
                return false;
            }
            return substr_compare($string, $test, $strlen - $testlen, $testlen) === 0;
        }
        
        public static function convertJSMatchRegex ($jsPattern) {
            //this is for use with specifically the mask plugin
            $patternArr = \str_split($jsPattern);
          
            $regexExp = '';
            for ($i = 0; $i < \count($patternArr); $i++) {
                if (\strtoupper($patternArr[$i]) == 'S') {
                    $regexExp .= '[A-Za-z]';
                } elseif ($patternArr[$i] == '0') {
                    
                    $regexExp .= '[0-9]';
                } else {
                    $regexExp .= $patternArr[$i];
                }
            }
            return '/^'.$regexExp.'$/';
        }
        
        public static function stripNoNeededHTML ($str, $withBrSeparator = false, $pattern = "/(<div>(.*?)<\/div>)/" , $chkTag = '<div>') {
            $matches = preg_split($pattern, $str, -1, PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE);
            $txt = [];
            $matchez = array_unique($matches);
            foreach ($matchez as $match) {
                if (\trim(\strip_tags($match)) != '' && \strpos($match, $chkTag) !== false) {
                    \array_push($txt, $match);
                }
            }
            return ($withBrSeparator) ? \join("<br>", $txt) : \join("", $txt) ;
        }
        
        public static function hex2rgb($hex, $return_array = false) {
            $rhex = str_replace("#", "", $hex);

            if(strlen($rhex) == 3) {
               $r = hexdec(substr($rhex,0,1).substr($rhex,0,1));
               $g = hexdec(substr($rhex,1,1).substr($rhex,1,1));
               $b = hexdec(substr($rhex,2,1).substr($rhex,2,1));
            } else {
               $r = hexdec(substr($rhex,0,2));
               $g = hexdec(substr($rhex,2,2));
               $b = hexdec(substr($rhex,4,2));
            }
            $rgb = array($r, $g, $b);
            //return ; // returns the rgb values separated by commas
            return ($return_array) ? $rgb : implode(",", $rgb); // returns an array with the rgb values
        }

        public static function generatePrecentageDropDown ($step = 5) {
            $end = 100;
           // $start = 0;
            $list = [];
            $list[''] = '';
            for ($i = $step; $i <= $end; $i+=$step) {
                $list[$i] = $i."%";
            }
            return $list;
        }
        
        public static function formatPhoneNumberInternational ($numStr) {
            $phoneUtil = \libphonenumber\PhoneNumberUtil::getInstance();
            try {
                $countryCode = PropertyService::getProperty("country.code", "lc");
                $phoneNumObj = $phoneUtil->parse($numStr, \strtoupper($countryCode));
                return $phoneUtil->format($phoneNumObj, \libphonenumber\PhoneNumberFormat::INTERNATIONAL);
                //return$phoneUtil->formatOutOfCountryCallingNumber($phoneNumObj, \strtoupper($countryCode));
            } catch (\libphonenumber\NumberParseException $e) {
                //var_dump($e);
                return $numStr;
            }
        }
        
        public static function formatPhoneNumberE164 ($numStr) {
            $phoneUtil = \libphonenumber\PhoneNumberUtil::getInstance();
            try {
                $countryCode = PropertyService::getProperty("country.code", "lc");
                $phoneNumObj = $phoneUtil->parse($numStr, \strtoupper($countryCode));
                return $phoneUtil->format($phoneNumObj, \libphonenumber\PhoneNumberFormat::E164);
                //return$phoneUtil->formatOutOfCountryCallingNumber($phoneNumObj, \strtoupper($countryCode));
            } catch (\libphonenumber\NumberParseException $e) {
                //var_dump($e);
                return $numStr;
            }
        }
        
        /**
         * Get the content of an external URL file
         * @param string $URL
         * @return string
         */
        public static function getURLContent($URL){
            $ch = curl_init($URL);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            //curl_setopt($ch, CURLOPT_URL, $URL);
            $data = curl_exec($ch);
            curl_close($ch);
            return $data;
        }
        
        /**
         * Count number of patients registered in the application
         * @return integer
         */
        public static function patientCount () {
            return \count((new \Patient\Model\Patient())->getAll(true));
        }
        
        public static function generateYearDropDown ($year) {
            $now = \date("Y");
           // $start = 0;
            $list = [];
            $list[''] = '';
            for ($i = $now; $i >= $year; $i--) {
                $list[$i] = $i;
            }
            return $list;
        }
}
