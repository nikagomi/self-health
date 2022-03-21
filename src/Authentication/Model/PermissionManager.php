<?php

namespace Authentication\Model;
use Neptune\DbMapperUtility;
/**
 * Static method class.
 * PermissionManager static class - callable from anywhere
 * @package hiags
 * @author Randal Neptune
 */
class PermissionManager {
    protected $softDeleteFieldName = "alive";
    
    private function __construct(){
    
    }
    
    private function getSoftDeleteFieldName(){
        return $this->softDeleteFieldName;
    }
    
     /**
     * Returns array of user Ids that have the permission directly associated (not through a group) 
     * @param integer $permissionId
     * @return array
     */
    public static function getUsersByPermissionIdArray($permissionId){
        $objArr = array();
        $users = (new \Authentication\Model\UserPermission())->getObjectsByMultipleCriteria(["permissionId"], ["$permissionId"], TRUE, "userId", "\Authentication\Model\User");
        foreach($users as $usr){
            array_push($objArr, $usr->getId());
        }
        return array_unique($objArr);
    }
    
     /**
     * A function to get all the groups that have this permission associated to it.
     * Returns an array of the group ids
     * @param integer $permissionId
     * @return array 
     */    
    public static function getGroupListByPermissionIdArray($permissionId){
        $groupIdArr = array();
        $grps = (new \Authentication\Model\GroupPermission())->getObjectsByMultipleCriteria(["permissionId"], ["$permissionId"], TRUE, "groupId", "\Authentication\Model\Group");
        foreach($grps as $grp){
            array_push($groupIdArr, $grp->getId());
        }        
        return array_unique($groupIdArr);
    }
    
    /**
     * Returns an array of user Ids that are members of the group
     * @param array $groupIdArr
     * @return array 
     */
    public static function getUsersInGroupArray(array $groupIdArr){
        $userGroup = new \Authentication\Model\UserGroup();
        $sql = "SELECT user_id FROM ".$userGroup->getTableName()." WHERE group_id IN (".implode(",",$groupIdArr).")";
        $sql .= " AND ".$this->getSoftDeleteFieldName()." = true";
        //echo $sql;
        $userArr = array();
        $result = DbMapperUtility::dbQuery($sql);
        while($res = DbMapperUtility::dbFetchArray($result)){
            array_push($userArr,$res[0]);
        }
        return array_unique($userArr);
    }
    
     /**
     * Takes a permission constant and returns an array of user ids that have it;
     * whether directly associated or through their associated groups
     * @param string $constant
     * @return array 
     */
    public static function getUsersWithPermissionConstantArray($constant){
        $combo =  [];
        //$objArr = array();
        $permissionId  = (new \Authentication\Model\Permission())->getPermissionIdByConstant(trim(strtoupper($constant)));
        //Users with permission by direct association
        $combo = array_merge($combo, self::getUsersByPermissionIdArray($permissionId));
        //User with permission by group association
        $combo = array_merge($combo, self::getUsersInGroupArray(self::getGroupListByPermissionIdArray($permissionId)));
        return array_unique($combo);
    }
    
    /**
    * Takes a comma separated list of permission constants and returns all user ids that contain 
    * any one of the permissions either directly or via an associated group
    * @param string $constantList
    * @return array 
    */
    public static function getUsersWithPermissionConstantList($constantList){
        $combo = array();
        if(!empty($constantList)){
            $actArr = explode(",",$constantList);
            for($i = 0; $i < count($actArr); $i++){
                $combo = array_merge($combo,self::getUsersWithPermissionConstantArray($actArr[$i]));
            }
        }
        return array_unique($combo);
    }
    
    /**
     * Returns an array of all the permission ids that correspond to a user
     * @param string $userId
     * @return array 
     */
    
    public static function getUserPermissionIdList($userId){
        //get all user groups
        $userGroups = (new \Authentication\Model\UserGroup())->getGroupsByUserId($userId);
        //Directly associated user permissions
        $userPerms = (new \Authentication\Model\UserPermission())->getPermissionsIdsByUserId($userId);
        $userPermsAll = [];
        foreach($userGroups as $grp){
            $userPermsAll = array_merge($userPermsAll,(new \Authentication\Model\GroupPermission())->getPermissionsIdsByGroupId($grp->getId()));
        }
        //Now merge group associated perms with direct associated perms
        $userPermsAll = array_merge($userPermsAll,$userPerms);
        return array_unique($userPermsAll);
    }
    
    
     /**
     * Returns an array of all the activity constants corresponding to the array of permission ids passed as the argument.
     * @param array $permissionIds
     * @return array
     */
    public static function getPermissionConstArrayFromPermissionIds(array $permissionIds){
      
        $constArr = array();
        if (\count($permissionIds) > 0) {
            $sql = " SELECT upper(constant) FROM ".(new \Authentication\Model\Permission())->getTableName()." WHERE permission_id IN (".@implode(",",$permissionIds).")";
            $sql .= " AND ". (new \Authentication\Model\Permission())->getSoftDeleteFieldName()." = true";
            $result = DbMapperUtility::dbQuery($sql);
            if(DbMapperUtility::dbNumRows($result) > 0){
                while($res = DbMapperUtility::dbFetchArray($result)){
                    array_push($constArr,$res[0]);
                }
            }
        }
        return array_unique($constArr);
    }
    
    /**
     * Returns an array of all permission constants of the user. 
     * @param string $userId
     * @return array 
     */
    public static function getUserPermissionConstants($userId){
        return self::getPermissionConstArrayFromPermissionIds(self::getUserPermissionIdList($userId));
    }
    
    /**
     * Returns true or false depending on whether or not the user has the passed constant as a permission.
     * @param string $constant 
     * @param string $userId
     * @return boolean
     */
    public static function userHasPermission($constant,$userId){
        $usr = (new \Authentication\Model\User())->getEntityById($userId);
        if($usr->isSystem()){
            return (bool) true;
        }else{
            $constArr = self::getUserPermissionConstants($userId);
            return in_array(\strtoupper($constant),$constArr);
        }
    }
  
    
    /**
    * Returns true or false depending on whether or not the user has
    * any one of the constants passed in argument. The string must be a comma separated list.
    * @param string $constantList
    * @param string $userId 
    * @return boolean
    */
    public static function userHasPermissionInList($constantList,$userId){
        $containsPerm = false;
        $usr = (new \Authentication\Model\User())->getEntityById($userId);
        if($usr->isSystem()){
            $containsPerm = true;
        }else{
            $constArr = self::getUserPermissionConstants($userId);
            $chkListArr = explode(",",$constantList);
            
            if(\count($chkListArr) > 0 and \count($constArr) > 0){
                for($i = 0; $i < \count($chkListArr);$i++){
                    if(\in_array(strtoupper($chkListArr[$i]),$constArr)){
                        $containsPerm = true;
                        break;
                    }
                }
            }
        }
        return (bool) $containsPerm;
    }
    
   
}
