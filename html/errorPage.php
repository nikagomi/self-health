<?php
    require_once __DIR__.'/../vendor/autoload.php';
    require_once __DIR__.'/../src/menu_config.php';

    use Neptune\MessageResources;
    use Neptune\EduPropertyService;

    session_start();
    
    $exMsg = $_SESSION["exceptionMsg"];
    $exCode = $_SESSION["exceptionCode"];
    $exFile = $_SESSION["exceptionFile"];
    $exLine = $_SESSION["exceptionLine"];
?>
<!doctype html>
<html>
<head profile="http://www.w3.org/2005/10/profile">
    <link rel="icon" 
      type="image/png" 
      href="/images/page_icon.ico?v=2" />
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />

<script type="text/javascript" src="/js/jquery.js"></script>
<script type="text/javascript" src="/js/jquery-ui.min.js"></script>
<script type="text/javascript" src="/js/jquery.mask.min.js"></script>
<script type="text/javascript" src="/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/js/bootstrap-datepicker.min.js"></script>
<script type="text/javascript" src="/js/chosen.jquery.js"></script>
<script type="text/javascript" src="/js/jquery.tablesorter.min.js"></script>
<script type="text/javascript" src="/js/hintScript.js"></script>
<script type="text/javascript" src="/js/jquery.jgrowl.min.js"></script>
<script type="text/javascript" src="/js/jquery.qtip.min.js"></script>
<script type="text/javascript" src="/js/store.min.js"></script>
<script type="text/javascript" src="/js/jquery-idleTimeout.min.js"></script>
<script type="text/javascript" src="/js/moment.min.js"></script>
<script type="text/javascript" src="/js/sarms.js"></script>

<link rel="stylesheet" type="text/css" href="/css/foundation.css" />
<link rel="stylesheet" type="text/css" href="/css/dataTables.foundation.css" />
<link rel="stylesheet" type="text/css" href="/css/app.css" />
<link rel="stylesheet" type="text/css" href="/css/style.css" />
<link rel="stylesheet" type="text/css" href="/css/base.css" />
<link rel="stylesheet" type="text/css" href="/css/jquery-ui.min.css"/>
<link rel="stylesheet" type="text/css" href="/css/jquery-ui.theme.min.css"/>
<link rel="stylesheet" type="text/css" href="/css/bootstrap-datepicker.standalone.css" />
<link rel="stylesheet" type="text/css" href="/css/jquery.jgrowl.css"/>
<link rel="stylesheet" type="text/css" href="/css/chosen.css"/>
<link rel="stylesheet" type="text/css" href="/css/menu.css"/>
<link rel="stylesheet" type="text/css" href="/css/dataTables.responsive.css"/>


<style type="text/css">
    .denied{
        text-transform: uppercase;
        font-variant:small-caps;
        color:#DD0000;
        text-align:left;
        padding-top:100px;
        font-size:2rem;
        font-weight:bold;
        font-family:Helvetica;
    }
</style>

<script type="text/javascript">
    $(document).ready(function(){
        $("form#errorDetailForm").submit(function(){
            var $div = $('<div>',{class:"overlay"});
                $div.height($(document).height());
                $div.css("padding-top",$(window).height()/2+"px");
                $div.append("<img src='/images/newloader.gif'/><br/><b>Sending Error Details...</b>");
                $div.appendTo("body");
        });
    });
</script>


<title>
    SM@RT - ERROR PAGE
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
                    <span class="denied">Application Error</span><br/>
                </div>
            </div>
            <div class="row">
                <div class="medium-12 end columns" >
                    <span style="font-size:1.2rem;font-variant:normal;line-height:24px;font-family:Verdana;">
                        The application has encountered an error.
                        
                            <br/><br/>
                            <span style="font-size:1.0rem;color:#FF0000;font-family:courier;"> 
                                <?php 
                                    if(filter_var(EduPropertyService::getProperty("show.error.message.content", false), FILTER_VALIDATE_BOOLEAN)){
                                        echo "<b>Message:</b>&nbsp;".$exMsg."<br/><b>File:</b>&nbsp;".$exFile."<br/><b>Line #:</b>&nbsp;".$exLine; 
                                    }else{
                                        echo "<b>Sorry, but an error has occurred. <br/>We are truly sorry for this incovenience and would be grateful if you could provide some details</b>.";
                                    }    
                                ?>
                            </span>
                        
                        <br/><br/>
                        In order for the developers to suitable address this error, please provide the 
                        details of what you were trying to do when the error occurred <i><b> (please provide as much detail as possible)</b></i>. 
                        <br/><br/>
                        Please note that you may submit the error details or choose continue to use other aspects of the application via the menu if available.
                        <br/><br/>If details for this error have already been submitted, please do not submit it again. 
                        <br/>Thank you.
                    </span>
                </div>
            </div>
            <div>
                <form data-abide name="errorDetailForm" id="errorDetailForm" action="processException.php" method="POST" autocomplete="off">
                    <div class="row">
                        <div class="medium-6 end columns" >
                            <label>
                                <span class="required">Details:</span>
                                <textarea name="details" id="details" wrap="physical" cols="30" rows="8" required></textarea>
                            </label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="medium-6 end columns" >
                            <label>
                                <input type="submit" name="submit" value="Submit" class="button"/>
                            </label>
                        </div>
                    </div>
                </form>
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
    <script type="text/javascript" src="/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="/js/dataTables.responsive.min.js"></script>
    <script type="text/javascript" src="/js/dataTable.foundation.js"></script>
    <script type="text/javascript" src="/js/foundation.abide.js"></script>
    <script type="text/javascript" src="/js/foundation.equalizer.js"></script>
    <script type="text/javascript" src="/js/foundation.accordion.js"></script>
       
</body>


</html>

