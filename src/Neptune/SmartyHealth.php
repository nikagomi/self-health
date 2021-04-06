<?php

namespace Neptune; 

class SmartyHealth extends \Smarty{
    public function __construct(){
	parent::__construct(); //llamando el constructor del pariente
                		
        $this->setTemplateDir("/var/www/oecs/src/smarty/templates/");
        $this->setCompileDir("/var/www/oecs/src/smarty/templates_c/");
        $this->setConfigDir("/var/www/oecs/src/smarty/configs/");
        $this->setCacheDir("/var/www/oecs/src/smarty/cache/");

        
        $this->caching = 0;
        $this->cache_lifetime = 432000;//432000; //14400
        $this->compile_check = TRUE; //must never be set to TRUE for production*/

        /* Registering classes */
        $this->registerClass("DbMapperUtility","\Neptune\DbMapperUtility");
        $this->registerClass("Config","\Neptune\Config");
        $this->registerClass("PropertyService","\Neptune\PropertyService");
        $this->registerClass("Messages","\Neptune\MessageResources");
        $this->registerClass("PermissionManager", "\Authentication\Model\PermissionManager");
        $this->registerClass("ElementTag", "\Neptune\HtmlElementTag");
        
        $this->assign('app_name','SELF-HEALTH');
    }
}



