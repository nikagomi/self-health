<?php

namespace Authentication\Controller;

use Symfony\Component\HttpFoundation\{Request, Response, RedirectResponse};
use Authentication\Model\{User, PermissionManager};
use Neptune\{DbMapperUtility, BaseController, PropertyService, MessageResources};


class AuthenticationController extends BaseController{
   private $usr;
    
    public function __construct(){
        parent::__construct();
        $this->usr = new User();
    }
    
    public function aboutLink () {
        $this->_health->assign("title", "About OCES PEHR");
        $response = new Response($this->_health->display('utility/about.tpl'));
        return $response;
    }
    
    public function indexAction(Request $request){
        $this->_health->assign('actionPage','/login');
        $this->_health->assign('html',$this->html);
       
        //Locale stuff
        $_SESSION['messageFile'] = "/var/www/oecs/src/locales/messages_en_US.properties";
        
        $this->_health->assign("genderIds", DbMapperUtility::convertObjectArrayToDropDown((new \Admin\Model\Gender())->getAllOrderBy("name")));
        $this->_health->assign("countryIds", DbMapperUtility::convertObjectArrayToDropDown((new \Admin\Model\Country())->getAllOrderBy("name")));

        $response = new Response($this->_health->display('start/login.tpl'));
        return $response;
    }
    
    public function verifyCode (Request $request) {
        /*$request = Request::create(
            '/tfa/verify/code',
            'POST',
            array('userId' => 'SRM1', 'code' => '111111')
        );*/
        $this->usr->getObjectById($request->request->get("userId"));
        $code = $request->request->get("code");
       
        $qrcProvider = new \Utility\Model\QRCodeProvider();
        $tfa = new \RobThree\Auth\TwoFactorAuth("H3@LTH", 6, 30, 'sha1', $qrcProvider);
        
        $status = $tfa->verifyCode($this->usr->getTwoFactorSecret(), $code, 2);
        $response = new Response(json_encode($status));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }
    
    public function verifyBackupCode (Request $request) {
        $userId = $request->request->get("userId");
        $code = $request->request->get("code");
       
        $bkupCode = (new \Authentication\Model\TwoFAUserBackupCode())->nextAvailableCode($userId);
        $status = ($bkupCode->isNotUsed() && $code == $bkupCode->getBackupCode()) ? (bool) true : (bool) false;
        $response = new Response(json_encode($status));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }
    
    
    public function backupCodeTFALogin (Request $request) {
        $this->usr->getObjectById($request->request->get("userId"));
        
        
        $bkupCode = (new \Authentication\Model\TwoFAUserBackupCode())->nextAvailableCode($this->usr->getId());
        //update user login details
        $loginAmount = ($this->usr->getLoginAmount() == "") ? 1 : $this->usr->getLoginAmount() + 1;
        $this->usr->setLoginAmount($loginAmount);

        $lastLoginTime = $this->usr->getLastLoginTime();
        $this->usr->setPreviousLogin($lastLoginTime);
        $this->usr->setLastLoginTime(\date('Y-m-d H:i:s'));
        $previousLoginIp = $this->usr->getLoginIp();
        $this->usr->setPreviousLoginIp($previousLoginIp);
        $this->usr->setLoginIp($request->server->get('REMOTE_ADDR'));
      

        //Set session variables and go to home page
        $appUser = serialize($this->usr);
        $_SESSION["appUser"] = $appUser;  
        //Put the logged in user id in session. Facilitates logging.
        $_SESSION["userId"] = $this->usr->getId();
        $_SESSION["userName"] = $this->usr->getLabel();
        $_SESSION["timeout"] = $this->usr->getTimeout();
        $_SESSION['code'] = PropertyService::getProperty("pk.code.prefix","HLTH");
        
        //Delete current user session if it exists
        if($this->usr->getSessionId() != "" && (session_id() != $this->usr->getSessionId())){
            $path = (\session_save_path() == '') ? \sys_get_temp_dir() : \session_save_path();
            $fileArr = \glob($path.'/*'.$this->usr->getSessionId());
            \unlink($fileArr[0]);
        }
       
        //Invalidate backup code
        $bkupCode->setUsed(TRUE);
        $bkupCode->setTimeUsed(\date('Y-m-d H:i:s'));
        $bkupCode->update();
        
        //update user object
        $this->usr->setSessionId(session_id());
        $this->usr->setTwoFactorAuthEnabled(FALSE);//Disable 2FA
        $this->usr->setTwoFactorSecret(''); //Creating another secret.!!! PROBLEM.
        $this->usr->updateIncludeEmptyFields();
        
        return new RedirectResponse ("/security/user/preferences");
    }
    
