<?php

/**
 * User
 * @package hiags
 * @author Randal Neptune
 */

namespace Authentication\Model;

use Neptune\{Logger, DbMapperUtility, PropertyService, Config};

class User extends Logger {

    protected $_tableName = "users";
    protected $primaryKeyField = "user_id";
    protected $uniqueCombo = [["email"]];
    protected $uniqueComboErrorMsg = 'The supplied email already associated to another user. Please modify.';
    protected $fieldMapper = array(
        "id" => array("user_id", "T"),
        "firstName" => array("first_name", "T"),
        "lastName" => array("last_name", "T"),
        "password" => array("passwd", "T"),
        "email" => array("email", "T"),
        "contactNumber" => array("contact_number", "T"),
        "isSystem" => array("is_system", "B"),
        "lastLoginTime" => array("last_login", "D"),
        "loginAmount" => array("login_amt", "I"),
        "locked" => array("locked", "B"),
        "reset" => array("reset", "B"),
        "loginIp" => array("login_ip_address", "T"),
        "previousLoginIp" => array("previous_login_ip_address", "T"),
        "previousLogin" => array("previous_login", "D"),
        "sessionId" => array("session_id","T"),
        "lastForgotPasswordRequestTime" => array("last_forgot_password_time","D"),
        "accummulatedFailedLogins" => array("accummulated_failed_logins","I"),
        "failedLoginTime" => array("failed_login_time","D"),
        "nextLoginReferenceTime" => array("next_login_reference_time","D"),
        "timeout" => array("timeout", "I"),
        "twoFactorAuthEnabled" => array("two_factor_auth_enabled","B"),
        "twoFactorSecret" => array("two_factor_secret","T"),
        "patient" => ["patient","B"]
       
    );
    
    protected $firstName;
    protected $lastName;
    protected $password;
    protected $email;
    protected $contactNumber;
    protected $isSystem;
    protected $lastLoginTime;
    protected $loginAmount;
    protected $locked;
    protected $reset;
    protected $loginIp;
    protected $previousLoginIp;
    protected $previousLogin;
    protected $sessionId;
    protected $lastForgotPasswordRequestTime;
    protected $timeout; 
    protected $accummulatedFailedLogins;
    protected $failedLoginTime;
    protected $nextLoginReferenceTime;
    protected $twoFactorAuthEnabled;
    protected $twoFactorSecret;
    protected $patient;
    
    
    
    protected $labelSortProperty = "lastName";
    
    
    public function __construct() {
        parent::__construct();
    }

    public function getFirstName() {
        return $this->firstName;
    }

