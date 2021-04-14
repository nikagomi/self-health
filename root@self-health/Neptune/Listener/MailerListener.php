<?php

namespace Neptune\Listener;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Neptune\HtmlHelper;

/**
 * Description of MailerListener
 * @package sarms
 * @author Randal Neptune
 */

class MailerListener implements EventSubscriberInterface{
    
    public function onMailerEvent(\Neptune\Event\MailerEvent $event){
        $_SESSION['mailerMessage'] = "";
        $html = new HtmlHelper();
        
        $sc = include __DIR__.'/../../container.php';
        $mailer = $sc->get("mailer");
        
        $message = new \Swift_Message($event->getSubject());//\Swift_Message::newInstance($event->getSubject());
        $message->setBody($event->getBody(), "text/html");
        $sender = ($event->getSendFrom() == '') ? "SM@RT" : $event->getSendFrom();
           
        $message->setFrom(array($sc->get("mail.transport")->getUsername() => $sender));
        $message->setTo($event->getSendTo());
        try{
            $mailer->send($message);
            $_SESSION["mailerMessage"] = $html->printMessageText(true, "The information was successfully sent");
        }catch(\Exception $me){
            $_SESSION["mailerMessage"] = $html->printMessageText(false, "Could not send the supplied information.<br/>Please consider contacting the local administrator directly.");
        }
        
        //Then send  a notification to user.
        //$response = $event->getResponse();
        
    }
    
    public static function getSubscribedEvents() {
         return array('listener.mailer' => 'onMailerEvent');
    }
}