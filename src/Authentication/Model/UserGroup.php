<?php


namespace Authentication\Model;

use Neptune\Logger;
use Neptune\DbMapperUtility;
/**
 * UserGroup
 * @package hiags
 * @author Randal Neptune
 */
class UserGroup extends Logger {
   protected $_tableName = "user_groups";
   protected $primaryKeyField = "user_group_id";
   
   protected $uniqueCombo = array(array("userId","groupId"));
   protected $uniqueComboErrorMsg;
     
   protected $fieldMapper = array(
   	"id" => array("user_group_id","T"),
	"userId" => array("user_id","T"),
        "groupId" => array("group_id","T")
   );
   
   protected $userId;
   protected $groupId;
   
   protected $user;
   protected $group;
   
   public function __construct() {
       parent::__construct();
       $this->user = new User();
       $this->group = new Group();
   }
   
   public function getUserId() {
       return $this->userId;
   }

   public function getGroupId() {
       return $this->groupId;
   }

   public function getUser() {
       return $this->user->getEntityById($this->getUserId());
   }

   public function getGroup() {
       return $this->group->getEntityById($this->getGroupId());
   }
   
   public function setUserId($userId) {
       $this->userId = $userId;
   }

   public function setGroupId($groupId) {
       $this->groupId = $groupId;
   }

   public function setUser($user) {
       $this->user = $user;
   }

   public function setGroup($group) {
       $this->group = $group;
   }

   /**
    * Return all the user entities that belong to a group
    * @param integer $groupId
    * @return array
    */
   public function getUsersByGroupId($groupId){
       return $this->getObjectsByMultipleCriteria(["groupId"], ["$groupId"], TRUE, "userId", $this->getUser()->getClassName());
   }
   
    public function getUsersByGroupByFacility ($groupId, $facilityId, $includeSystemUsers) {
        $usrs = [];
        $groupUsers = $this->getUsersByGroupId($groupId);
        $facilityUsers = (new EduUser())->getAllFacilityUsers($facilityId, $includeSystemUsers);
        foreach ($facilityUsers as $facUsr) {
            if (DbMapperUtility::isObjectInArray($facUsr, $groupUsers)) {
                if (!DbMapperUtility::isObjectInArray($facUsr, $usrs)) {
                    \array_push($usrs, $facUsr);
                }
            }
        }
        return $usrs;
    }
   
   /**
    * Return all the group entities that a user object is associated to.
    * @param string $userId
    * @return array 
    */
   public function getGroupsByUserId($userId){
       return $this->getObjectsByMultipleCriteria(["userId"], ["$userId"], TRUE, "groupId", $this->getGroup()->getClassName());
   }
   
   /**
    * To get an array of all group ids that the user pertains to.
    * @param string $userId
    * @return array
    */
   public function getGroupIdsByUserId($userId){
       $objArr = array();
       $grps = $this->getGroupsByUserId($userId);
       foreach($grps as $grp){
           array_push($objArr, $grp->getId());
       }
       return $objArr;
  }
  
  
  /**
   * To assign and update groups assigned to the user.
   * @param string $userId
   * @param array $groupArr
   * @return boolean
   */
    public function assignGroups($userId, array $groupArr){
        $usrGrps = $this->getObjectsByMultipleCriteria(["userId"], ["$userId"], TRUE);
        $sql = "";
        
        if(\count($groupArr) > 0){
            $propertyArr = ["userId","groupId"];
            
            foreach($usrGrps as $usrGrp){
                $sql .= $usrGrp->generateDeleteSql();
            }
            for($i = 0; $i < count($groupArr); $i++){
               $newInstance =  (new $this->className())->getEntityByMultipleCriteria($propertyArr, ["$userId","$groupArr[$i]"], false);
               if($newInstance->getId() != ''){//already exists in table
                   $sql .= $newInstance->generateReactivateSql();
               }else{// insert a new record
                   $newInstance->setUserId($userId);
                   $newInstance->setGroupId($groupArr[$i]);
                   $newInstance->setId('');
                   $sql .= $newInstance->generateSaveSql();
               }
             }
             $dbTransaction = "BEGIN TRANSACTION; ". $sql ." COMMIT;";
             $result = $this->dbQuery($dbTransaction);
             return ($result != false);
        }else{
            if(\count($usrGrps) > 0){
                //they were previous groups assigned all were deselected
                //so delete them all.
                foreach($usrGrps as $usrGrp){
                    $sql .= $usrGrp->generateDeleteSql();
                }
                $dbTransaction = "BEGIN TRANSACTION; ". $sql ." COMMIT;";
                $result = $this->dbQuery($dbTransaction);
                return ($result != false);
            }else{
                return true;
            }
        }
    }
}
