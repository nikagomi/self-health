<?php

namespace Neptune\Event;

use Symfony\Component\EventDispatcher\Event;

 
class MailerEvent extends Event{
    
    //private $mailer;
    private $subject;
    private $sendTo;
    private $sendFrom;
    private $body;
    private $url;


    public function __construct($subject, $body, array $sendTo, $sendFrom, $url = NULL){
        $this->subject = $subject;
        //$this->mailer = $mailer;
        $this->sendTo = $sendTo;
        $this->sendFrom = $sendFrom;
        $this->body = $body;
    }
 
//    public function getMailer() {
//        return $this->mailer;
//    }

    public function getSubject() {
        return $this->subject;
    }
    
    public function getSendTo() {
        return $this->sendTo;
    }

    public function getSendFrom() {
        return $this->sendFrom;
    }
    
    public function getBody() {
        return $this->body;
    }




}