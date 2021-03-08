<?php

    require_once __DIR__.'/../vendor/autoload.php';
    require_once __DIR__.'/../src/menu_config.php';

    use Neptune\EduPropertyService;
    use Neptune\MessageResources;
    use Symfony\Component\Config\FileLocator;
    use Neptune\HtmlHelper;

    session_start();
    $result = "";
    $html = new HtmlHelper();
    
    try{
        $configDir = array(__DIR__.'/../src/');
        $locator = new FileLocator($configDir);
        $sc = include($locator->locate("container.php", null, true));

        //Get user and date/time here
        $user = (new \Authentication\Model\EduUser())->getObjectById($_SESSION['userId']);
        $time = \date("Y-m-d g:i:s a");
        $details = filter_input(INPUT_POST, "details", FILTER_SANITIZE_STRING);
        $supportEmail = EduPropertyService::getProperty("admin.support.email");
        $facility = (new \Admin\Model\EduFacility())->getByFacilityCode(EduPropertyService::getProperty("facility.code"));
        $exception = \unserialize($_SESSION["exception"]);

        $userName = ($user->isIdEmpty()) ? "System (No login)" : $user->getLabel();

        $body = "Error encountered by ".$userName." at ".$time." when attempting the following: <br/>".$details."<br/><br/>";
        $body .= " <b>Error details:</b> <br/><br/>Code: ".$exception->getCode(). "<br/>Message: ".$exception->getMessage()."<br/>Line: ".$exception->getLine()."<br/>File: ".$exception->getFile();

        $event = new \Neptune\Event\MailerEvent("SARM Error", $body, array($supportEmail => "Support"), $facility->getName());
        $sc->get('event.dispatcher')->dispatch('listener.mailer',$event);

        $_SESSION["exception"] = NULL;
        $result .= $html->printMessageText(true,"Error details were successfully sent");
    }catch(\Exception $e){
        $result .= $html->printMessageText(false,"Could not submit error details. Please contact the local administrator directly.");
    }
?>
<!doctype html>
<html>
<head profile="http://www.w3.org/2005/10/profile">
    <link rel="icon" 
      type="image/png" 
      href="/images/page_icon.ico" />
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />

<script type="text/javascript" src="/js/jquery.js"></script>
<script type="text/javascript" src="/js/jquery-ui.min.js"></script>
<script type="text/javascript" src="/js/jquery.jgrowl.min.js"></script>
<script type="text/javascript" src="/js/store.min.js"></script>
<script type="text/javascript" src="/js/sarms.js"></script>

<link rel="stylesheet" type="text/css" href="/css/foundation.css" />
<link rel="stylesheet" type="text/css" href="/css/app.css" />
<link rel="stylesheet" type="text/css" href="/css/style.css" />
<link rel="stylesheet" type="text/css" href="/css/base.css" />
<link rel="stylesheet" type="text/css" href="/css/jquery-ui.min.css"/>
<link rel="stylesheet" type="text/css" href="/css/jquery-ui.theme.min.css"/>
<link rel="stylesheet" type="text/css" href="/css/jquery.jgrowl.css"/>
<link rel="stylesheet" type="text/css" href="/css/menu.css"/>



<style type="text/css">

</style>

<script type="text/javascript">

</script>


<title>
    SM@RT - Error Details
</title>

</head>

<body>
    <div id="wrap">
        <div id="header" style="text-align:left;">
            <?php echo $_SESSION['menu']; ?> 
        </div>
        <div id="main">
            <div class="row">
                <div class="medium-12 end columns" >
                    &nbsp;
                </div>
            </div>
            <div class="row">
                <div class="medium-12 end columns" >
                    <span style="font-size:1.2rem;font-variant:normal;line-height:24px;font-family:Verdana;">
                        <?php echo $result; ?>
                        <br/><br/>
                        Please note that you may continue to use other aspects of the application via the menu if available or go to the <a href="/logOut">login page</a>
                    </span>
                </div>
            </div>
            
        </div>
    </div>
    <br/><br/>
    <div id="footer">
    <div class="row text-center collapse">
        <div class="medium-6 columns medium-text-right small-text-center">
            <?php echo EduPropertyService::getProperty("app.footer.text","Copyright &copy; 2015"); ?>
        </div>
        <div class="medium-6 columns medium-text-left small-text-center">
            &nbsp; <?php echo MessageResources::i18n("footer.all.rights.reserved"); ?>
        </div>
    </div>
</div>
<br/>
    <!-- Other JS plugins can be included here -->
    <script type="text/javascript" src="/js/foundation.min.js"></script>
</body>


</html>