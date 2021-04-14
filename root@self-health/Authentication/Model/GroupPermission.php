<?php

namespace Authentication\Model;

use Neptune\Logger;
/**
 * GroupPermission: Associate permissions to user groups
 * @package hiags
 * @author Randal Neptune
 */
class GroupPermission extends Logger{
   protected $_tableName = "group_permissions";
   protected $primaryKeyField = "group_permission_id";
   
   protected $uniqueCombo = array(array("groupId","permissionId"));
   protected $uniqueComboErrorMsg = "The group already has assigned some of the chosen permissions.";
     
   protected $fieldMapper = array(
   	"id" => array("group_permission_id","T"),
	"groupId" => array("group_id","T"),
        "permissionId" => array("permission_id","I")
   );
   
   protected $groupId;
   protected $permissionId;
   
   protected $group;
   protected $permission;
   
   public function __construct() {
       parent::__construct();
       $this->group = new Group();
       $this->permission = new Permission();
   }
   
   public function getGroupId() {
       return $this->groupId;
   }

   public function getPermissionId() {
       return $this->permissionId;
   }

   public function getGroup() {
       return $this->group->getEntityById($this->getGroupId());
   }

   public function getPermission() {
       return $this->permission->getEntityById($this->getPermissionId());
   }

   public function setPermission($permission) {
       $this->permission = $permission;
   }

   public function setGroupId($groupId) {
       $this->groupId = $groupId;
   }

   public function setPermissionId($permissionId) {
       $this->permissionId = $permissionId;
   }

   public function setGroup($group) {
       $this->group = $group;
   }
   
   /**
    * To save and update group permissions
    * @param integer $groupId
    * @param array $permissionArr
    * @return boolean
    */
    public function assignPermissions($groupId, $permissionArr){
        $sql = "";
        $grpPerms = $this->getObjectsByMultipleCriteria(["groupId"], ["$groupId"], TRUE);
        if(\count($permissionArr) > 0){
            
            $propertyArr = ["groupId", "permissionId"];
            foreach($grpPerms as $grpPrm){
                $sql .= $grpPrm->generateDeleteSql();
            }

            for($i = 0; $i < \count($permissionArr); $i++){
                $newInstance =  (new $this->className())->getEntityByMultipleCriteria($propertyArr, ["$groupId", "$permissionArr[$i]"], false);
                if($newInstance->getId() != ''){//already exists in table
                    $sql .= $newInstance->generateReactivateSql();
                }else{// insert a new record
                    $newInstance->setGroupId($groupId);
                    $newInstance->setPermissionId($permissionArr[$i]);
                    $newInstance->setId('');
                    $sql .= $newInstance->generateSaveSql();
                }
            }
            $dbTransaction = "BEGIN TRANSACTION; ". $sql ." COMMIT;";
            return $this->dbQuery($dbTransaction);
        }else{
            if(\count($grpPerms) > 0){
                //permissions previously assigned to group have all been deselected
                //delete them all
                foreach($grpPerms as $grpPrm){
                    $sql .= $grpPrm->generateDeleteSql();
                }
                $dbTransaction = "BEGIN TRANSACTION; ". $sql ." COMMIT;";
                return $this->dbQuery($dbTransaction);
            }else{
                return true;
            }
        }
    }

    /**
     * Retrieve all the permissions based on the the group id supplied.
     * @param integer $groupId
     * @return array
     */
    public function getPermissionsIdsByGroupId($groupId){
        $objArr = array();
        $perms = $this->getObjectsByMultipleCriteria(["groupId"], ["$groupId"], TRUE, "permissionId", "\Authentication\Model\Permission");
        foreach($perms as $perm){
            array_push($objArr, $perm->getId());
        }
        return $objArr;
    }
    
    /**
     * Get the groups that contain the identified permission
     * @param string $permissionId
     * @return array
     */
    public function getGroupsByPermission ($permissionId) {
        return $this->getObjectsByMultipleCriteria(["permissionId"], [$permissionId], true, "groupId", "\Authentication\Model\UserGroup");
    }
}
