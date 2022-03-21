<?php

namespace Neptune;
use Symfony\Component\Config\FileLocator;

class Config {
    private static $html = NULL; 
    private static $_health = NULL; 
   
    public static $ADMIN_CONSTANT = "ADMIN";
    public static $serviceContainer = NULL;
    public static $PDF_GRADE_REPORT_DIR = "/pdfs/grade_reports/";
    public static $TWILIO_SID = "AC1ac9151ae9ada42ba2fbacebc58e22f2";
    public static $TWILIO_AUTH_TOKEN = "985091e80d0424def1d842d22f54bbc6";
    public static $TWILIO_MSG_SERVICE_ID = "MG0da5eeaed1c0292cc3c876bdf7b5423d";
    public static $S3_ACCESS_KEY = "ZV5EZ5A4X796L79F3M7N";
    public static $S3_SECRET_KEY = "QpqiEHhyT9O0CfVfuIeJEtthAwZHEsSw9Z8uEFAH";
    public static $S3_END_POINT = "us-east-1.linodeobjects.com";
    public static $S3_REGION = "us-east-1";
    public static $ELASTICSEARCH_HOST = "localhost";
    public static $ELASTICSEARCH_PORT = "9200";
    public static $KIBANA_HOST = "localhost";
    public static $KIBANA_PORT = "5602"; //Because nginx is being used to auto-login
    //public static $S3_BUCKET_NAME = "smart-bucket";
    //public static $S3_FILE_URL_PREFIX = "http://smart-bucket.us-east-1.linodeobjects.com/";
    public static $SMARTY_DIR_PREFIX="/usr/local/var/www/self-health";
    
    private function __construct() {
        
    }
    
    public static function htmHelper(){
        if(!self::$html){
            self::$html = new HtmlHelper();
        }
       return self::$html;
    }
    
    public static function healthHandler(){
        if(!self::$_health){
            self::$_health = new SmartyHealth();
        }
        return self::$_health;
    }
    
    public static function getServiceContainer(){
        $configDir = array(__DIR__.'/../');
        $locator = new FileLocator($configDir);
        self::$serviceContainer  = include($locator->locate("container.php", null, true));
        return self::$serviceContainer;
    }

}
