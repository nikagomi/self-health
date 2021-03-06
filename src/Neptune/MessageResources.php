<?php

namespace Neptune;

/**
 * Internationalization class: converts message keys to text
 * @package sarms
 * @author Randal Neptune
 */
class MessageResources {
    private static $resource = NULL;
    private static $countryCode = NULL;
    private static $defaultLang = NULL;
    private static $countryMessageFile = NULL;
    private static $messageFile = NULL;
    
    
    private function __construct() {
        
    }
    
    public static function i18n($messageKey){
        
        self::$messageFile = Config::$SMARTY_DIR_PREFIX."/src/locales/messages_en_US.properties";
       
        $fp = fopen(self::$messageFile,"r");
        if($fp){
            while(!feof($fp)){
                $line = trim(fgets($fp, 1024));
                $hashPos = strpos($line,"#");
                if($hashPos !== 0){//A comment if first character is pound sign
                   $codeArr = explode("=", $line, 2); 
                   if(\strtoupper(trim($codeArr[0])) == \strtoupper($messageKey)){
                        $value = trim($codeArr[1]);

                        fclose($fp);
                        return $value;
                   }
                }
            }
            return "***".$messageKey."***";
        } else{
            throw new \Exception("Cannot locate message resource file ", 5002);//message file cannot be opened.
        }
        
    }
    
    /**
     * 
     * @param string $messageKey
     * @param string $paramStr comma separated list
     * @return string
     * @throws \Exception
     */
    public static function i18nParams($messageKey, $paramStr){
        
        self::$messageFile = Config::$SMARTY_DIR_PREFIX."/src/locales/messages_en_US.properties";
        
        $fp = fopen(self::$messageFile,"r");
        if($fp){
            while(!feof($fp)){
                $line = trim(fgets($fp, 1024));
                $hashPos = strpos($line,"#");
                if($hashPos !== 0){//A comment if first character is pound sign
                   $codeArr = explode("=", $line, 2); 
                   if(strtoupper(trim($codeArr[0])) == strtoupper($messageKey)){
                        $value = trim($codeArr[1]);
                        fclose($fp);

                        if(\trim($paramStr) != ""){
                            //Get matches for placeholders
                            $matches = [];
                            $numbers = [];
                            $params = explode(",", $paramStr);
                            if(($amt = preg_match_all("/\{([0-9]+)\}/", $value, $matches)) > 0){
                                for($i = 0; $i < $amt; $i++){
                                    array_push($numbers, \intval($matches[1][$i]));
                                }
                                sort($numbers, SORT_NUMERIC);

                                //First make sure the numbers in the message resource are in correct order
                                if($numbers[\count($numbers)-1] == (\count($params) - 1)){
                                    foreach($numbers as $num){
                                        $placeholder = "{".$num."}";
                                        $value = str_replace($placeholder, \trim($params[$num]), $value);
                                    }
                                }else{
                                  //Params and placeholders don't match  
                                   throw new \Exception("MessageResources: Number of parameters provided and placeholders don't match", 5003);
                                }
                            } 
                        }
                        return $value;
                    }
                }
            }
            return "***".$messageKey."***";
        }else{
            throw new \Exception("Cannot locate message resource file ", 5002);//message file cannot be opened.
        }
      
        
    }
    
    public static function utf8_ansi($valor='') {
        $utf8_ansi2 = array(
            "\u00c0" =>"??",
            "\u00c1" =>"??",
            "\u00c2" =>"??",
            "\u00c3" =>"??",
            "\u00c4" =>"??",
            "\u00c5" =>"??",
            "\u00c6" =>"??",
            "\u00c7" =>"??",
            "\u00c8" =>"??",
            "\u00c9" =>"??",
            "\u00ca" =>"??",
            "\u00cb" =>"??",
            "\u00cc" =>"??",
            "\u00cd" =>"??",
            "\u00ce" =>"??",
            "\u00cf" =>"??",
            "\u00d1" =>"??",
            "\u00d2" =>"??",
            "\u00d3" =>"??",
            "\u00d4" =>"??",
            "\u00d5" =>"??",
            "\u00d6" =>"??",
            "\u00d8" =>"??",
            "\u00d9" =>"??",
            "\u00da" =>"??",
            "\u00db" =>"??",
            "\u00dc" =>"??",
            "\u00dd" =>"??",
            "\u00df" =>"??",
            "\u00e0" =>"??",
            "\u00e1" =>"??",
            "\u00e2" =>"??",
            "\u00e3" =>"??",
            "\u00e4" =>"??",
            "\u00e5" =>"??",
            "\u00e6" =>"??",
            "\u00e7" =>"??",
            "\u00e8" =>"??",
            "\u00e9" =>"??",
            "\u00ea" =>"??",
            "\u00eb" =>"??",
            "\u00ec" =>"??",
            "\u00ed" =>"??",
            "\u00ee" =>"??",
            "\u00ef" =>"??",
            "\u00f0" =>"??",
            "\u00f1" =>"??",
            "\u00f2" =>"??",
            "\u00f3" =>"??",
            "\u00f4" =>"??",
            "\u00f5" =>"??",
            "\u00f6" =>"??",
            "\u00f8" =>"??",
            "\u00f9" =>"??",
            "\u00fa" =>"??",
            "\u00fb" =>"??",
            "\u00fc" =>"??",
            "\u00fd" =>"??",
            "\u00ff" =>"??",
            "\u00bf" => "??"
        );
        return strtr($valor, $utf8_ansi2);      

    }
}
