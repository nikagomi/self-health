<?php

namespace Neptune\Event;

use Symfony\Component\EventDispatcher\Event;

class NotificationEvent extends Event{
    private $header;
    private $message;
 
    public function __construct($header, $message){
        $this->header = $header;
        $this->message = $message;
    }
 
    public function getHeader() {
        return $this->header;
    }

    public function getMessage() {
        return $this->message;
    }

}
