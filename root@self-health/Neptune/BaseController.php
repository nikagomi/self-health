<?php

namespace Neptune;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Config\FileLocator;
use Neptune\HtmlHelper;

abstract class BaseController{
   
    protected $_health;
    protected $html;
    protected $user;
    protected $modelClass;
    protected $template;
    protected $sc;
    protected $dateDisplayStr = 'd/m/Y';
    protected $dateTimeDisplayStr = 'M j, Y g:i a';
    
    public function __construct(){
        $configDir = array(__DIR__.'/../');
        $locator = new FileLocator($configDir);
        $this->sc = include($locator->locate("container.php", null, true));
        
        $this->html = \Neptune\Config::htmHelper();
        $this->_health = \Neptune\Config::healthHandler();
        
        //$usrSerialize = $_SESSION['appUser'];
        //$this->user =  \unserialize($usrSerialize);
    }
    
    public function getHealth() {
        return $this->_health;
    }

    public function getHtml() {
        return $this->html;
    }

    public function setHealth($_health) {
        $this->_health = $_health;
    }

    public function setHtml($html) {
        $this->html = $html;
    }

    public function getUser() {
        return $this->user;
    }

    public function setUser($user) {
        $this->user = $user;
    }
    
    public function serviceContainer(){
        return $this->sc;
    }
    
    public function getDateDisplayStr() {
        return $this->dateDisplayStr;
    }

    public function setDateDisplayStr($dateDisplayStr) {
        $this->dateDisplayStr = $dateDisplayStr;
    }

    public function getDateTimeDisplayStr() {
        return $this->dateTimeDisplayStr;
    }

    public function setDateTimeDisplayStr($dateTimeDisplayStr) {
        $this->dateTimeDisplayStr = $dateTimeDisplayStr;
    }

    public function form (Request $request){
        $this->setUpTemplateVars(new $this->modelClass());
        return new Response($this->_health->display($this->template));
    }
    
    public function edit(Request $request, $id){
        if($this->doBeforeEdit($request,$id)){
            $obj =(new $this->modelClass())->getEntityById($id);
            $this->setUpTemplateVars($obj);
            return new Response($this->_health->display($this->template));
        }else{
            return new RedirectResponse("/access/denied"); 
        }
    }
    
    protected function setUpTemplateVars($class, $msg =''){
        $this->_oecs->assign("msg", $msg);
        $this->_oecs->assign("class",$class);
    }
    
    public function delete($id){
        $obj = (new $this->modelClass())->getEntityById($id); 
        $msg = '';
        $result = $this->doBeforeDelete($id);
        if($result["status"]){
            $obj->delete();
            //$msg .= HtmlHelper::toastWrapperStart() . HtmlHelper::generateToast($obj->getOpStatus(),$obj->getOpMessage()) . HtmlHelper::toastWrapperEnd();
            $msg = HtmlHelper::composeToastMessage([$obj->getOpStatus() => $obj->getOpMessage()]);
            if($obj->getOpStatus()) {
                $obj->clear();
            }
        }else{
            $msg = HtmlHelper::composeToastMessage([false => $result['message']]);
            //$msg = HtmlHelper::toastWrapperStart() . HtmlHelper::generateToast(false, $result['message']) . HtmlHelper::toastWrapperEnd();
        }
        $this->setUpTemplateVars($obj, $msg);
        return new Response($this->_health->display($this->template));
    }
    
    public function save(Request $request){
        $obj = new $this->modelClass();
        $result = $this->doBeforeSubmit($request);
        $obj->mapFormToEntity($request->request);
        if($result['proceed']){
            $obj->pushObjectToDB(true);     
            //$msg = HtmlHelper::toastWrapperStart() . HtmlHelper::generateToast($obj->getOpStatus(),$obj->getOpMessage()) . HtmlHelper::toastWrapperEnd();   
            $msg = HtmlHelper::composeToastMessage([$obj->getOpStatus() => $obj->getOpMessage()]);
            if($obj->getOpStatus()){
                $obj->clear(); 
            }
            $this->doAfterSubmit();
        }else{
            $msg = HtmlHelper::composeToastMessage([false => $result['message']]);
        }
        $this->setUpTemplateVars($obj,$msg);
        return new Response($this->_health->display($this->template));
    }
    
    /**
     * In some cases checks need to be done before something can be deleted.
     * @param Request $request
     * @param mixed $id
     * @return boolean
     */
    public function doBeforeDelete($id){
        return $proceed = array("status" => true, "message" => "");
    }
    
    /* To know when for is submitted the first time */
    public function doBeforeSubmit(Request $request){
        $proceed  = true;
        $msg = "";
        if(\strtoupper($request->request->get("facilityCode")) == "SRM"){
           $proceed = false;
           //$msg = HtmlHelper::toastWrapperStart() . HtmlHelper::generateToast(false, "using the facility code: <b>SRM</b> is not allowed because it is reserved") . HtmlHelper::toastWrapperEnd();
           $msg = HtmlHelper::composeToastMessage([false  => "Using the facility code: <b>SRM</b> is not allowed because it is reserved"]);
        }
        return array("proceed" => $proceed, "message" => $msg);
    }
    
    /* Regenerate variable to avoid form resubmission */
    public function doAfterSubmit(){
        
    }
    
    /* Actions, tests that need to be done before user can see edit screen */
    public function doBeforeEdit(Request $request, $id){
        return (\trim($id) != '');
    }
    
    /**
     * Returns the identified object as a json array
     * @param string $id
     * @return Response
     */
    public function ajaxJSONGetPropertiesById ($id){
        $gradeLevel = (new $this->modelClass())->getObjectById($id);
        $response = new Response($gradeLevel->convertObjectToJsonArray());
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }

}

