<?php

namespace Authentication\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Neptune\{DbMapperUtility, Config, PropertyService, HtmlHelper};
use Twilio\Rest\Client;

/**
 * Description of UserController
 * @package sarms
 * @author randal
 */
class UserController extends \Neptune\BaseController{
    protected $modelClass = "\Authentication\Model\User";
    protected $template = "security/user.tpl";
    private $actionPage = "/security/user/save";
    
    public function ajaxGetName($id){
        $usr = (new $this->modelClass())->getEntityById($id);
        $response = new Response($usr->convertObjectToJsonArray());
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }
    
    public function delete($id) : Response {
        $obj = (new $this->modelClass())->getEntityById($id); 
        $obj->delete();
        $msg .= $this->html->printMessageText($obj->getOpStatus(), $obj->getOpMessage());
        if ($obj->getOpStatus()) {
            $obj->clear();
        }
        
        $this->setUpTemplateVars($obj, $msg);
        return new Response($this->_health->display($this->template));
    }

    
    public function edit(Request $request, $id){
        $usrEdit = (new $this->modelClass())->getEntityById($id);
        $currentUsr = (new $this->modelClass())->getEntityById($_SESSION['userId']);
        if($usrEdit->isSystem() && !$currentUsr->isSystem()){
            $msg = $this->html->printMessageText(false,"You do not have permission to edit the selected user account");
            $this->setUpTemplateVars(new $this->modelClass(), $msg);
            return new Response($this->_health->display($this->template));
        }  else{
            if ($currentUsr->getId() == $usrEdit->getId() && !$currentUsr->isSystem()) {
                $msg = $this->html->printMessageText(false,"You cannot edit your own user account from this screen");
                $this->setUpTemplateVars(new $this->modelClass(), $msg);
                return new Response($this->_health->display($this->template));
            } else {
                return parent::edit($request, $id);
            }
        }
    }
    
    public function save(Request $request){
        $user = new $this->modelClass();
        $pwd = DbMapperUtility::generateRandomPassword();
        /** Work with the password **/
        if($request->request->get("id") != ''){//an update
            $tmpUsr = (new $this->modelClass())->getEntityById($request->request->get("id"));
            $dbPasswd = $tmpUsr->getPassword();
            $dbReset = $tmpUsr->getReset();
            $tmpUsr->mapFormToEntity($request->request);
            if (!$request->request->has("locked")) {
                $tmpUsr->setLocked(false);
            }
            if (!$request->request->has("isSystem")) {
                $tmpUsr->setIsSystem(false);
            }
            if($request->request->get("password") != $dbPasswd){//password has changed
                $hash = password_hash($request->request->get("password"), PASSWORD_BCRYPT);
                $tmpUsr->setPassword($hash);
                $tmpUsr->setReset(true);
                $tmpUsr->setFailedLoginTime("");
                $tmpUsr->setAccummulatedFailedLogins(0);
                $tmpUsr->setNextLoginReferenceTime("");
            }else{
                $tmpUsr->setPassword($dbPasswd);
                $tmpUsr->setReset($dbReset);
            }
            $user = $tmpUsr;
        }else{// a new insert
            
            $user->mapFormToEntity($request->request);
            //Go ahead and store new password
            $hash = password_hash($pwd, PASSWORD_BCRYPT);
            $user->setAccummulatedFailedLogins(0);
            $user->setPassword($hash);
            $user->setReset(true);
        }
       
        $user->pushObjectToDB(true);     
        $msg = $this->html->printMessageText($user->getOpStatus(),$user->getOpMessage());       
        if($user->getOpStatus()){
            //$permArr = (!\is_null($request->request->get("perm"))) ? $request->request->get("perm") : [];
            $grpArr = (!\is_null($request->request->get("grp"))) ? $request->request->get("grp") : [];
            $slArr = (!\is_null($request->request->get("sln"))) ? $request->request->get("sln") : [];
            //print_r($slArr);
            
            /*$result = (new \Authentication\Model\UserPermission())->assignPermissions($user->getId(), $permArr);
            $tmpMsg1 = ($result) ? "The permissions were successfully updated." : "The permissions could not be updated.";
            $msg .= $this->html->printMessageText($result, $tmpMsg1);*/
            
            $result1 = (new \Authentication\Model\UserGroup())->assignGroups($user->getId(), $grpArr);
            $tmpMsg = ($result1) ? "The groups were successfully updated." : "The groups could not be updated.";
            $msg .= $this->html->printMessageText($result1, $tmpMsg);
            
            $result2 = (new \Admin\Model\UserServiceLocation())->assignServiceLocations($user->getId(), $slArr);
            $tmpMsg2 = ($result2) ? "The service locations were successfully updated." : "The service locations could not be updated.";
            $msg .= $this->html->printMessageText($result2, $tmpMsg2);
           
            if($request->request->get("id") == ''){
                //Send email to notify new user
                $emailSent = $this->generateNewUserEmailNotification($user, $pwd);
                $emailSentMsg = ($emailSent) ? "User was notified via email." : "Could not notify user via email.";
                $msg .= $this->html->printMessageText($emailSent, $emailSentMsg);
                if ($emailSent && $user->isContactMobile()) {
                    $this->sendSMS($user);
                }
            }
            
            $user->clear(); 
        }else{
            $user->setPassword("");
        }
        $this->setUpTemplateVars($user, $msg);
        return new Response($this->_health->display($this->template));
    }
    
