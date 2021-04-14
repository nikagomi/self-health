<?php

namespace Utility\Controller;

use Neptune\BaseController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;

/**
 * Description of PropertyFileController
 * @package sarms
 * @author Randal Neptune
 */
class PropertyFileController extends BaseController{
    
    private static $PROPERTY_FILE = "/../../edur.properties";
    protected $template = "utility/print/propertyFileManager.tpl";
    
    public function getFileContents(){
        $contents = [];
        $displayLines = [];
        $msg = "";
        if (file_exists(__DIR__.self::$PROPERTY_FILE)) {
            $contents = file(__DIR__.self::$PROPERTY_FILE);
            $comments = "";
            foreach($contents as $lineNumber => $content) {
                $hashPos = strpos($content,"#");
                if ($hashPos === 0) {
                    $comments .= \ltrim($content, "#") . "<br/>";
                } elseif ($hashPos !== 0 && \trim($content) != "") {
                    $codeArr = explode("=",$content, 2);
                    $value = "";
                    $noEdit = 0;
                    if(strpos($codeArr[1],"#no edit") !== false){//no edit is in the line
                        $noEdit = 1;
                        $arr = \explode("#", $codeArr[1]);
                        $value = \trim($arr[0]);
                    } else {
                        $value = \trim($codeArr[1]);
                    }
                    $displayLines[$lineNumber] = ["property" => \trim($codeArr[0]), "value" => $value, "comments" => $comments, "noEdit" => $noEdit];
                    $comments = "";
                }
            }
        }else {
            $msg = $this->html->printMessageText(false, "Could not locate the property file");
        }
        $this->_edu->assign("msg", $msg);
        $this->_edu->assign("displayLines", $displayLines);
        $this->_edu->assign("user", (new \Authentication\Model\EduUser())->getObjectById($_SESSION['userId']));
        return new Response($this->_edu->display($this->template));
    }
    
    
    public function ajaxUpdatePropertyFile(Request $request) {
        $result = false;
        $lineNumber = $request->request->get("lineNumber");
        $property = \trim($request->request->get("property"));
        $value = \trim($request->request->get("val"));
        $noEdit = (\filter_var($request->request->get("noEdit"), FILTER_VALIDATE_BOOLEAN)) ? "  #no edit" : "";
        
        if (file_exists(__DIR__.self::$PROPERTY_FILE)) {
            $contents = file(__DIR__.self::$PROPERTY_FILE);
            $contents[$lineNumber] = $property . "=" . $value . $noEdit . PHP_EOL; //reconstruct line with new value
            $bytes = file_put_contents(__DIR__.self::$PROPERTY_FILE, implode("",$contents));
            $result = (is_int($bytes) && $bytes > 0) ? true : false;
        }
        $response = new Response(json_encode($result));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }
    
    
    public function showServerStatus() {
        $user = (new \Authentication\Model\EduUser())->getObjectById($_SESSION['userId']);
        if ($user->isSystem()) {
            return new RedirectResponse("/linfo/index.php");
        } else {
            return new RedirectResponse("/access/denied");
        }
    } 
    
    public function serverOpCacheStatus() {
        $user = (new \Authentication\Model\EduUser())->getObjectById($_SESSION['userId']);
        if ($user->isSystem() || (new Authentication\Model\EduPermissionManager())->userHasPermissionAtFacility("ADMIN.OPCACHE.MANAGE", $_SESSION['userId'], $_SESSION['facilityId'])) {
            return new RedirectResponse("/opcache-gui.php");
        } else {
            return new RedirectResponse("/access/denied");
        }
    }
    
}
