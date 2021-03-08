<?php

namespace Utility\Model;

/**
 * Description of Mailer
 * @author Randal Neptune
 */
class Mailer {
    
    private $transport;
    
    public function __construct($transport){
        $this->transport = $transport;
    }
    
    public function send($message){
        $mailer = new \Swift_Mailer($this->transport);
        return $mailer->send($message);
    }
    
}
