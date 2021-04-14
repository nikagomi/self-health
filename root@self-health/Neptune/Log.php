<?php

/**
 * Maps to log table in the database
 * @package edur
 * @author Randal Neptune
 */

namespace Neptune;


class Log extends DbMapper{
   protected $_tableName = "logs";
   protected $primaryKeyField = "log_id";
   
   protected $uniqueCombo ;
   protected $uniqueComboErrorMsg;
     
   protected $fieldMapper = array(
   	"id" => array("log_id","T"),
        "userId" => array("user_id","T"),
	"table" => array("table_name","T"),
        "recordId" => array("record_id","T"),
        "previousValues" => array("prev_value","T"),
        "newValues" => array("new_value","T"),
        "action" => array("action","T"),
        "logDate" => array("log_date","D"),
        "logTime" => array("log_time","D"),
        "statement" => array("sql_statement","T"),
        "noReplicate" => array("no_replicate","I")
   );
   
   protected $userId;
   protected $table;
   protected $recordId;
   protected $previousValues;
   protected $newValues;
   protected $action;
   protected $logDate;
   protected $logTime;
   protected $statement;
   protected $noReplicate;
   
   protected $user;
   
      
   public function __construct() {
       parent::__construct();
       $this->user = new \Authentication\Model\User();
   }
   
   
   public function getUserId() {
       return $this->userId;
   }

   public function getTable() {
       return $this->table;
   }

   public function getRecordId() {
       return $this->recordId;
   }

   public function getPreviousValues() {
       return $this->previousValues;
   }

   public function getNewValues() {
       return $this->newValues;
   }

   public function getAction() {
       return $this->action;
   }

   public function getLogDate() {
       return $this->logDate;
   }

   public function getLogTime() {
       return $this->logTime;
   }

   public function getStatement() {
       return $this->statement;
   }

   public function getUser() {
       return $this->user->getEntityById($this->getUserId());
   }
   
   public function isReplicated() {
       return ($this->noReplicate != 't' && $this->noReplicate != 1) ? true : false;
   }

   public function setNoReplicate($noReplicate) {
       $this->noReplicate = $noReplicate;
   }

   
   public function setUserId($userId) {
       $this->userId = $userId;
   }

   public function setTable($table) {
       $this->table = $table;
   }

   public function setRecordId($recordId) {
       $this->recordId = $recordId;
   }

   public function setPreviousValues($previousValues) {
       $this->previousValues = $previousValues;
   }

   public function setNewValues($newValues) {
       $this->newValues = $newValues;
   }

   public function setAction($action) {
       $this->action = $action;
   }

   public function setLogDate($logDate) {
       $this->logDate = $logDate;
   }

   public function setLogTime($logTime) {
       $this->logTime = $logTime;
   }

   public function setStatement($statement) {
       $this->statement = $statement;
   }

   public function setUser($user) {
       $this->user = $user;
   }

   /**
    * Table structure for log table
    *  CREATE TABLE prefix_logs(
          log_id integer NOT NULL,
          user_id character varying(200) NOT NULL,
          table_name character varying(60) NOT NULL,
          record_id character varying(200) NOT NULL,
          prev_value text,
          new_value text,
          action character varying(20) NOT NULL,
          sql_statement text NOT NULL,
          log_date timestamp without time zone NOT NULL,
          log_time time without time zone NOT NULL,
          alive boolean NOT NULL DEFAULT true,
          CONSTRAINT pk_log_id PRIMARY KEY (log_id ),
          CONSTRAINT fk_user_id FOREIGN KEY (user_id)
              REFERENCES edu_users (user_id) MATCH SIMPLE
              ON UPDATE NO ACTION ON DELETE NO ACTION
        );
        ALTER TABLE edu_logs OWNER TO postgres;
        GRANT ALL ON TABLE edu_logs TO postgres;
        GRANT SELECT, INSERT ON TABLE edu_logs TO public;
    */
}

?>
