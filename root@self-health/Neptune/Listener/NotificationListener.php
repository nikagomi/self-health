<?php

namespace Neptune\Listener;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Neptune\Event\NotificationEvent;

/**
 * Listens for and handles notification creation events (listener.notify)
 * @package sarms
 * @author Randal Neptune
 */
class NotificationListener implements EventSubscriberInterface{
    
    public function onNotificationEvent(NotificationEvent $event){
        if(\trim(\strip_tags($event->getHeader())) != '' && \trim(\strip_tags($event->getMessage())) != ''){
            $notification = new \Utility\Model\Notification();
            $notification->setHeader($event->getHeader());
            $notification->setMessage( $event->getMessage());
            $notification->setCreatedTime(\date("Y-m-d H:i:s"));
            $notification->setUserId($_SESSION['userId']);
            $notification->setFacilityId($_SESSION['facilityId']);
            $notification->setAcknowledged(false);
            $notification->save();
        }
        $event->stopPropagation();
    }
    
    public static function getSubscribedEvents() {
        return array("listener.notify" => "onNotificationEvent");
    }

//put your code here
}