    protected function setUpTemplateVars($obj, $msg = ''){
        $this->_health->assign('user',$obj);
        $this->_health->assign('categories',(new \Authentication\Model\MenuCategory())->getAllOrderBy('name', 'ASC'));
        
        $this->_health->assign('prm',new \Authentication\Model\Permission());
        $this->_health->assign('selectedPerms',(new \Authentication\Model\UserPermission())->getPermissionsIdsByUserId($obj->getId()));

        $this->_health->assign('groups',  DbMapperUtility::convertObectArrayToCheckBoxArray((new \Authentication\Model\Group())->getAllOrderBy("name")));
        $this->_health->assign('selectedGrps',(new \Authentication\Model\UserGroup())->getGroupIdsByUserId($obj->getId()));

        $this->_health->assign('yesNo',array("" => "","1"=>"Yes", "0" =>"No"));
        
        $currentUser = (new \Authentication\Model\User())->getEntityById($_SESSION['userId']);
        $this->_health->assign('currentUser',$currentUser);
        
        if($currentUser->isSystem()){
            $this->_health->assign('list',$obj->getAll());
        }else{
           $this->_health->assign('list',$obj->getNonSystemUsers()); 
        }
        $this->_health->assign('msg',$msg, true);
        $this->_health->assign('userGroup', new \Authentication\Model\UserGroup());
        $this->_health->assign('html',$this->html);
        $this->_health->assign('actionPage',$this->actionPage);
        $this->_health->assign('title','Manage Users');
        
    }
    
    public function TFASetup ($user) {
        $qrcProvider = new \Utility\Model\QRCodeProvider();
        $tfa = new \RobThree\Auth\TwoFactorAuth("SLFHH", 6, 30, 'sha1', $qrcProvider);
        
        if (!$user->isTwoFactorAuthEnabled()) {
            $secret = $tfa->createSecret(160);
            $user->setTwoFactorSecret($secret);
            $user->update();
            $this->_health->assign("hasSecret", $user->getOpStatus());
            $this->_health->assign("secret", $secret);
        } else {
            $this->_health->assign("hasSecret", true);
            $this->_health->assign("secret", $user->getTwoFactorSecret());
        }
        $this->_health->assign('tfa', $tfa);
    }
    
    public function disableTFA (Request $request) {
        $sql = '';
        $user = (new \Authentication\Model\User())->getObjectById($request->request->get('userId'));
        $user->setTwoFactorAuthEnabled(FALSE);
        $user->setTwoFactorSecret('');
        
        $sql .= $user->generateUpdateWithEmptyFieldsSql();
        
        //Now get rid of backup code
        $bkCode = (new \Authentication\Model\TwoFAUserBackupCode())->nextAvailableCode($user->getId());
        
        $sql .= $bkCode->generateDeleteSql();
        $trans = "BEGIN TRANSACTION; ". $sql. " COMMIT;";
        $result = (DbMapperUtility::dbQuery($trans) == true);
        
        $response = new Response(json_encode($result));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
        
    }
    
