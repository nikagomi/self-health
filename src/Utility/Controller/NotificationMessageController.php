<?php


namespace Utility\Controller;
use Neptune\BaseController;
use Neptune\DbMapperUtility;
use Neptune\PropertyService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Description of NotificationMessageController
 * @package smile
 * @author nikagomi
 */
class NotificationMessageController extends BaseController {
    protected $modelClass = "\Utility\Model\EduNotificationMessage";
    protected $template = "utility/notify/notificationMessage.tpl";
    private $actionPage = "/utility/notification/message/save";
    

    
    public function ajaxSendPatientEmail (Request $request) {
        /*$request = Request::create(
            '/send/patient/email',
            'POST',
            array('patientId' => "ESC11",'subject' => "Testing Msg", 'message' => 'This is a test message.')
        );*/
        $msg = \trim($request->request->get("message"));
        
        $subject = \trim($request->request->get("subject"));
        $patient = (new \Patient\Model\Patient())->getObjectById($request->request->get("patientId"));
        $user = (new \Authentication\Model\User())->getObjectById($_SESSION['userId']);
     
        
        
        $cnt = 0;
        $usrLabel = $user->getLabel();
        
        //Mailer setup 
        $transport = $this->serviceContainer()->get('mail.transport');
        $mailer = new \Swift_Mailer($transport);
        $message = (new \Swift_Message($subject))
        //->setFrom(array($user->getEmail() => $usrLabel));
        ->setFrom(array($this->serviceContainer()->getParameter('mail.user') => "Self-Health Reporter"));
        
        
        //Define body text
        $bodyText .= "<br/><br/>";
        $bodyText .= '<span style="color:#888;">----------<br/>';
        $bodyText .= "This e-mail and any attachments may contain confidential and privileged information.";
        $bodyText .= "If you are not the intended recipient, please notify the sender immediately by telephone <i>".\Neptune\PropertyService::getProperty("helpdesk.contact.number")."</i>, ";
        $bodyText .= "delete this e-mail and destroy any copies. Any dissemination or use of this information by a person other ";
        $bodyText .= "than the intended recipient is unauthorized and may be illegal.</span>";
        
        $signature = "<br/><br/>---<br/>";
        $signature .= "<b>".$usrLabel."</b>";
        
       // $signature .= "<br/>";
        //$signature .= "<img src='".$message->embed(\Swift_Image::fromPath("/var/www/mcare/html/images/MCareTL.png"))."' style='margin-left:0px;padding-left:0px;'/>";
        
        $msgText = "Dear ".$patient->getFullName().",<br/>".$msg.$signature.$bodyText;

        $message->setBody($msgText, "text/html");
        //Set up recipient email depending on number of addresses present.
        if (\trim($request->request->get("emails")) != '') {
            $emails = \explode(",",\trim($request->request->get("emails")));
            $addresses = [];
            foreach ($emails as $emailAddr) {
                $addresses[$emailAddr] = $patient->getFullName();
            }
            $message->setTo($addresses);
        } else {
            $message->setTo([$patient->getEmail() => $patient->getFullName()]);
        }
        try {
            $sent = $mailer->send($message);
            $cnt += (\is_numeric($sent)) ? $sent : 0;
        } catch (\Exception $e) {
            //echo $e->getMessage();
            //do nothing for now.
        } 
        $msgTxt .= ($cnt > 0) ?  "<div class='infoMessage'>The email was successfully sent.</div>" : "<div class='errorMessage'>Sorry, but the email could not be sent. Please try again later.</div>" ;
        $response = new Response(\json_encode($msgTxt));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }
    
}