    public function getLastName() {
        return $this->lastName;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getContactNumber() {
        return $this->contactNumber;
    }

    public function displayContactNumber() {
        return $this->getContactNumber();
    }

    public function isSystem() {
        return ($this->isSystem == 1 or $this->isSystem == 't') ? (bool) true : 0;
    }

    public function getReset() {
        return ($this->reset == 1 or $this->reset == 't') ? (bool) true : 0;
    }

    public function getLastLoginTime() {
        return $this->lastLoginTime;
    }

    public function getLoginAmount() {
        return $this->loginAmount;
    }

    public function getLocked() {
        return ($this->locked == 1 || $this->locked == 't') ? (bool) true : false;
    }
    
    public function isLocked() {
        return ($this->locked == 1 || $this->locked == 't') ? (bool) true : false;
    }

    public function getLoginIp() {
        return $this->loginIp;
    }

    public function getPreviousLoginIp() {
        return $this->previousLoginIp;
    }

    public function getPreviousLogin() {
        return $this->previousLogin;
    }

    public function getSessionId() {
        return $this->sessionId;
    }

    public function getUserLocaleId() {
        return $this->userLocaleId;
    }
    
    public function getIsSystem() {
        return $this->isSystem();
    }

    public function getLastForgotPasswordRequestTime() {
        return $this->lastForgotPasswordRequestTime;
    }
    
    public function getAccummulatedFailedLogins() {
        return $this->accummulatedFailedLogins;
    }

    public function getFailedLoginTime() {
        return $this->failedLoginTime;
    }

    public function getTimeout() {
        return $this->timeout;
    }
    
    public function setTimeout($timeout) {
        $this->timeout = $timeout;
    }

    public function getNextLoginReferenceTime() {
        return $this->nextLoginReferenceTime;
    }
    
    public function getTwoFactorAuthEnabled() {
        return $this->twoFactorAuthEnabled;
    }
    
    public function isTwoFactorAuthEnabled() {
        return ($this->twoFactorAuthEnabled == 't' || $this->twoFactorAuthEnabled == 1) ? (bool) true : (bool) false;
    }

    public function setTwoFactorAuthEnabled($twoFactorAuthEnabled) {
        $this->twoFactorAuthEnabled = $twoFactorAuthEnabled;
    }
    
    public function getTwoFactorSecret() {
        return $this->twoFactorSecret;
    }
    
    public function hasTwoFactorSecret() {
        return (\trim($this->getTwoFactorSecret()) == '') ? (bool) false : (bool) true;
    }
    
    public function getPatient() {
        return $this->patient;
    }

    public function isPatient() {
        return ($this->patient == 1 || $this->patient == 't') ? (bool) true : (bool) false;
    }
    
    public function setPatient($patient) {
        $this->patient = $patient;
    }

    public function setTwoFactorSecret($twoFactorSecret) {
        $this->twoFactorSecret = $twoFactorSecret;
    }
    
    public function setAccummulatedFailedLogins($accummulatedFailedLogins) {
        $this->accummulatedFailedLogins = $accummulatedFailedLogins;
    }

    public function setFailedLoginTime($failedLoginTime) {
        $this->failedLoginTime = $failedLoginTime;
    }

    public function setNextLoginReferenceTime($nextLoginReferenceTime) {
        $this->nextLoginReferenceTime = $nextLoginReferenceTime;
    }

    public function setLastForgotPasswordRequestTime($lastForgotPasswordRequestTime) {
        $this->lastForgotPasswordRequestTime = $lastForgotPasswordRequestTime;
    }

    public function setSessionId($sessionId) {
        $this->sessionId = $sessionId;
    }

    public function setSignature($signature) {
        $this->signature = $signature;
    }

    public function setLoginIp($loginIp) {
        $this->loginIp = $loginIp;
    }

    public function setPreviousLoginIp($previousLoginIp) {
        $this->previousLoginIp = $previousLoginIp;
    }

    public function setPreviousLogin($previousLogin) {
        $this->previousLogin = $previousLogin;
    }

    public function setLocked($locked) {
        $this->locked = $locked;
    }

    public function setFirstName($firstName) {
        $this->firstName = \trim(\ucwords($firstName));
    }

    public function setLastName($lastName) {
        $this->lastName = \trim(\ucwords($lastName));
    }

    
    public function setPassword($password) {
        $this->password = $password;
    }

    public function setEmail($email) {
        $this->email = \trim(\strtolower($email));
    }

    public function setContactNumber($contactNumber) {
        $this->contactNumber = $contactNumber;
    }

    public function setIsSystem($isSystem) {
        $this->isSystem = $isSystem;
    }

    public function setReset($reset) {
        $this->reset = $reset;
    }

    public function setLastLoginTime($lastLoginTime) {
        $this->lastLoginTime = $lastLoginTime;
    }

    public function setLoginAmount($loginAmount) {
        $this->loginAmount = $loginAmount;
    }

    /**
     * get user entity by the email (which is the username).
     * @param string $email
     * @return User 
     */
    public function getByEmail($email) {
        return $this->getEntityByMultipleCriteria(["email"], [$email], TRUE);
    }

    public function getLabel() {
        return $this->getFirstName()." ".$this->getLastName();
    }

    /**
     * A list of all non-system users (is_system = false)
     * @return array
     */
    public function getNonSystemUsers() {
        return $this->getObjectsByMultipleCriteria(["isSystem"], [FALSE], TRUE, "id", $this->className, TRUE, "name");
    }
    
    public function getPatientUsers() {
        return $this->getObjectsByMultipleCriteria(["patient"], [TRUE], TRUE, "id", $this->className, TRUE, "name");
    }
    
    /**
     * Determines whether or not the forgot password request is permitted 
     * based on the consecutive interval defined in the property files.
     * @return array
     */
    public function forgotPwdRequestStatus(){
        $request = array();
        $request['permitted'] = true;
        $request['nextTime'] = \date("Y-m-d H:i:s");
        if($this->getLastForgotPasswordRequestTime() != ''){
            $qty = filter_var(PropertyService::getProperty("security.user.forgot.password.request.quantity", 1), FILTER_SANITIZE_NUMBER_INT);
            $interval = filter_var(PropertyService::getProperty("security.user.forgot.password.request.interval", "days"), FILTER_SANITIZE_STRING);
            $addToDate = "+ ".$qty." ".$interval;
            
            $timezone = PropertyService::getProperty("default.time.zone");
            $nextDate = new \DateTime($this->getLastForgotPasswordRequestTime(), new \DateTimeZone($timezone));
            $nextDate->modify($addToDate);
            
            $now = new \DateTime(\date("Y-m-d H:i:s"), new \DateTimeZone($timezone));
            
            $request['permitted'] = (\strtotime($now->format("Y-m-d H:i:s")) >= \strtotime($nextDate->format("Y-m-d H:i:s"))) ? true : false;
            $request['nextTime'] = $nextDate->format("Y-m-d H:i:s");
        }
        return $request;
    }
 
    public function getLoggedInUsers () {
        $whereClause = [
            ["classProperty" => "sessionId", "propertyValue" => "NULL", "condition" => "is not"]
        ];
        $objArr = $this->retrieveObjectsByMultipleCriteria($whereClause, true);
        return $objArr;
    }
    
    public function get2FAEnabledUsers () {
        return $this->getObjectsByMultipleCriteria(["twoFactorAuthEnabled"], [TRUE], TRUE);
    }  
    
}