    public function getPreferences(){
        $user = (new $this->modelClass())->getObjectById($_SESSION['userId']);
        
        $this->_health->assign("user",$user);
        $this->_health->assign('msg','');
        $this->_health->assign('html',$this->html);
        $this->_health->assign('actionPage',"/security/user/preferences/save");
        $this->_health->assign('title','User Preferences');
        $this->TFASetup($user);
        
        return new Response($this->_health->display("security/preferences.tpl"));
    }
    
    
    public function updatePreferences(Request $request){
        $user = (new $this->modelClass())->getObjectById($request->request->get("id"));
        $msg = '';
        if($request->request->get("email") != ''){
            
            $user->setEmail($request->request->get("email"));
            $user->setContactNumber($request->request->get("contactNumber"));
            $user->setTwoFactorAuthEnabled($request->request->get("twoFactorAuthEnabled"));
            $user->update();
            if($user->getOpStatus()){
                $txt = ($user->getOpStatus()) ? "Preferences successfully updated." : "Could not update your preferences. Please contact the Administrator";
                $msg = HtmlHelper::composeToastMessage([$user->getOpStatus() => $txt]);
            }
        }elseif($request->request->get("newPassword") != ""){
            //check the current password
            if(password_verify($request->request->get("currentPassword"), $user->getPassword())) {
                $user->setPassword(password_hash($request->request->get("newPassword"),PASSWORD_BCRYPT));
                $user->update();
                $txt = ($user->getOpStatus()) ? "Password successfully updated. Please use new password the next time you log in" : "Could not update password. Please contact the Administrator";
                $msg = HtmlHelper::composeToastMessage([$user->getOpStatus() => $txt]);
            }else{
                $msg = HtmlHelper::composeToastMessage([false => "The current password is incorrect. Please try again."]);
                $user->setOpStatus(false);
            }
        }
        
        $this->_health->assign("user", $user);
        $this->_health->assign('msg', $msg);
        $this->_health->assign('html', $this->html);
        $this->_health->assign('actionPage',"/security/user/preferences/save");
        $this->_health->assign('title','User Preferences');
        $this->TFASetup($user);
        return new Response($this->_health->display("security/preferences.tpl"));
    }
    
    
    
    public function enableTFA (Request $request){
        /*$request = Request::create(
            '/enable/tfa',
            'POST',
            array('userId' => 'SRM1', 'code' => '111111')
        );*/
        $result = [];
        $status = false;
        $msg = '';
        $user = (new $this->modelClass())->getObjectById($request->request->get('userId'));
        $code = $request->request->get("code");
        $secret = $user->getTwoFactorSecret();
        
        //echo $userId." -> ".$code." -> ".$secret;
        
        $qrcProvider = new \Utility\Model\QRCodeProvider();
        $tfa = new \RobThree\Auth\TwoFactorAuth("SLFHH", 6, 30, 'sha1', $qrcProvider);
        
        $verify = $tfa->verifyCode($secret, $code, 2);
        if ($verify) {
            $user->setTwoFactorAuthEnabled($verify);
            $user->update();
            $status = $user->getOpStatus();
            if ($status) {
                $bkupCode = new \Authentication\Model\TwoFAUserBackupCode();
                $msg .= "Two factor authentication successfully enabled.";
                if (!$bkupCode->isCodeAvailable($user->getId())) {
                    //create 1 backup code for the user
                    $bkup = new \Authentication\Model\TwoFAUserBackupCode();
                    $bkup->setUserId($user->getId());
                    $bkup->setBackupCode(DbMapperUtility::generate2FABackupCode());
                    $bkup->setSortOrder(1);
                    $bkup->setUsed(FALSE);
                    $bkup->save();
                    if ($bkup->getOpStatus()) {
                        //send email
                        $transport = $this->serviceContainer()->get('mail.transport');
                        
                        $codeDisplay = implode("-", str_split($bkup->getBackupCode(), 4));
                        try{

                            $mailer = new \Swift_Mailer($transport);
                            $message = (new \Swift_Message("Self-Health Reporting Two Factor Authentication Backup Code"))
                                ->setFrom(array($transport->getUsername() => " Self-Health Tracker"));
                            $message->setTo(array($user->getEmail() => $user->getLabel()));

                            $bodyText = "Dear ".$user->getLabel().",";
                            $bodyText .= "<br/><br/>You are receiving this email because you enabled two factor authentication for your user account.";
                            
                            $bodyText .= "<br/><br/>";
                            $bodyText .= "Your backup code is: <b>".$codeDisplay."</b><br/><br/>";
                           
                            $bodyText .= "Please keep your backup code in a safe location. The backup code is to be used in the event ";
                            $bodyText .= "that you have lost/misplaced your mobile device and/or cannot access the authenticator app.<br/><br/> ";
                            $bodyText .= "Once used, the backup code will become invalid and two factor authentication will be disabled until re-enabled by you.";
                            $bodyText .= "<br/><br/>";
                            
                            $bodyText .= "<i><b>Please do not reply to this email address as it is not monitored.</b></i>";
                            $bodyText .= "<br/><br/>";

                            $bodyText .= '<span style="color:#888;">----------<br/>';
                            $bodyText .= "This e-mail and any attachments may contain confidential and privileged information.";
                            $bodyText .= "If you are not the intended recipient, please notify the sender immediately at telephone: ".\Neptune\PropertyService::getProperty("helpdesk.contact.number", "(555) 555-5555").", ";
                            $bodyText .= "delete this e-mail and destroy any copies. Any dissemination or use of this information by a person other ";
                            $bodyText .= "than the intended recipient is unauthorized and may be illegal.";

                            $message->setBody($bodyText, "text/html");
                            $cnt = $mailer->send($message);
                            $msg .= ($cnt > 0) ? "\nYour backup code was sent to the email address that you have on file (Please review your SPAM/JUNK folder)." : "\nCould not send the backup code via email.\nPlease record your backup code: ".$bkup->getBackupCode()." and store it in a safe and reaily accessible place";
                        } catch (\Exception $e) {
                            $msg .= "\nCould not send the backup code via email.\nPlease record your backup code: ".$bkup->getBackupCode()." and store it in a safe and reaily accessible place";

                        }
                    }
                }
            }
        } else {
            $msg .= "Could not verify entered code. Please scan and try again.";
        }
        $result['status'] = $status;
        $result['msg'] = $msg;
        $response = new Response(json_encode($result));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }
    
    
    public function verifyPassword (Request $request){
        $status = false;
        $user = (new $this->modelClass())->getObjectById($request->request->get('userPwdId'));
        $pwd = \trim($request->request->get("pwd"));
        
        if(password_verify($pwd, $user->getPassword())){
            $status = true;
        }
        $response = new Response(json_encode($status));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }
    
