<?php


namespace Neptune;

/**
 * For the controllers that have to display a template in the browser.
 * @author randal
 */
interface HasTemplate {
    
    public function setUpTemplateVars($class, $msg);
}

?>