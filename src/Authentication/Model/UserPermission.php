<?php

namespace Authentication\Model;

use Neptune\Logger;
/**
 *UserPermission
 * @package hiags
 * @author Randal Neptune
 */
class UserPermission extends Logger{
   protected $_tableName = "user_permissions";
   protected $primaryKeyField = "user_permission_id";
   
   protected $uniqueCombo = array(array("userId","permissionId"));
   protected $uniqueComboErrorMsg = "The user already has assigned some of the chosen permissions.";
     
   protected $fieldMapper = array(
   	"id" => array("user_permission_id","T"),
	"userId" => array("user_id","T"),
        "permissionId" => array("permission_id","I")
   );
   
   protected $userId;
   protected $permissionId;
   
   protected $user;
   protected $permission;
   
   public function __construct() {
       parent::__construct();
       $this->user = new User();
       $this->permission = new Permission();
   }
   
   public function getUserId() {
       return $this->userId;
   }

   public function getPermissionId() {
       return $this->permissionId;
   }

   public function getUser() {
       return $this->user->getEntityById($this->getUserId());
   }
   
   public function getPermission() {
       return $this->permission->getEntityById($this->getPermissionId());
   }

   public function setPermission($permission) {
       $this->permission = $permission;
   }

   public function setUserId($userId) {
       $this->userId = $userId;
   }

   public function setPermissionId($permissionId) {
       $this->permissionId = $permissionId;
   }

   public function setUser($user) {
       $this->user = $user;
   }
   
   /**
    * Function to assign and de-assign permissions to user. 
    * @param string $userId
    * @param array $permissionArr
    * @return boolean
    */
    public function assignPermissions($userId, $permissionArr){
        $sql = "";
        $userPerms = $this->getObjectsByMultipleCriteria(["userId"], ["$userId"], TRUE);
        if(\count($permissionArr) > 0){     
            
            $propertyArr = ["userId", "permissionId"];
            foreach($userPerms as $usrPrm){
                $sql .= $usrPrm->generateDeleteSql();
            }
            for($i = 0; $i < count($permissionArr); $i++){
                $newInstance =  (new $this->className())->getEntityByMultipleCriteria($propertyArr, [$userId, $permissionArr[$i]], false);
                if(!$newInstance->isIdEmpty()){//already exists in table
                    $sql .= $newInstance->generateReactivateSql();
                }else{// insert a new record
                    $newInstance->setUserId($userId);
                    $newInstance->setPermissionId($permissionArr[$i]);
                    $newInstance->setId('');
                    $sql .= $newInstance->generateSaveSql();
                }
            }
            $dbTransaction = "BEGIN TRANSACTION; ". $sql ." COMMIT;";
            $result = $this->dbQuery($dbTransaction);;
            return ($result != false);
        }else{
            if(\count($userPerms) > 0){
                //previous permissions but they were deselected
                //delete them then.
                foreach($userPerms as $usrPrm){
                    $sql .= $usrPrm->generateDeleteSql();
                }
                $dbTransaction = "BEGIN TRANSACTION; ". $sql ." COMMIT;";
                $result = $this->dbQuery($dbTransaction);
                return ($result != false);
            }else{
                return true;
            }
        }
    }
  
    public function getPermissionsByUserId($userId){
        return $this->getObjectsByMultipleCriteria(["userId"], ["$userId"], TRUE, "permissionId", "\Authentication\Model\Permission");
    }
  
    /**
     * Retrieve all the permissions based on the the user id supplied.
     * @param string $userId
     * @return array
     */
    public function getPermissionsIdsByUserId($userId){
          $perms = $this->getPermissionsByUserId($userId);
          $objArr = array();
          foreach($perms as $prm){
              array_push($objArr, $prm->getId());
          }
          return $objArr;
    }
    
    /**
     * Get all the users that have the identified permission.
     * @param string $permissionId
     * @return array
     */
    public function getUsersByPermission ($permissionId) {
        return $this->getObjectsByMultipleCriteria(["permissionId"], [$permissionId], true, "userId", "\Authentication\Model\User");
    }

}