    public function retrieveLoggedInUsers () {
       
        $this->_health->assign("loggedUsersList",(new \Authentication\Model\User())->getLoggedInUsers());
        $this->_health->assign("now", \date('Y-m-d H:i:s'));
        $this->_health->assign('title','Logged In Users');
        return new Response($this->_health->display("utility/admin/loggedInUsers.tpl"));
    }
    
    public function retrieve2FAEnabledUsers () {
        $this->_health->assign("list", (new \Authentication\Model\User())->get2FAEnabledUsers());
        $this->_health->assign('title','Two Factor Enabled Users');
        $this->_health->assign('html',$this->html);
        return new Response($this->_health->display("utility/admin/tfaUsers.tpl"));
    }
   
    private function generateNewUserEmailNotification($usr, $passwd){
        $extUrl = PropertyService::getProperty("ext.app.url");
        
        $bodyText = "Dear ".$usr->getLabel().",";
        $bodyText .= "<br/><br/>A new user account has been created for you for the Self-Health Reporting Application.";
       
        $bodyText .= "<br/><br/>";
        $bodyText .= "To login to the application please go to <a href='".$extUrl."'>".$extUrl."</a> in your web browser on your mobile phone or computer.<br/>";
        $bodyText .= "<br/>Your log-in credentials are as follows: <br/>";
        $bodyText .= "Email: <b>".$usr->getEmail()."</b><br/>";
        $bodyText .= "Password: <b style='font-family:courier;'>".$passwd."</b>";
        $bodyText .= "<br/><br/>";
        $bodyText .= "Please log-in with the above credentials after which you will be required to change your password.";
        $bodyText .= "<br/><br/>";
        $bodyText .= '<i><span style="font-size:12px;font-weight:bold;color:#333;">Please do not reply to this email address as it is not monitored.';
        $bodyText .= "<br/>If you have any queries, please contact the application help desk ";
        $bodyText .= "at: " . \Neptune\PropertyService::getProperty("helpdesk.contact.number", "(555) 555-5555") . "</span></i>";
        $bodyText .= "<br/><br/>";

        $bodyText .= '<span style="color:#888;">----------<br/>';
        $bodyText .= "This e-mail and any attachments may contain confidential and privileged information.";
        $bodyText .= "If you are not the intended recipient, please notify the sender immediately at telephone: ".\Neptune\PropertyService::getProperty("helpdesk.contact.number", "(555) 555-5555").", ";
        $bodyText .= "delete this e-mail and destroy any copies. Any dissemination or use of this information by a person other ";
        $bodyText .= "than the intended recipient is unauthorized and may be illegal.</span>";
        
        
        $transport = Config::getServiceContainer()->get('mail.transport');
        try {
            $mailer = new \Swift_Mailer($transport);
            $message = (new \Swift_Message("New user account created"))
            ->setFrom(array($transport->getUsername() => "Self Health Reporting"));

            $countSent = 0;
            
            try{
                $message->setBody($bodyText, "text/html");
                $message->setTo(array($usr->getEmail() => $usr->getLabel()));
                $countSent += $mailer->send($message);
            } catch (\Swift_SwiftException $sex) {
                throw new \Exception($sex->getMessage());
            }
            
        }catch(\Swift_RfcComplianceException $rfc){
            $msg .= "Sorry, could not send emails. Please check mail server settings";
        }catch(\Swift_TransportException $te){
            $msg .= "Sorry, could not send emails. Please check mail server settings";
        }
        
        return ($countSent == 0) ? false : true;
    }
    
    
    public function checkRegistrationCapture(Request $request) {
        /*$request = Request::create(
            '/user/registration/capture/check',
            'POST',
            array('captchaText' => 'SABCDEF')
        );*/
        $captcha = \trim($request->request->get("captchaText"));
        $captchaValid = ($captcha == $_SESSION['captcha_text']) ? true: false;
        $response = new Response(json_encode($captchaValid ));
        $response->headers->set('Content-Type', 'application/json');
        return $response;    
    }
    
