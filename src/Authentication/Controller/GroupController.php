<?php

namespace Authentication\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
/**
 * Description of GroupController
 * @package sarms
 * @author Randal Neptune
 */
class GroupController extends \Neptune\BaseController{
    protected $modelClass = "\Authentication\Model\Group";
    protected $template = "security/group.tpl";
    private $actionPage = "/security/group/save";
    
    public function save(Request $request){
        $group = new $this->modelClass();
        $grpPerm = new \Authentication\Model\GroupPermission();
        $group->mapFormToEntity($request->request);
        $group->pushObjectToDB(true);     
        $msg = $this->html->printMessageText($group->getOpStatus(),$group->getOpMessage());       
        if($group->getOpStatus()){
            $result = $grpPerm->assignPermissions($group->getId(), $request->request->get('perm'));
            $tmpMsg = ($result) ? "Permissions were successfully updated." : "Permissions could not be updated.";
            $msg .= $this->html->printMessageText($result,$tmpMsg);
            $group->clear(); 
        }
        $this->setUpTemplateVars($group, $msg);
        return new Response($this->_hiags->display($this->template));
    }
    
    protected function setUpTemplateVars($obj, $msg = ''){
        $this->_hiags->assign('group',$obj);
       
        $this->_hiags->assign('categories',(new \Authentication\Model\MenuCategory())->getAllOrderBy('name', 'ASC'));
        $this->_hiags->assign('prm',new \Authentication\Model\Permission());
        $this->_hiags->assign('selectedPerms',(new \Authentication\Model\GroupPermission())->getPermissionsIdsByGroupId($obj->getId()));

        $this->_hiags->assign('msg',$msg);
        $this->_hiags->assign('list', (new \Authentication\Model\Group())->getAllOrderBy("name"));
        
        $this->_hiags->assign('html',$this->html);
        $this->_hiags->assign('title','Manage Groups');
        $this->_hiags->assign('actionPage',$this->actionPage);
    }
}
