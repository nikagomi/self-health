<?php

namespace Error\Controller;

use Neptune\BaseController;
use Neptune\PropertyService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Debug\Exception\FlattenException;
/**
 * Description of ErrorController
 * @author Randal Neptune
 */
class ErrorController extends BaseController{
      
    public function noAccessGrantedSimple($errorMessage){
        $this->_health->assign('errorMessage',$errorMessage);
        return new Response($this->_health->display("security/error/unauthorizedAccessSimple.tpl"));
    }
    
    public function noAccessGranted($errorMessage){
        $this->_health->assign('errorMessage',$errorMessage);
        return new Response($this->_health->display("security/error/unauthorizedAccessPage.tpl"));
    }
    
    public function error404(FlattenException $exception){
        $msg = (filter_var(PropertyService::getProperty("show.error.message.content", false), FILTER_VALIDATE_BOOLEAN)) ? $exception->getFile()." on line: ".$exception->getLine()." - ". $exception->getMessage() : "Oops! This was unexpected!";
        $this->_health->assign("msg", $msg);
        $this->_health->assign("exception",$exception);
                
        return new Response($this->_health->display("security/error/errorPage.tpl"));
    }
    
    public function processErrorDetails(Request $request){
        //Get user and date/time here
        $user = (new \Authentication\Model\EduUser())->getObjectById($_SESSION['userId']);
        $time = \date("l M j, Y g:i:s a");
        $details = $request->request->get("details");
        $code = $request->request->get("code");
        $message = $request->request->get("message");
        $line = $request->request->get("line");
        $file = $request->request->get("file");
        
        $supportEmail = PropertyService::getProperty("admin.support.email","randal.neptune@proteustechinc.com");
        $facility = (new \Admin\Model\EduFacility())->getByFacilityCode(EduPropertyService::getProperty("facility.code"));
       

        $userName = ($user->isIdEmpty()) ? "System (No login)" : $user->getLabel();

        $body = "Error encountered by ".$userName." at ".$time." when attempting the following: <br/>".$details."<br/><br/>";
        $body .= " <b>Error details:</b> <br/><br/>Code: ".$code. "<br/>Message: ".$message."<br/>Line: ".$line."<br/>File: ".$file;

        $mailerEvent = new \Neptune\Event\MailerEvent("Application Error", $body, array($supportEmail => "Support"), $facility->getName());
        $this->sc->get('event.dispatcher')->dispatch('listener.mailer',$mailerEvent);
        
        return new Response($this->_health->display("security/error/processError.tpl"));
    }
}
