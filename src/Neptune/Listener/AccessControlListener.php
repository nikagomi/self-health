<?php
namespace Neptune\Listener;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Neptune\DbMapperUtility;

/**
 * Description of AccessControlListener
 * @author Randal Neptune
 */
class AccessControlListener implements EventSubscriberInterface{
    
    public function onKernelRequest(GetResponseEvent $event){
        $request = $event->getRequest();
        
        
        $appUsr = (!empty($_SESSION['userId']) && isset($_SESSION['userId'])) ? (new \Authentication\Model\User())->getObjectById($_SESSION['userId']) : new \Authentication\Model\User();
        
        if(($request->getRequestUri() != "/login" && $request->getRequestUri() != "/" && $request->getRequestUri() != "/reset" && $request->getRequestUri() != "/register/user" 
                && $request->getRequestUri() != "/user/forgot/password" && $request->getRequestUri() != "/tfa/verify" 
                && $request->getRequestUri() != "/tfa/backup/code/login" && $request->getRequestUri() != "/tfa/verify/backup/code" && $request->getRequestUri() != "/tfa/verify/code"
                && $request->getRequestUri() != "/user/registration/capture/check" && $request->getRequestUri() != "/utility/captcha.php" && $request->getRequestUri() != "/ajax/user/verify/unique/email") 
            && $_SESSION['userId'] == "" ){
                $event->setResponse(new RedirectResponse("/"));
        } /*elseif (empty($_SESSION['menu']) and $appUsr->getId() != "") { //user just logged in.
            $_SESSION['menu'] = createMenu(\Neptune\DbMapperUtility::dBInstance(), $appUsr);
        }*/ else {
            //Get access map
            $accessMap = include __DIR__.'/../../access_control.php';
            $uri = $this->reconstructUri($request->getRequestUri());

            if (array_key_exists($uri, $accessMap)) {
                $prmConstant = $accessMap[$uri];
                if ($prmConstant != '') {
                    //if user does not have permission send him/her to access denied page
                    if (!\Authentication\Model\PermissionManager::userHasPermissionInList($prmConstant, $_SESSION['userId'])) {
                        $event->setResponse(new RedirectResponse("/access/denied"));
                    }
                }
            }
        }
        
        
        $event->stopPropagation();
    }
    
    public static function getSubscribedEvents(){
        return array(KernelEvents::REQUEST => 'onKernelRequest');
    }
    
    /**
     * Reconstructs the passed uri to remove ids and other variables to get the base url.
     * @param string $uri
     * @return string
     */
    private function reconstructUri($uri){
        $uriArr = explode("/",$uri);
        $reconstructionArray = array();
        $i = 0;

        foreach($uriArr as $uriPart){
            $x = $i - 1;
            if(preg_match("/^[a-zA-Z]+$/", $uriPart)){
                if($i <= 1 or preg_match("/^[a-zA-Z]+$/",$uriArr[$x])){
                    array_push($reconstructionArray, $uriPart);
                }
            }
            $i = $i+1;
        }
        return "/".implode("/",$reconstructionArray);
    }
    
    
}