    public function verifyTFA (Request $request) {
        $this->usr->getObjectById($request->request->get("userId"));
        $code = $request->request->get("code");
        $numCode = \join('', $code);
        
        $qrcProvider = new \Utility\Model\QRCodeProvider();
        $tfa = new \RobThree\Auth\TwoFactorAuth("H3@LTH", 6, 30, 'sha1', $qrcProvider);
        
        if ($tfa->verifyCode($this->usr->getTwoFactorSecret(), $numCode, 2) == true) {
            
            //update user login details
            $loginAmount = ($this->usr->getLoginAmount() == "") ? 1 : $this->usr->getLoginAmount() + 1;
            $this->usr->setLoginAmount($loginAmount);

            $lastLoginTime = $this->usr->getLastLoginTime();
            $this->usr->setPreviousLogin($lastLoginTime);
            $this->usr->setLastLoginTime(\date('Y-m-d H:i:s'));
            $previousLoginIp = $this->usr->getLoginIp();
            $this->usr->setPreviousLoginIp($previousLoginIp);
            $this->usr->setLoginIp($request->server->get('REMOTE_ADDR'));

            //Set session variables and go to home page
            $appUser = serialize($this->usr);
            $_SESSION["appUser"] = $appUser;  
            //Put the logged in user id in session. Facilitates logging.
            $_SESSION["userId"] = $this->usr->getId();
            $_SESSION["userName"] = $this->usr->getLabel();
            $_SESSION["timeout"] = $this->usr->getTimeout();
            $_SESSION['code'] = PropertyService::getProperty("pk.code.prefix","HLTH");
            
            //Delete current user session if it exists
            if($this->usr->getSessionId() != "" && (session_id() != $this->usr->getSessionId())){
                \unlink(session_save_path()."/sess_".$this->usr->getSessionId());
            }

            //update user object
            $this->usr->setSessionId(session_id());
            $this->usr->updateIncludeEmptyFields();
            return $this->navigateHome();
        } else {
            $msg =  $this->html->printMessageText(false, 'Provided code is incorrect. Try again.');
            $this->_health->assign('enabled2FA',true);
            $this->_health->assign('userId',$this->usr->getId());
            $this->_health->assign('msg2FA',$msg);
            return $this->indexAction();
        }
    }
    
