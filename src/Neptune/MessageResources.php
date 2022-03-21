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
            "\u00c0" =>"À",
            "\u00c1" =>"Á",
            "\u00c2" =>"Â",
            "\u00c3" =>"Ã",
            "\u00c4" =>"Ä",
            "\u00c5" =>"Å",
            "\u00c6" =>"Æ",
            "\u00c7" =>"Ç",
            "\u00c8" =>"È",
            "\u00c9" =>"É",
            "\u00ca" =>"Ê",
            "\u00cb" =>"Ë",
            "\u00cc" =>"Ì",
            "\u00cd" =>"Í",
            "\u00ce" =>"Î",
            "\u00cf" =>"Ï",
            "\u00d1" =>"Ñ",
            "\u00d2" =>"Ò",
            "\u00d3" =>"Ó",
            "\u00d4" =>"Ô",
            "\u00d5" =>"Õ",
            "\u00d6" =>"Ö",
            "\u00d8" =>"Ø",
            "\u00d9" =>"Ù",
            "\u00da" =>"Ú",
            "\u00db" =>"Û",
            "\u00dc" =>"Ü",
            "\u00dd" =>"Ý",
            "\u00df" =>"ß",
            "\u00e0" =>"à",
            "\u00e1" =>"á",
            "\u00e2" =>"â",
            "\u00e3" =>"ã",
            "\u00e4" =>"ä",
            "\u00e5" =>"å",
            "\u00e6" =>"æ",
            "\u00e7" =>"ç",
            "\u00e8" =>"è",
            "\u00e9" =>"é",
            "\u00ea" =>"ê",
            "\u00eb" =>"ë",
            "\u00ec" =>"ì",
            "\u00ed" =>"í",
            "\u00ee" =>"î",
            "\u00ef" =>"ï",
            "\u00f0" =>"ð",
            "\u00f1" =>"ñ",
            "\u00f2" =>"ò",
            "\u00f3" =>"ó",
            "\u00f4" =>"ô",
            "\u00f5" =>"õ",
            "\u00f6" =>"ö",
            "\u00f8" =>"ø",
            "\u00f9" =>"ù",
            "\u00fa" =>"ú",
            "\u00fb" =>"û",
            "\u00fc" =>"ü",
            "\u00fd" =>"ý",
            "\u00ff" =>"ÿ",
            "\u00bf" => "¿"
        );
        return strtr($valor, $utf8_ansi2);      

    }
}
