<?php

namespace Neptune;

use Neptune\BaseController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
/**
 * Controller that takes into consideration that the class implements the modifiable interface
 *
 * @author Randal Neptune
 */
class ModifiableBaseController extends BaseController{
    
    public function save(Request $request){
        $now = \date("Y-m-d H:i:s");
        $obj = (new $this->modelClass())->mapFormToEntity($request->request);
        if($request->request->get("id") != ''){//an edit
            $dbObj = (new $this->modelClass())->getEntityById($request->request->get("id"));
            $obj->setCreatedById($dbObj->getCreatedById());
            if (method_exists($dbObj, 'setCreatedTime')) {
                $obj->setCreatedTime($dbObj->getCreatedTime());
            }
        }else{
            $obj->setCreatedById($_SESSION['userId']);
            if (method_exists($obj, 'setCreatedTime')) {
                $obj->setCreatedTime($now);
            }
        }
        if (\method_exists($obj, 'setModifiedTime')) {
            $obj->setModifiedTime($now);
        }
        if (\method_exists($obj, 'setModifiedById')) {
            $obj->setModifiedById($_SESSION['userId']);
        }
        $obj->pushObjectToDB(true);
            
        $msg = HtmlHelper::composeToastMessage([$obj->getOpStatus() => $obj->getOpMessage()]);
        //$msg = $this->html->printMessageText($obj->getOpStatus(),$obj->getOpMessage());       
        if($obj->getOpStatus()){
            $obj->clear(); 
        }
        $this->setUpTemplateVars($obj,$msg);
        return new Response($this->_health->display($this->template));
    }
}
