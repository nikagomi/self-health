<?php
require_once __DIR__.'/../vendor/autoload.php';


$timezone = \Neptune\PropertyService::getProperty("default.time.zone", "America/St_Lucia");
date_default_timezone_set($timezone);

/**
 * Returns the html code for the user menu based on the associated permissions.
 * @param resource $conn
 * @param EduUser $usrObj
 * @return string 
 */
function createMenu($conn,$usrObj){ 
    global $place;
    $url = $place;

    $menu .= '<nav id="menu-wrap">';
    $menu .= '<ul id="menu"><li><a class="menu-image show-for-medium-up" href="/user/home"><img style="padding-top:-6px;" src="/images/home_icon.png" height="10px"/></a></li>'; 
    $tpermList = array();

    if(!$usrObj->isSystem()){
       $usrPermList = array_unique(getMenuPermList($conn,$usrObj->getId()));
    }
     
    //Determine the facility permissions here
    $code = \Neptune\EduPropertyService::getProperty("facility.code");
    $facility = (new \Admin\Model\EduFacility())->getByFacilityCode($code);
    $facilityId = $facility->getId();
    if($facilityId == ''){
        
    }else{
        if($usrObj->isSystem() ){//&& $facility->getFacilityType()->getConstant() == 'ADMIN'
            $tpermList = getAllMenuPerms($conn);
        }else{
            $perm = new \Authentication\Model\EduPermission();
            $facPerms = (new \Authentication\Model\EduFacilityTypePermission())->getPermissionsIdsByFacilityTypeId($facility->getFacilityTypeId());
            foreach ($usrPermList as $usrPermId){
                if(in_array($usrPermId, $facPerms)){
                    array_push($tpermList,$usrPermId);
                    $containerId = $perm->getContainerId($usrPermId);
                    if(!empty($containerId)){
                        array_push($tpermList,$containerId);
                    }
                }
            }
        }
        //Now clean up duplicates in perm list
        $permList = array_unique($tpermList);
        /************************************************/
        $sql = "SELECT DISTINCT a.category_id, a.name, a.order, a.message_resource FROM edu_menu_categories a, edu_permissions b WHERE a.category_id = b.category_id";
        $sql .= " AND b.level = 1 AND a.alive = TRUE AND b.alive = TRUE AND b.permission_id IN (".implode(',', $permList).")";
        $sql .= " order by a.order asc";

        //echo $sql;
        $result = \Neptune\DbMapperUtility::dbQuery($sql);
        while($item = \Neptune\DbMapperUtility::dbFetchArray($result)){
           $menu .= "<li>";
           $menu .= '<a href="" onclick="return false;">'.ucwords(strtolower(\Neptune\MessageResources::i18n($item['message_resource'])))."</a>";
           //$menu .= "<div class='mobnav-subarrow'></div>";
           $menu .= "<ul>";

           foreach($permList as $key => $val){

               $query = "SELECT permission_id,submenu_name, submenu_name_key,url,is_container FROM edu_permissions WHERE permission_id = ".$val;
               $query .= " AND level = 1 AND category_id = ".$item[0]." AND alive = TRUE AND level1_id IS NULL";
               $res = \Neptune\DbMapperUtility::dbFetchArray(\Neptune\DbMapperUtility::dbQuery($query)); 
               if($res[0] != ''){
                   $addr = ($res['is_container'] == 'f') ? $url.$res['url'] : '';
                   $menu .= "<li>";
                   $menu .= ($res['is_container'] == 'f') ? '<a href="'.$addr.'">'.ucwords(strtolower(\Neptune\MessageResources::i18n($res['submenu_name_key']))).'</a>' : '<a href="" onclick="return false;">'.ucwords(strtolower(Neptune\MessageResources::i18n($res['submenu_name_key']))).'</a>'  ;
                   //$menu .= "<div class='mobnav-subarrow-sub'></div>";

                   $query2 = "SELECT submenu_name, submenu_name_key, url FROM edu_permissions WHERE level1_id = ".$res['permission_id'];
                   $query2 .= " AND permission_id IN (".implode(',', $permList).") AND alive = true ORDER BY submenu_name ASC";

                   $res = \Neptune\DbMapperUtility::dbQuery($query2);
                   if (\Neptune\DbMapperUtility::dbNumRows($res)> 0) {
                       $menu .= "<ul>";
                       while($resli = \Neptune\DbMapperUtility::dbFetchArray($res)){
                           $ur = $url.$resli['url'];
                           $menu .= '<li><a href="'.$ur.'">'.ucwords(strtolower(\Neptune\MessageResources::i18n($resli['submenu_name_key'])))."</a></li>";  

                       }
                       $menu .= "</ul>";
                   }
                   $menu .= "</li>";
              }
           }
           $menu .= "</ul>";
           $menu .= "</li>";
       }
    }
    $menu .= '<li><a href="/security/user/preferences">'.ucwords(\Neptune\MessageResources::i18n("menu.category.preference")).'</a></li>';
    $menu .= ' <li><a href="/logOut">'.ucwords(\Neptune\MessageResources::i18n("menu.category.log.out")).'</a></li>';
    $menu .= "</ul>";
    $menu .= "</nav>";
     
    /************************************************/
    return $menu;
 }
 
 /**
  * Returns array of all permissions that are associated to user via group or individual permission
  * @param resource $conn
  * @param string $usr_id
  * @return array 
  */
 function getMenuPermList($conn,$usr_id){  
    $groups = array();
    $perms = array();
    $sql = "SELECT group_id FROM edu_user_groups where user_id = '".$usr_id ."' AND alive = true";
    $result = pg_query($conn,$sql);
   
    while($res = pg_fetch_array($result)){
        \array_push($groups, $res['group_id']);
    }
    for($i = 0; $i < \count($groups); $i++){
        $SQL = "SELECT a.is_menu, a.permission_id FROM edu_permissions a, edu_group_permissions b";
        $SQL .= " WHERE b.group_id='".$groups[$i]."' AND a.permission_id = b.permission_id AND b.alive = true";
        $SQL .= " AND a.alive = true AND a.is_menu = true ORDER BY a.submenu_name ASC";
        $RESULT = pg_query($conn,$SQL);
        while($RES = pg_fetch_array($RESULT)){
            \array_push($perms, $RES['permission_id']);
        }
    }
    
    $query = "SELECT a.is_menu, a.permission_id FROM edu_permissions a, edu_user_permissions b ";
    $query .= " WHERE b.user_id = '".$usr_id."' AND a.permission_id = b.permission_id AND a.alive=true";
    $query .= " AND b.alive = true AND a.is_menu = true ORDER BY a.submenu_name ASC";
    $qryResult = pg_query($conn,$query);
    while($qryRes = pg_fetch_array($qryResult)){
        \array_push($perms, $qryRes['permission_id']);
    }

    //Now you have a big list of the permissions without containers.
    $sequel = "SELECT level1_id FROM edu_permissions WHERE permission_id IN (".\implode(",",$perms).") ORDER BY level1_id ASC";
    $sequelRes = pg_query($conn,$sequel);
    while($sqlRes = pg_fetch_array($sequelRes)){
       if($sqlRes[0] != ''){
            \array_push($perms, $sqlRes[0]);
        }
    }
    return \array_unique($perms);
}

/**
 * Returns array of all permissions.
 * @param resource $conn
 * @return array 
 */
function getAllMenuPerms($conn){  
    $perms = array();
    $query = "SELECT permission_id FROM edu_permissions WHERE alive = true AND is_menu = true ORDER BY submenu_name ASC"; //was permission_id
    $qryResult = pg_query($conn,$query);
    while($qryRes = pg_fetch_array($qryResult)){
        \array_push($perms, $qryRes[0]);
    }
    return $perms;
}
