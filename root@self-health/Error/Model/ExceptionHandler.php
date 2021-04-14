<?php

namespace Error\Model;

/**
 * Description of ExceptionHandler
 * @package sarms
 * @author Randal Neptune
 */
class ExceptionHandler {
    
    private static $exceptionPage = "errorPage.php";
    private static $handledErrors = [E_ERROR, E_COMPILE_ERROR, E_USER_ERROR, E_CORE_ERROR];
    
    private function __construct(){
        
    }
    
    public static function logException(\Error $e = null){
        if ($e !== null) {
            $ex = new \ErrorException($e->getMessage(), $e->getCode(), 1, $e->getFile(), $e->getLine());
            $_SESSION["exceptionMsg"] = $ex->getMessage();
            $_SESSION["exceptionCode"] = $ex->getCode();
            $_SESSION["exceptionFile"] = $ex->getFile();
            $_SESSION["exceptionLine"] = $ex->getLine();
            
            header("Location:/".self::$exceptionPage);
        }
        //exit();
    }
    
    
    public static function logError($num, $str, $file, $line){
       if(\in_array($num, self::$handledErrors)){
           self::logException(new \ErrorException($str, 0, $num, $file, $line));
        }else{
            return;
        }
    }
    
    /**
     * @deprecated
     * @see index.php
     */
    public static function checkForFatal(){
        $error = error_get_last();
        if ($error['type'] === E_ERROR) {
            self::logError($error["type"], $error["message"], $error["file"], $error["line"]);
        }
    }
}
