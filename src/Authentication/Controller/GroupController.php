<?php

namespace Authentication\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Neptune\HtmlHelper;
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
        $msgArr = [];
        \array_push($msgArr, [$group->getOpStatus() => $group->getOpMessage()]);       
        if($group->getOpStatus()){
            $result = $grpPerm->assignPermissions($group->getId(), $request->request->get('perm'));
            $tmpMsg = ($result) ? "Permissions were successfully updated." : "Permissions could not be updated.";
            \array_push($msgArr, [$result => $tmpMsg]);
            $group->clear(); 
        }
        $msg = HtmlHelper::composeToastMessage($msgArr);
        $this->setUpTemplateVars($group, $msg);
        return new Response($this->_health->display($this->template));
    }
    
    protected function setUpTemplateVars($obj, $msg = ''){
        $this->_health->assign('group',$obj);
       
        $this->_health->assign('categories',(new \Authentication\Model\MenuCategory())->getAllOrderBy('name', 'ASC'));
        $this->_health->assign('prm',new \Authentication\Model\Permission());
        $this->_health->assign('selectedPerms',(new \Authentication\Model\GroupPermission())->getPermissionsIdsByGroupId($obj->getId()));

        $this->_health->assign('msg',$msg);
        $this->_health->assign('list', (new \Authentication\Model\Group())->getAllOrderBy("name"));
        
        $this->_health->assign('html',$this->html);
        $this->_health->assign('title','Manage Groups');
        $this->_health->assign('actionPage',$this->actionPage);
    }
}