    public function resetPassword(Request $request){
        $npass = $this->html->cleanText($request->request->get('newPassw'));
        $cpass = $this->html->cleanText($request->request->get('confPassw'));

        $this->usr->getEntityById($request->request->get('userId'));
        $reset = $this->usr->getReset();
        if($npass != $cpass){
          $msg =  $this->html->printMessageText(false, MessageResources::i18n("err.msg.password.match.new"));
          $this->_health->assign('reset',$reset);
          $this->_health->assign('npass',$npass);
          $this->_health->assign('cpass',$cpass);
          $this->_health->assign('userId',$this->usr->getId());
          $this->_health->assign('msg',$msg);
        }else{
            //$dbPass = sha1($npass);
            $dbPass = password_hash($npass, PASSWORD_BCRYPT);
            $currPass = $this->usr->getPassword();
            
            if(password_verify($npass, $currPass)){//$currPass == $dbPass

               $msg =  $this->html->printMessageText(false, MessageResources::i18n("err.msg.new.old.password.match")); 
               $this->_health->assign('msgReset',$msg);
               $this->_health->assign('reset',$reset);
               $this->_health->assign('userId',$this->usr->getId());
            }else{
                try{
                    
                     //Check for 2 factor authentication
                    if ($this->usr->isTwoFactorAuthEnabled()) {
                        $this->_health->assign('userId',$this->usr->getId()); 
                        $this->_health->assign('enabled2FA',true);
                        return $this->indexAction($request);
                    } else {
                        //set login amount, password and reset
                        $loginAmount = ($this->usr->getLoginAmount() == "") ? 1 : $this->usr->getLoginAmount() + 1;
                        $this->usr->setLoginAmount($loginAmount);
                        $this->usr->setPassword($dbPass);
                        $this->usr->setReset(false);

                        //Update user login details
                        $lastLoginTime = $this->usr->getLastLoginTime();
                        $this->usr->setPreviousLogin($lastLoginTime);
                        $this->usr->setLastLoginTime(\date('Y-m-d H:i:s'));
                        $previousLoginIp = $this->usr->getLoginIp();
                        $this->usr->setPreviousLoginIp($previousLoginIp);
                        $this->usr->setLoginIp($request->server->get('REMOTE_ADDR'));
                       

                        //Set session variables and go to home page
                        //$appUser = serialize($this->usr);
                        //$_SESSION["appUser"] = $appUser;
                        //Put the logged in user in session. Facilitates logging.
                        $_SESSION["userId"] = $this->usr->getId();
                        $_SESSION["userName"] = $this->usr->getLabel();
                        $_SESSION["timeout"] = $this->usr->getTimeout();
                        $_SESSION['code'] = PropertyService::getProperty("pk.code.prefix","HIA");
                        
                        //update user object
                        $this->usr->setFailedLoginTime("");
                        $this->usr->setAccummulatedFailedLogins(0);
                        $this->usr->setNextLoginReferenceTime("");
                        $this->usr->updateIncludeEmptyFields();

                        if(!$this->usr->getOpStatus()){
                            //$_SESSION["appUser"] = null;
                            $_SESSION["userId"] = "";
                             throw new \Exception(MessageResources::i18n("err.msg.auth.update.user"));
                        }
                        $_SESSION['isPatient'] = $this->usr->isPatient();
                        $_SESSION['patientId'] = ($this->usr->isPatient()) ? (new \Patient\Model\Patient())->getByUserId($this->usr->getId())->getId() : '';
                        return $this->navigateHome();
                    }
                    //return RedirectResponse::create("/student/search/form");
                }catch(\Exception $e){
                    $msg = $this->html->printMessageText(false,$e->getMessage());
                    $this->_health->assign("reset",true);
                    $this->_health->assign('msg',$msg);
                    $this->_health->assign('userName',$usrName);
                }
            }
        }
        return $this->indexAction($request);
    }
    
