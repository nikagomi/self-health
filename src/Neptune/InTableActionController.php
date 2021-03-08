<?php

namespace Neptune;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
/**
 * Description of InTableActionController
 *
 * @author Randal Neptune
 */
class InTableActionController {
    protected $modelClass; 
    protected $html;
    
    public function __construct() {
        $this->html = \Neptune\Config::htmHelper();
    }
    
    public function ajaxSaveUpdateObj(Request $request){//
        
        /*$request = Request::create(
            '/student/guardian/update',
            'POST',
            array('id'=>'MOE2','studentId' => 'MOE3', 'email' => 'randal.neptune@outlook.com', 'firstName' => 'Cristian', 'lastName'=>'Hernandez','relationId' => 5, 'countryOfResidenceId' => 21,'phone' =>'555-6666')
        );*/
        
        $responseArr = array();
        $obj = new $this->modelClass();
        $obj->mapFormToEntity($request->request);
        if($request->request->get("id") == ""){
            $obj->save();
        }else{
            $obj->updateIncludeEmptyFields();
        }
        $responseArr['status'] = $obj->getOpStatus();
        $responseArr['msg'] = $obj->getOpMessage();
        $_SESSION['msg'] = $this->html->printMessageText($obj->getOpStatus(),$obj->getOpMessage());
        $responseArr['id'] = $obj->getId();
        $response = new Response(json_encode($responseArr));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }
    
    
    public function ajaxGetByIdJson($id){
        $obj = (new $this->modelClass())->getEntityById($id);
        $response = new Response($obj->convertObjectToJsonArray());
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }
    
    public function ajaxDeleteRow($id){
        $responseArr = array();
        $obj = (new $this->modelClass())->getEntityById($id);
        $obj->delete();
        $responseArr['status'] = $obj->getOpStatus();
        $responseArr['msg'] = $obj->getOpMessage();
        $response = new Response(json_encode($responseArr));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }
}