    public function registerPatientUser (Request $request) {
        //throw  new Exception("I got here");
        /*$request = Request::create(
            '/register/user',
            'POST',
            array('regEmail' => 'randal.neptune@slaspa.com', 'regFirstName' => 'John', 'regLastName' => 'Doe', 'countryId' => 'SRM1', 'genderId' => 'SRM1', 'regDob' => 'Jun 13, 1981')
        );*/
        $usr = (new \Authentication\Model\User());
        $usr->setPatient(TRUE);
        $usr->setFirstName($request->request->get("regFirstName"));
        $usr->setLastName($request->request->get("regLastName"));
        $usr->setEmail($request->request->get("regEmail"));
        
        //Generate random password
        $randomPasswd = DbMapperUtility::generateRandomPassword();
        //Go ahead and store new password
        $hash = password_hash($randomPasswd, PASSWORD_BCRYPT);
        $usr->setAccummulatedFailedLogins(0);
        $usr->setPassword($hash);
        $usr->setReset(true);
        $usr->setTimeout(20);
        
        $_SESSION['userId'] = 'SRM2';
        $usr->save();
        if ($usr->getOpStatus()) {
            
            $emailSent = $this->generateNewUserEmailNotification($usr, $randomPasswd);
            $emailSentMsg = ($emailSent) ? "Your account was successfully created.<br/>Please check your email: <b>".$usr->getEmail()."</b> for your login credentials." : "Registration failed. Please contact ".\Neptune\PropertyService::getProperty("app.helpdesk.contact", "(555) 555-5555")." for assistance.";
            //$msg = HtmlHelper::toastWrapperStart() . HtmlHelper::generateToast($emailSent, $emailSentMsg) . HtmlHelper::toastWrapperEnd();
            $msg = (new HtmlHelper())->printMessageText($emailSent, $emailSentMsg);
        
        
            $dobObj = \DateTime::createFromFormat("M d, Y", $request->request->get("regDob"));
            $now = \date("Y-m-d H:i:s");
            
            $patient = new \Patient\Model\Patient();
            $patient->setFirstName($request->request->get("regFirstName"));
            $patient->setLastName($request->request->get("regLastName"));
            $patient->setCountryId($request->request->get("regCountryId"));
            $patient->setGenderId($request->request->get("regGenderId"));
            $patient->setUserId($usr->getId());
            $patient->setDateOfBirth($dobObj->format("d/m/Y"));
            $patient->setCreatedById($usr->getId());
            $patient->setModifiedById($usr->getId());
            $patient->setModifiedTime($now);
            $patient->setCreatedTime($now);
            
            $patient->save();
        } else {
            $msg = (new HtmlHelper())->printMessageText(false, "An error occurred. Could not complete registration at this time. Please try again later.");
        }
        
        //Redirect to login page
        $this->_health->assign('actionPage','/login');
        $this->_health->assign('msg', $msg);
        $this->_health->assign('userName', $usr->getEmail());
        $this->_health->assign('html', $this->html);
        $this->_health->assign("genderIds", DbMapperUtility::convertObjectArrayToDropDown((new \Admin\Model\Gender())->getAllOrderBy("name")));
        $this->_health->assign("countryIds", DbMapperUtility::convertObjectArrayToDropDown((new \Admin\Model\Country())->getAllOrderBy("name")));
        session_destroy();
        $response = new Response($this->_health->display('start/login.tpl'));
        return $response;
        
    }
    
}