    public function login(Request $request){
        
        $usrName = \trim($request->request->get("username"));
        $pass = \trim($request->request->get("passw"));
        $showForgotPassword = false;
        $failedLoginThreshold = \filter_var(PropertyService::getProperty("security.consecutive.failed.logins.threshold", 5), FILTER_VALIDATE_INT);
        $failedLoginIntervalMinutes = \filter_var(PropertyService::getProperty("security.failed.login.interval", 3), FILTER_VALIDATE_INT);
        
        if(empty($usrName) or empty($pass)){
            $msg = $this->html->printMessageText(false, MessageResources::i18n("err.msg.password.email.invalid"));
        }else{// check that the user exists
             $this->usr->getByEmail($usrName); 
             
             if($this->usr instanceof User && $this->usr->getId() != ''){
                
                 //check if account is locked.
                 if(!$this->usr->getLocked()){
                    //Check passwords
                 
                    if(password_verify($pass, $this->usr->getPassword())){
                        $reset = $this->usr->getReset();
                        
                        try{
                            if($reset){
                                $this->_health->assign('userId',$this->usr->getId());                     
                                $this->_health->assign('reset',$reset);
                                return $this->indexAction($request);
                            }else{
                                //check to make sure that the user is not blocked because of failed logins
                                if($this->usr->getNextLoginReferenceTime() != ""){
                                    $nextPermittedLoginAttempt = new \DateTime($this->usr->getNextLoginReferenceTime());
                                    if($nextPermittedLoginAttempt > new \DateTime(\date("Y-m-d H:i:s"))){
                                        //User still has to wait
                                        throw new \Exception(MessageResources::i18nParams("err.msg.failed.login.threshold", $nextPermittedLoginAttempt->format("M j Y g:i a")));
                                    }
                                }else{
                                    $this->usr->setFailedLoginTime("");
                                    $this->usr->setAccummulatedFailedLogins(0);
                                    $this->usr->setNextLoginReferenceTime("");
                                }
                            }
                            
                            //Check for 2 factor authentication
                            if ($this->usr->isTwoFactorAuthEnabled()) {
                                $this->_health->assign('userId',$this->usr->getId()); 
                                $this->_health->assign('enabled2FA',true);
                                return $this->indexAction($request);
                            } else {
                                //update user login details
                                $loginAmount = ($this->usr->getLoginAmount() == "") ? 1 : $this->usr->getLoginAmount() + 1;
                                $this->usr->setLoginAmount($loginAmount);

                                $lastLoginTime = $this->usr->getLastLoginTime();
                                $this->usr->setPreviousLogin($lastLoginTime);
                                $this->usr->setLastLoginTime(\date('Y-m-d H:i:s'));
                                $previousLoginIp = $this->usr->getLoginIp();
                                $this->usr->setPreviousLoginIp($previousLoginIp);
                                $this->usr->setLoginIp($request->server->get('REMOTE_ADDR'));
                              

                                //Set session variables and go to home page
                                //$appUser = serialize($this->usr);
                                //$_SESSION["appUser"] = $appUser;  
                                //Put the logged in user id in session. Facilitates logging.
                                $_SESSION["userId"] = $this->usr->getId();
                                $_SESSION["userName"] = $this->usr->getLabel();
                                $_SESSION["timeout"] = $this->usr->getTimeout();
                                $_SESSION['code'] = PropertyService::getProperty("pk.code.prefix","HLTH");
                                $_SESSION['isPatient'] = $this->usr->isPatient();
                                $_SESSION['patientId'] = ($this->usr->isPatient()) ? (new \Patient\Model\Patient())->getByUserId($this->usr->getId())->getId() : '';
                                
                                //Delete current user session if it exists
                                /*if($this->usr->getSessionId() != "" && (session_id() != $this->usr->getSessionId())){
                                    \unlink(session_save_path()."/sess_".$this->usr->getSessionId());
                                }*/

                                //update user object
                                $this->usr->setSessionId(session_id());
                                $this->usr->updateIncludeEmptyFields();
                                return $this->navigateHome();
                            }
                            
                        }catch(\Exception $e){
                            $msg = $this->html->printMessageText(false,$e->getMessage());
                            $this->_health->assign('msg', $msg);
                            $this->_health->assign('userName', $usrName);
                            $this->_health->assign('userId', $this->usr->getId());                     
                            $this->_health->assign('reset', $reset);
                            $this->_health->assign('showForgotPassword', $showForgotPassword);
                        }
                    }else{ /********** Too many failed login attempts ****/
                        //Put check for failed logins here.
                        $failedLogins = \intval($this->usr->getAccummulatedFailedLogins()) + 1;
                        $msg = $this->html->printMessageText(false, MessageResources::i18n("err.msg.incorrect.credentials")); 
                       
                        $now = new \DateTime(\date("Y-m-d H:i:s"));
                        if($failedLogins <= 1){
                            //first failed login so log the time
                            $this->usr->setFailedLoginTime(\date("Y-m-d H:i:s"));
                            $this->usr->setAccummulatedFailedLogins($failedLogins);
                        }else{
                            $failedLoginTime = new \DateTime($this->usr->getFailedLoginTime());
                           
                            //Get threshold interval for failed logins
                            $elapsed = $failedLoginTime->diff($now);
                            if($failedLogins < $failedLoginThreshold && \intval($elapsed->i) <=  $failedLoginIntervalMinutes){
                                $this->usr->setAccummulatedFailedLogins($failedLogins);
                            //So threshold has been reached
                            //Check difference between now and failed login time
                            }elseif($failedLogins >= $failedLoginThreshold && \intval($elapsed->i) <=  $failedLoginIntervalMinutes){
                                //Need to make sure user cannot log in and set next login reference time.
                                $waitTime = \filter_var(PropertyService::getProperty("security.failed.login.wait.interval", 10), FILTER_VALIDATE_INT);
                                $waitInterval = "+".$waitTime." minute";
                                $now->modify("+".$waitInterval);
                                $this->usr->setNextLoginReferenceTime($now->format("Y-m-d H:i:s"));
                                $this->usr->setAccummulatedFailedLogins($failedLogins);
                                $msg = $this->html->printMessageText(false, MessageResources::i18nParams("err.msg.failed.login.threshold", $now->format("M j Y g:i a"))); 
                            }else{
                                //period has passed. Restart the check as user wouldn't be here if login is correct
                                $this->usr->setAccummulatedFailedLogins(1);
                                $this->usr->setFailedLoginTime($now->format("Y-m-d H:i:s"));
                                $this->usr->setNextLoginReferenceTime("");
                            }
                        }
                        //Now update user record in db.
                        $this->usr->updateIncludeEmptyFields();
                        $_SESSION['facilityId'] = ""; //clean up the facility id
                        
                        
                        $showForgotPassword = true;
                        $this->_health->assign('userName',$this->usr->getEmail());
                        $this->_health->assign('showForgotPassword', $showForgotPassword);
                    }
                 }else{
                     $msg = $this->html->printMessageText(false, MessageResources::i18n("err.msg.account.locked")); 
                     $this->_health->assign('userName',$this->usr->getEmail());
                     $this->_health->assign('showForgotPassword', false);
                }
            }else{
                $msg = $this->html->printMessageText(false, MessageResources::i18n("err.msg.incorrect.credentials"));
                $showForgotPassword = false;
                $this->_health->assign('userName',$usrName);
                $this->_health->assign('showForgotPassword', $showForgotPassword);
            }
        }
        $this->_health->assign('msg',$msg);
        return $this->indexAction($request);
    }
    
