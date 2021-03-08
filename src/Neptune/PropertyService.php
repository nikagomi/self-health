<?php

namespace Neptune;

/**
 * PropertyService: Read property values from property file
 * @package hiags
 * @author Randal Neptune
 */
class PropertyService {
 
    private static $PROPERTY_FILE = "/../health.properties"; 
    
    
    private function __construct(){
         
    }
    
    public static function getProperty($property, $default = true){
        
        $fp = fopen(__DIR__.self::$PROPERTY_FILE,"r");
        if($fp){
            while(!feof($fp)){
                $line = trim(fgets($fp, 1024));
                $hashPos = strpos($line,"#");
                if($hashPos !== 0){//A comment if first character is pound sign
                   $codeArr = @explode("=",$line, 2); 
                    if (strtoupper(trim($codeArr[0])) == strtoupper($property)) {
                        $value = "";
                        if (strpos($codeArr[1],"#no edit") !== false) {//no edit is in the line
                            $noEdit = explode("#", $codeArr[1]);
                            $value = trim($noEdit[0]);
                        } else {
                            $value = trim($codeArr[1]);
                        }
                        fclose($fp);
                        return $value;
                    }
                }
            }
            return $default;
        }else{
            throw new \Exception("Cannot locate requested property", 5001);//property file cannot be opened.
        }
    }
    
    public static  function getBoolean($property) {
        return \filter_var(self::getProperty($property), FILTER_VALIDATE_BOOLEAN);
    }
}
