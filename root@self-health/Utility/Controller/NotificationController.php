<?php


namespace Utility\Controller;
use Neptune\BaseController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

/**
 * Description of NotificationController
 * @package sarms
 * @author Randal Neptune
 */
class NotificationController extends BaseController {
    protected $modelClass = "\Utility\Model\Notification";
    
    public function ajaxAcknowledgeNotification(Request $request){
        $notification = (new $this->modelClass())->getEntityById($request->request->get('id'));
        $notification->setUpdatedById($_SESSION['userId']);
        $notification->setUpdatedTime(\date("Y-m-d H:i:s"));
        $notification->setAcknowledged(true);
        $notification->update();
        
        $resultArr = array();
        $resultArr['status'] = $notification->getOpStatus();
        $resultArr['message'] = $notification->getOpMessage();
        
        $response = new Response(\json_encode($resultArr));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }
    
    public function ajaxGetNotifications(){
        $notifications = (new $this->modelClass())->getNotificationsForUser($_SESSION['userId'], $_SESSION['facilityId']);
        $response = new Response(\json_encode($notifications));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }
    
}
