<?php

namespace Utility\Controller;

use Neptune\BaseController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

/**
 * Description of EntityController
 * @package smile
 * @author nikagomi
 */
class EntityController extends BaseController {
    //put your code here
    
    public function quickAddSimple (Request $request) {
        $targetClass = $request->request->get("targetClass");
        $value = $request->request->get("name");
        $obj = new $targetClass();
        $obj->setName($value);
        $obj->save();
        $result = [];
        $result['status'] = $obj->getOpStatus();
        $result['msg'] = $obj->getOpMessage();
        $result['id'] = $obj->getId();
        $result['name'] = $obj->getName();
        
        $response = new Response(\json_encode($result));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }
    
    public function quickAddAssociatedSimple (Request $request) {
        
        /*$request = Request::create(
            '/simple/associated/entity/quickadd',
           'POST',
            array("targetClass" =>"\Admin\Model\EduCommunity", "parentClass" => '\Admin\Model\EduDistrict', "name" => "TSS1", "parentValue" => "SRM1")
        );*/
        $targetClass = $request->request->get("targetClass");
        $value = $request->request->get("name");
        $parentClass = $request->request->get("parentClass");
        $parentId = $request->request->get("parentValue");
        
        
        $parObj = (new $parentClass())->getObjectById($parentId);
        $setter = $parObj->getAssociatedSetterName();
        
        if (!$parObj->isIdEmpty()) {
            $obj = new $targetClass();
            $obj->setName($value);
            $obj->$setter($parentId);
            $obj->save();
            $result = [];
            $result['status'] = $obj->getOpStatus();
            $result['msg'] = $obj->getOpMessage();
            $result['id'] = $obj->getId();
            $result['name'] = $obj->getName();
        } else {
            $result['status'] = false;
            $result['msg'] = "Value provided for parent element cannot be found in the database";
        }
        
        $response = new Response(\json_encode($result));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }
}