    /**
     * To log out of the application and destroy the session 
     * @param Request $request
     */
    public function logOut(Request $request){
        $usr = (new \Authentication\Model\User())->getObjectById($_SESSION['userId']);
        $sessionId = $usr->getSessionId();
        
        //Clear up the database
        $usr->setSessionId("");
        $usr->updateIncludeEmptyFields();
        session_destroy();
        
        //Delete session file
        $path = (\session_save_path() == '') ? \sys_get_temp_dir() : \session_save_path();
        $fileArr = \glob($path.'/*'.$sessionId);
        \unlink($fileArr[0]);
        
        return new RedirectResponse("/");
    }
    
    public function forceLogOut($userId){
        $usr = (new \Authentication\Model\User())->getObjectById($userId);
        $sessionId = $usr->getSessionId();
        
        $path = (\session_save_path() == '') ? \sys_get_temp_dir() : \session_save_path();
        $fileArr = \glob($path.'/*'.$sessionId);
        $sessionDeleted = unlink($fileArr[0]);
        
        if ($sessionDeleted) {
            $usr->setSessionId("");
            $usr->updateIncludeEmptyFields(); 
        }
        $response = new Response(\json_encode($usr->getOpStatus() && $sessionDeleted));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }
    
    /**
     * Handles timeout log outs which triggers a notification event to 
     * create a notification for the user at next login.
     * @return Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function timeoutLogOut(){
        $usr = (new \Authentication\Model\User())->getObjectById($_SESSION['userId']);
        $sessionId = $usr->getSessionId();
        //Clear up the database
        $usr->setSessionId("");
        $usr->updateIncludeEmptyFields();
        session_destroy();
        
        //Delete session file
        $path = (\session_save_path() == '') ? \sys_get_temp_dir() : \session_save_path();
        $fileArr = \glob($path.'/*'.$sessionId);
        \unlink($fileArr[0]);
        
        return new RedirectResponse("/");
    }
    
    /**
     * Determine what should be the users first page.
     * @return Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function navigateHome(){
        
        $usr = (new \Authentication\Model\User())->getObjectById($_SESSION['userId']);
        if ($usr->isPatient()) {
            $destination = "/patient/summary/".$_SESSION['patientId'];
        } elseif (PermissionManager::userHasPermission ("SEARCH.PATIENTS", $usr->getId())){
            $destination = "/patient/search/form";
        } else {
            $destination = "/security/user/preferences";
        }
        return new RedirectResponse($destination);
    }
    
    /**
     * Sends random password to user's email after a forgot password request
     * @param Request $request
     * @return Response
     */
    public function forgotPasswordRequest(Request $request){/**/
       /*$request = Request::create(
        '/user/forgot/password',
        'POST',
        array('email' => 'nikagomi@yahoo.com')
        );*/
        $email = $request->request->get("email");
        $user = (new \Authentication\Model\User())->getByEmail($email);
  
        
        /** Necessary for logging and primary key generation **/
        $_SESSION['userId'] = $user->getId();
        
        $pwdRequest = $user->forgotPwdRequestStatus();
       
        $responseArr = array();
        if($user instanceof User && $user->getId() != ''){
            if($pwdRequest['permitted']){
                $randomPasswd = DbMapperUtility::generateRandomPassword();
                $hash = password_hash($randomPasswd, PASSWORD_BCRYPT);
                $user->setPassword($hash);
                $user->setReset(true);
                $transport = $this->serviceContainer()->get('mail.transport');
                try{

                    $mailer = new \Swift_Mailer($transport);
                    $message = (new \Swift_Message("Password request for: ".$user->getLabel()))
                        ->setFrom(array($transport->getUsername() => "Self Health"));
                    $message->setTo(array($user->getEmail() => $user->getLabel()));

                    $bodyText = "Dear ".$user->getLabel().",";
                    $bodyText .= "<br/><br/>You are receiving this email because you requested a password reset for your user account";
                    $bodyText .= " with the Self Health Reporting Application";
                    $bodyText .= "<br/><br/>";
                    $bodyText .= "Your new log-in credentials are as follows: <br/>";
                    $bodyText .= "Email: <b style='font-family:courier;'>".$user->getEmail()."</b><br/>";
                    $bodyText .= "Password: <b style='font-family:courier;font-size:1rem;'>".$randomPasswd."</b>";
                    $bodyText .= "<br/><br/>";
                    $bodyText .= "Please log-in with the above credentials after which you will be required to change your password.";
                    $bodyText .= "<br/><br/>";
                    $bodyText .= '<i><span style="font-size:12px;font-weight:bold;color:#333;">Please do not reply to this email.';
                    $bodyText .= " If you did not make this request or have any queries, please contact the application Help Desk at: ";
                    $bodyText .= PropertyService::getProperty("app.helpdesk.contact", "555-5555")."</span></i>";
                    $bodyText .= "<br/><br/>";

                    $bodyText .= '<span style="color:#888;">----------<br/>';
                    $bodyText .= "This e-mail and any attachments may contain confidential and privileged information.";
                    $bodyText .= "If you are not the intended recipient, please notify the sender immediately by telephone, ";
                    $bodyText .= "delete this e-mail and destroy any copies. Any dissemination or use of this information by a person other ";
                    $bodyText .= "than the intended recipient is unauthorized and may be illegal.";

                    $message->setBody($bodyText, "text/html");
                    $cnt = $mailer->send($message);
                    $responseArr['status'] = $cnt;
                    if($cnt > 0){
                        
                        $user->setLastForgotPasswordRequestTime($pwdRequest['nextTime']);
                        $user->update();
                        
                        if($user->getOpStatus()){
                           $responseArr['msg'] = "Your password has been reset. Reset instructions have been sent to ".$user->getEmail(); 
                        }else{
                           $responseArr['msg'] = "Could not reset your password at this time. Please ignore email and try again later"; 
                        }
                    }else{
                        $responseArr['msg'] = "Could not reset your password at this time. Please contact the facility or try again later"; 
                    }
                }catch(\Swift_TransportException $ste){
                    $responseArr['msg'] = $ste->getMessage();  
                    $responseArr['status'] = 0;
                }catch(Exception $e){
                    $responseArr['msg'] = "Could not reset your password at this time. Please contact the facility or try again later";  
                    $responseArr['status'] = 0;
                }
            }else{
                $responseArr['msg'] = "Sorry, but our security policy will not allow you to make another reset password request until ".DbMapperUtility::formatSqlDateTime($pwdRequest['nextTime']);  
                $responseArr['status'] = 0;
            }
        }else{
            $responseArr['msg'] = "Could not access the account associated to this email address to reset password at this time. Please contact the facility or try again later";  
            $responseArr['status'] = 0; 
        }
        session_destroy();
        $response = new Response(json_encode($responseArr));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }

}
