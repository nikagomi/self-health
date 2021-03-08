<?php

namespace Authentication\Controller;
use Neptune\BaseController;
use Neptune\MessageResources;
use Neptune\DbMapperUtility;

/**
 * PermissionController
 * @package sarms
 * @author Randal Neptune
 */
class PermissionController extends BaseController{
    protected $modelClass = "\Authentication\Model\EduPermission";
    protected $template = "advanced/permissions.tpl";
    private $actionPage = "/advanced/app/permissions/save";
    
    public function doBeforeDelete($id) {
        //Check if permission is in any facility or group or person.
        $permission = (new \Authentication\Model\EduPermission())->getObjectById($id);
        $facilityTypes = (new \Authentication\Model\EduFacilityTypePermission())->getFacilityTypesByPermission($permission->getId());
        $groups = (new \Authentication\Model\EduGroupPermission())->getGroupsByPermission($permission->getId());
        $users = (new \Authentication\Model\EduUserPermission())->getUsersByPermission($permission->getId());
        
        $message = "";
        $message .= (\count($facilityTypes) > 0) ? "The permission is still associated to one or more facility types.<br>" : "";
        $message .= (\count($groups) > 0) ? "The permission is still associated to one or more user groups.<br>" : "";
        $message .= (\count($users) > 0) ? "The permission is still associated to one or more users.<br>" : "";
        $status = ($message == "") ? true : false;
        return ["status" => $status, "message" => $message];
    }
    
    protected function setUpTemplateVars($obj, $msg = ''){
        $this->_edu->assign('permission',$obj);
        $this->_edu->assign('categories',  DbMapperUtility::convertObjectArrayToDropDown((new \Authentication\Model\EduMenuCategory())->getAllOrderBy('name', 'ASC')));
        $this->_edu->assign("submenuParents", DbMapperUtility::convertObjectArrayToDropDown((new $this->modelClass())->getLevelOneMenus()));
        $this->_edu->assign("user", (new \Authentication\Model\EduUser())->getObjectById($_SESSION['userId']));
        $this->_edu->assign('msg',$msg);
        $this->_edu->assign('list',$obj->getAll());
        $this->_edu->assign('html',$this->html);
        $this->_edu->assign('title',  MessageResources::i18n("legend.manage.permissions"));
        $this->_edu->assign('actionPage',$this->actionPage);
    }
}
