<?php
/* Smarty version 3.1.34-dev-7, created on 2021-03-09 17:17:46
  from '/var/www/oecs/src/smarty/templates/start/login.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_6047adba1540c9_59589436',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '92738a5c02663ddf1e5917355498cc5f5cad09c3' => 
    array (
      0 => '/var/www/oecs/src/smarty/templates/start/login.tpl',
      1 => 1615310263,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6047adba1540c9_59589436 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'/var/www/oecs/vendor/smarty/smarty/libs/plugins/function.html_options.php','function'=>'smarty_function_html_options',),));
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head profile="http://www.w3.org/2005/10/profile">
    <link rel="icon" 
      type="image/png" 
      href="/images/Slaspa_Logo_h-w.ico" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>

<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<noscript>
  <style>html{display:none;}</style>
  <meta http-equiv="refresh" content="0.0;url=/nojs.html">
</noscript>

<title>Self-Health Tracker</title>
<?php echo '<script'; ?>
 type="text/javascript" src="/js/hintScript.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" src="/js/jquery.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" src="/js/jquery-ui.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" src="/js/jquery.simplemodal.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" src="/js/jquery.complexify.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" src="/js/jquery.qtip.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" src="/js/smart.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" src="/js/fontawesome-all.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" src="/js/chosen.jquery.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" src="/js/bootstrap.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" src="/js/bootstrap-datepicker.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" src="/js/bootstrap-timepicker.min.js"><?php echo '</script'; ?>
>

<link rel="stylesheet" type="text/css" href="/css/foundation.css" />
<link rel="stylesheet" type="text/css" href="/css/app.css?1002" />
<link rel="stylesheet" type="text/css" href="/css/style.css?1000" />
<link rel="stylesheet" type="text/css" href="/css/base.css?1000" />

<link rel="stylesheet" type="text/css" href="/css/jquery.qtip.min.css"/>
<link rel="stylesheet" type="text/css" href="/css/bootstrap-datepicker.standalone.css" />
<link rel="stylesheet" type="text/css" href="/css/bootstrap-timepicker.min.css" />
<link rel="stylesheet" type="text/css" href="/css/chosen.css"/> 

<style type="text/css">
    
        
        .modalHeader{
            background-color:#ffc42c; 
            color:#464646; 
            font-size:1.2rem; 
            line-height:1.4rem;
            font-weight:bold;
            height:40px; 
            padding-top:3px;
            font-family:'Poppins', sans-serif;;
            vertical-align: middle;
            font-variant:small-caps;
            border-radius: 0px;
            padding-bottom:3px;
            padding-top:8px;
        }
        
        .close {
            background: #444444;
            color: #FFFFFF;
            line-height: 25px;
            position: absolute;
            right: -12px;
            text-align: center;
            top: -10px;
            width: 24px;
            text-decoration: none;
            font-weight: bold;
            border-radius: 12px;
            -webkit-border-radius: 12px;
            -moz-border-radius: 12px;
            box-shadow: 1px 1px 3px #000000;
            -webkit-box-shadow: 1px 1px 3px #000000;
            -moz-box-shadow: 1px 1px 3px #000000;
            font-family: sans-serif arial helvetica;
        }
        
        .instructions{
            font-family:'Trebuchet MS';
            font-size:14px;
            color:#506070;
            text-align:justify;
            line-height:21px;
            padding:0px 3px;
            font-weight:normal;
            margin-top:10px;
        }

        span#capsLock{
            color:#CC3333;/*#569fD9*/
            font-weight:normal;
            font-family: Arial;
            font-size: 1.0rem;
            text-transform:none;
            text-align: right;
        }
        
        #complexityContainer{
            width: 180px;
            height:35px;
            border: 1px solid #AAA;
            padding:0px;
            color:#444;
            font: "Arial";
            background-image:url('/images/stripped_background.png');
        }
        #complexity{
            font-weight: bold;
            font-size: 1rem;
            padding-top: 8px;
            height: 100%;
            margin:0px;
        }
        
        #header2 span{
            color:#444444;
            font-weight:normal;
            font-size:1.0rem;
            background-color:#FFFFFF;
            font-family: 'Poppins', sans-serif;
            font-variant:normal;
        }
        
        .forgotPassword{
            font-size:0.9rem;
        }
        
        input[type="text"]{
            height: 40px !important;
        }
        
        
        
        input[type="email"].login, input[type="password"].login{
            background: transparent;
            border-bottom: 1px solid #464646;
            border-top: none;
            border-left: none;
            border-right: none;
            background-image:none;
            box-shadow: none;
            font-size: 1.1rem;
            margin: 0 0 0 0 !important;
            padding: 0px !important;
            height: 30px;
            color: #464646;
            font-weight: 500;
            font-family: 'Poppins', sans-serif;
        }
        
        .error input[type="email"].login, .error input[type="password"].login {
             border-bottom: 1px solid #DD0000 !important;
             color: #DD0000;
        }
        
        .err {
            color:#FF0000;
            font-family: 'Poppins', sans-serif;
            font-size:0.9rem;
        }
        
        .error span {
            /*color: #ff8080 !important;*/
        }
        
        /*To style the placeholder text*/
        ::-webkit-input-placeholder {
            
        }

        :-moz-placeholder { /* Firefox 18- */

        }

        ::-moz-placeholder {  /* Firefox 19+ */

        }

        :-ms-input-placeholder {  

        }
        
        /*.simplemodal-container {
                width: 400px;
            }
        
        @media only screen and (max-width: 40em) { 
            .simplemodal-container {
                width: 90%;
            }
        }*/
    
</style>

<?php echo '<script'; ?>
 type="text/javascript">
  
    var scaleFactor = <?php echo \Neptune\PropertyService::getProperty("password.strength.scale.factor",0.7);?>
;
    var smallScreen = window.matchMedia("(max-width: 40.0625em)");
    var chgPwdWidth = (smallScreen.matches) ? "97%" : "500px";
    var regFormWidth = (smallScreen.matches) ? "97%" : "650px";
    //Function to animate email and password buttons
    /*loginAnimate = function(e) {
        $(this).prev('span').css({'font-size':'0.9rem','color':'#008cba','font-weight':'normal'});
        $(this).animate({
            height: ['40px','linear']
        }, 'fast');
    };
    
    openLoginInputs = function () {
        $(this).css({'font-size':'0.9rem','color':'#008cba','font-weight':'normal'});
        $(this).next("input").animate({
            height: ['40px','linear']
        }, 'fast');
    };*/
    
    
    
    
    //Start of JQuery   
    $(document).ready(function(){
        //$("#regGenderId, #regCountryId").chosen();
        
        $("#regDob").datepicker({
            format:"M dd, yyyy",
            autoclose: true,
            clearBtn: true,
            endDate: '-16y'
        }).data("datepicker");
        
        
        $("#newPassw").keyup(function(e){
            $(this).complexify({minimumChars: 8, strengthScaleFactor:scaleFactor, bannedPasswords:['pass','word','wel','come','password','welcome', '1234']}, function(valid, complexity){
                var complex = Math.round(complexity, 0);
                var width = $("#complexityContainer").css("width").replace(/[^-\d\.]/g, '');
                var fillWidth = Math.round(((complex / 100)*width),0);
                
                if(complex < 30){
                    $("#complexity").css({'background-color':'#DD0000','color':'#EEEEEE','width':fillWidth+'px','text-align':'center'});
                    if(complex !== 0){
                        $("#complexity").html(complex);
                    }else{
                        $("#complexity").html('');
                    }
                }else{
                    if(complex >= 30 && complex < 60){
                        $("#complexity").css({'color':'#444444','background-color':'yellow','width':fillWidth+'px','text-align':'center'}).html(complex);
                    }else{
                       $("#complexity").css({'background-color':'green','width':fillWidth+'px','color':'#FFFFFF','text-align':'center'}).html(complex);
                    }
                }
            });
        });
        
        $("#regUsr").click(function(e){
            $.modal($('div#register-modal-content'), {
            close:true,
            containerCss: {'width':regFormWidth, 'min-height':'450px'},
                onOpen: function (dialog) {
                    dialog.overlay.fadeIn('slow', function () {
                        dialog.data.hide();
                        dialog.container.fadeIn('slow', function () {
                                dialog.data.slideDown('slow');	 
                        });
                    });
                }
            });
        });
    

    
        
    <?php if ($_smarty_tpl->tpl_vars['reset']->value) {?>
          
            $.modal($('div#basic-modal-content'), {
                close:false,
                containerCss: {'width':chgPwdWidth, 'height':'400px'},
                onOpen: function (dialog) {
                    $("div#chk").html("");
                    dialog.overlay.fadeIn('slow', function () {
                        dialog.data.hide();
                        dialog.container.fadeIn('slow', function () {
                                dialog.data.slideDown('slow');	 
                        });
                    });
                }
             });
                 
    <?php }?>
    
    <?php if ($_smarty_tpl->tpl_vars['enabled2FA']->value) {?>
          
            
             $.modal($('div#FA-content'), {
                close:false,
                containerCss: {'width':'400px'},
                onOpen: function (dialog) {
                    //$("div#chk").html("");
                    dialog.overlay.fadeIn('slow', function () {
                        dialog.data.hide();
                        dialog.container.slideDown('slow', function () {
                            dialog.data.fadeIn('slow');	 
                            
                            // where the magic happens
                            dialog.container.css('height', 'auto');
                            dialog.origHeight = '200px';
                            //$.modal.setContainerDimensions();
                            //$.modal.setPosition();
                            
                            //give first code textbox focus
                            $('div#FA-content').find("input[name='code[]']:first").focus();
                        });
                    });
                }
             });
                 
    <?php }?>
        
    
    
    
        
        $(function() {
            textAutoMove ("input[name='code[]']", 1, 'autoEntry');
            textAutoMove ("input[name='bkupCode[]']", 4, 'autoEntry');
        });
        
        var divContent = $("div#FA-content").html();
        
        $("body").on("click","#bkCode",function(e){
            if ($(this).prop("checked")) {
                $("div#FA-content").html($("div#FA-backup-content").html());
                $('div#FA-content').find("input[name='bkupCode[]']:first").focus();
            }
        });
        
        $("body").on("click","#goBack", function(e){
            $("div#FA-content").html(divContent);
            $('div#FA-content').find("input[name='code[]']:first").focus();
        });
        
        $("body").on("click",".simplemodal-close", function(e){
            $.modal.close();
        });
        
        /****** For forgot password functionality ***********/
        $(".forgotPassword").qtip({
                content: {
                    button: true,
                    title: "<b><?php echo \Neptune\MessageResources::i18n("password.forgot.request");?>
</b>",
                    text: function(event, api) {
                        var $div = $("<div>",{id:"tooltipDiv"});
                        var $span = $("<span>");
                        var $btnDiv = $("<div>").css("text-align","right");
                        //var $button = $("<button>",{type:"button", class:"button",id: "forgotPasswd"});
                        //$button.html("")
                        $span.html("<?php echo \Neptune\MessageResources::i18n("warning.reset.password.request");?>
");
                        var $spanEmail = $("<span>");
                        $spanEmail.text($("#userEmail").val().toLowerCase()).css({"font-weight":"bold","color":"#304050"});
                        //$button.css({"width":"140px !important"});
                        $btnDiv.html("<button style='width:200px !important;' type='button' class='button' id='forgotPasswd'><i style='font-size:0.9rem !important;' class='fa fa-sync'></i>&nbsp;<?php echo \Neptune\MessageResources::i18n("form.text.password.reset");?>
</button>");
                        $div.append($span).append("<br/><br/>").append($spanEmail).append("<br/><br/>").append($btnDiv);
                        return $div;
                    }
                    
                },
                 style: {
                    classes: 'qtip-bootstrap',
                    width:'600px'
                },
                position: {
                    my: "center",
                    at: "center",
                    viewport: $(window),
                    adjust: {
                        method: 'shift shift'
                    },
                    target: $(window)
                },
                show :{
                    event: "click",
                    solo: true,
                    modal: {
                        on: true,
                        blur: false,
                        escape: false
                    }
                }, 
                hide:false
            });
            
            /*********************************
            * For 2FA code authentication
            **********************************/
            $("body").on("submit","form#tfaForm",function(e){
                var formElement = $(this);
                $("#msg2FA").css("display","none");
                var newCode = '';
                var totalFill = 0;
                $(this).find("input[name='code[]']").each (function(e){
                    if ($(this).val() !== '') {
                        totalFill++;
                        newCode = newCode + $(this).val();
                        $(this).removeClass("error");
                    } else {
                        $(this).addClass("error");
                    }
                });
                e.preventDefault();
                
                if (parseInt(totalFill) === 6) {
                    addOverlay("Verifying security code", true);
                    $.ajax({
                        url: "/tfa/verify/code",
                        type: "POST",
                        data: {code: newCode, userId: $("#tfaUserId").val()},
                        dataType: "json",
                        success: function(data) {
                            
                            if (data) {
                                formElement[0].submit();
                            } else {
                                
                                $("#msg2FA").css("display","block");
                                $("form#tfaForm").find("input[name='code[]']").val('');
                                $("div.overlay").remove();
                            }
                        }
                    });
                }
            });
            /*********************************
            * For back up code authentication
            **********************************/
            $("body").on("submit","form#tfaBackupForm",function(e){
                var formElement = $(this);
                $("#msg2FABackup").css("display","none");
                var newCode = '';
                var totalFill = 0;
                $(this).find("input[name='bkupCode[]']").each (function(e){
                    if ($(this).val() !== '' && $.trim($(this).val().length) == 4) {
                        totalFill++;
                        newCode = newCode + $(this).val();
                        $(this).removeClass("error");
                    } else {
                        $(this).addClass("error");
                    }
                });
                e.preventDefault();
                
                if (parseInt(totalFill) === 2 ) {
                    addOverlay("Verifying backup code", true);
                    $.ajax({
                        url: "/tfa/verify/backup/code",
                        type: "POST",
                        data: {code: newCode, userId: $("#bkupUserId").val()},
                        dataType: "json",
                        success: function(data) {
                            
                            if (data) {
                                formElement[0].submit();
                            } else {
                                formElement.find("input[name='bkupCode[]']").val('');
                                formElement.closest("div").find("#msg2FABackup").css("display","block");
                                $("div.overlay").remove();
                            }
                        }
                    });
                }
            });
      
        
    
        
        /**********************************************
         When forgot password request is sent
        ***********************************************/
        $("body").on("click","button#forgotPasswd", function(e){
            var api = $('.qtip:visible');
            api.find(".qtip-close").hide();
            api.find("input#forgotPasswd").attr("disabled",true).hide();
            api.find("div#tooltipDiv").find("span:last").remove();
            api.find("div#tooltipDiv").find("span:first").html("<div align='center' style='margin-top: 50px;'><img src='/images/gif-load.gif'/><br/>Sending email to <b>"+ $("#userEmail").val() +"</b>...</div>");
            $.ajax({
               url:"/user/forgot/password",
               type:"POST",
               data:{email:$("#userEmail").val()},
               dataType:"json",
               success: function(result){
                    if(result.status == 1){
                       api.find("div#tooltipDiv").find("span:first").html(result.msg).css({"color":"#006432","font-size":"0.8rem","font-weight":"bold"});
                       $(".forgotPassword").remove();
                    }else{
                       api.find("div#tooltipDiv").find("span:first").html(result.msg).css({"color":"#DD0000","font-size":"0.8rem","font-weight":"bold"}); 
                    }
                    api.find(".qtip-close").show();
                    $("input#passw").val("");
                    $("div.msg").find("label").text("");
                }
            });
        });
        
        $(function(){
            capsLockWarning("#passw", "<?php echo \Neptune\MessageResources::i18n("warning.caps.lock");?>
");
            if ($('input[type="email"].login').val() !== '') {
                $('input[type="email"].login').trigger('click');
                $('input[type="password"].login').trigger('click');
            }
        });
        
        /*****************************************
         Interrupt form submit to show spinner
        ******************************************/
        $("form#userRegistrationForm").submit(function(e) {
            var self = $(this);
            self.find("div.err").html("");
            self.find("button[type='submit']").css("display","none");
            self.find(".wait_tip").css("display","inline-block");
           
            e.preventDefault();
            
            $.ajax({
                type: "POST",
                url: "/user/registration/capture/check",
                dataType: "json",
                data: {captchaText: $("#captcha").val()}
            }).done(function(status){
                if (status) {
                    self[0].submit();
                } else {
                    e.preventDefault();
                    self.find("div.err").html("Invalid CAPTCHA text");
                    self.find("button[type='submit']").css("display","inline-block");
                    self.find(".wait_tip").css("display","none");
                }
            });
        });

        $(".refresh-captcha").click(function() {
            $("img.captcha-image").attr("src", '/utility/captcha.php?' + Math.random());
        });
        
    });//end of document get ready
    
    sessionStorage.clear();
     
<?php echo '</script'; ?>
>

</head>

<body style="margin:0px;"> 
    
    <div id="header2" style="font-family:'Poppins', sans-serif;font-size:0.9rem;">
        <span>Don't have an account yet?&ensp;<a href="#" onclick="return false;" id="regUsr" style="font-family:'Poppins', sans-serif;font-size:0.9rem;color:#008cba;cursor:pointer;">Register here</a></span>
    </div>
    <div class="bkgrd" align="center" style="">
        
        <div class="table_login" style="">
            
            
            <div class="imageRowLogin" style="margin-bottom:5px;background-color:transparent;">
                <img src='<?php echo \Neptune\PropertyService::getProperty("login.page.image");?>
' widtth="420px"/>
            </div>

            <form data-abide name="login" id="login" method="post" action="<?php echo $_smarty_tpl->tpl_vars['actionPage']->value;?>
"  autocomplete="off">
                <input type="hidden" id="userEmail" value="<?php echo $_smarty_tpl->tpl_vars['userName']->value;?>
"/>
                <div class="row msg collapse" style="width:100%;margin-left: 0px;margin-right: 0px;">
                    <div class="medium-12 columns end">
                        <label class="text-center" style="text-align: center;">
                            <?php echo $_smarty_tpl->tpl_vars['msg']->value;?>

                        </label>
                    </div>
                </div>
                <div class="row collapse">
                    
                    <div class="medium-12  large-12 end columns">
                        <label style="margin-bottom:40px;">
                            <span class='login' style='font-size:1rem;color:#444444;'>Email</span> 
                            <input style="" tabindex="1" type="email" placeholder="" name="username"  class="login" id="username" size="30" value="<?php echo $_smarty_tpl->tpl_vars['userName']->value;?>
" required/>
                            <small class="error"><?php echo \Neptune\MessageResources::i18n("err.msg.email.invalid.format");?>
</small>
                        </label>
                    </div>
                </div>
                
                <div class="row collapse">
                    
                    <div class="medium-12 large-12 end columns">
                        <label>
                            <span class='login' style='font-size:1rem;color:#444444;'>Password</span> 
                            <input tabindex="2" type="password" placeholder="" name="passw" size="30" class="login" id="passw" required/>  
                            <small class="error"><?php echo \Neptune\MessageResources::i18n("err.msg.required.password");?>
</small>
                        </label>
                    </div>
                </div>
                
                <div class="row">
                    <div class="small-6 end columns text-left" style="padding-left:0px;">
                        <button type="submit" class="button" name="submit" tabindex="3">
                            <i class='fas fa-sign-in-alt' style='font-size:1rem;'></i>&nbsp;&nbsp;<?php echo \Neptune\MessageResources::i18n("form.button.sign.in");?>

                        </button>
                    </div>
                    <?php if ($_smarty_tpl->tpl_vars['showForgotPassword']->value) {?>
                        <div class="small-6  end columns text-right" style="padding-right:0px;">
                            <label class="">
                                <a class="forgotPassword" style="font-size:0.8rem;font-family:'Poppins',sans-serif;" href="#" onclick="return false;"><?php echo \Neptune\MessageResources::i18n("form.text.forgot.password");?>
</a>
                            </label>
                        </div>
                    <?php }?>
                </div>  
                
            </form>
        </div>
              
<br/>
<div style="bottom:0; position:fixed;width:100%;">
    <div class="medium-12 columns end text-center show-for-large-up" style="font-size:0.7rem;padding-bottom: 4px;">
        
            <?php echo \Neptune\PropertyService::getProperty("app.footer.text","Copyright &copy; 2020");?>

        
        &nbsp;<?php echo \Neptune\MessageResources::i18n("footer.all.rights.reserved");?>

       
    </div>
</div>
<br/>

<!-- modal content for resetting of password -->
<div id="basic-modal-content">
    <div class='modalHeader' align="center"><?php echo \Neptune\MessageResources::i18n("form.text.password.reset");?>
</div>      
    <?php echo $_smarty_tpl->tpl_vars['msgReset']->value;?>

    <form data-abide name="chgPasswdForm" id="chgPasswdForm" action="/reset" method="post">
       <input type="hidden" name="userId" value="<?php echo $_smarty_tpl->tpl_vars['userId']->value;?>
"/>
        <div class="row">
            <div class="small-12 columns end instructions">
                <b><?php echo \Neptune\MessageResources::i18n("new.password.criteria.heading");?>
</b><br/>
                - <?php echo \Neptune\MessageResources::i18n("new.password.criteria.characters");?>
<br/>
                - <?php echo \Neptune\MessageResources::i18n("new.password.criteria.complexity");?>

            </div>
        </div>
        <div class="row">
            <div class="small-12 columns">
                <hr width="100%" size="2" color="#D0E0F0" style='margin:1px;'/>
            </div>
        </div>
        <div id="chk">
            <?php echo $_smarty_tpl->tpl_vars['msg']->value;?>

        </div>
        <div class='row'>
            <div class="small-12 end columns">
                <label style=""><?php echo \Neptune\MessageResources::i18n("password.complexity");?>

                    <div id="complexityContainer" style="background-color:#EEEEEE;">
                        <div id="complexity">&nbsp;</div>
                    </div>
                </label>
            </div>
        </div>
        <div class="row" >
            <div class="small-12 end columns">
                <label><span class="required"><?php echo \Neptune\MessageResources::i18n("form.input.password.new");?>
<small id="pwdError" class="error"></small></span>
                    <input tabindex="4" type="password" name="newPassw" id="newPassw" autocomplete="off" value="" data-abide-validator="passwordComplexityValidator"/>
                </label>
            </div>
        </div>    
        <div class="row">
            <div class="small-12 end columns">
                <label><span class="required"><?php echo \Neptune\MessageResources::i18n("form.input.password.confirm");?>
<small class="error"><?php echo \Neptune\MessageResources::i18n("err.msg.password.match.new");?>
</small></span>
                    <input tabindex="5" type="password" autocomplete="off" name="confPassw" required data-equalto="newPassw" id="confPassw" value="" size="30"/>
                </label>
            </div>
        </div>
        <div class="row" >
            <div class="medium-12 columns">
                <input tabindex="6" type="submit" name="chgPasswd" id="chgPasswd" value="&nbsp;<?php echo \Neptune\MessageResources::i18n("form.text.password.reset");?>
&nbsp;" style="width:auto;" class="button"/>
            </div>
        </div>
    </form>			
</div>
                
    <!-- modal content for entering 2FA codes -->
    <div id="FA-content">
        <a href="#" onclick="return false;" class="close simplemodal-close">X</a>
        <div class='modalHeader' style="font-size:1rem;" align="center">enter two factor authentication code</div>   
        <div style="min-height:30px;display:none;" id="msg2FA">
            <?php echo $_smarty_tpl->tpl_vars['html']->value->printMessageText(false,"Provided code is incorrect. Please try again.");?>

        </div>

        <form data-abide name="tfaForm" id="tfaForm" action="/tfa/verify" method="post">
            <input type="hidden" id="tfaUserId" name="userId" value="<?php echo $_smarty_tpl->tpl_vars['userId']->value;?>
"/>
            <div class="instructions text-center" align="center" >
                Please enter code from Authenticator app
            </div>
            <div class="row show-for-medium-up">
                <div class="medium-3 columns end text-center">
                    &nbsp;
                </div>
                <div class="medium-6 columns end text-center" style="padding-top:15px;">
                    <p>
                        <img width="200px" height="200px" src="/images/2fa.png">
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="small-12 columns">
                    <hr width="100%" size="2" color="#D0E0F0" style="margin: 3px 4px 3px 4px;"/>
                </div>
            </div>
            <div class="row">
                <div class="small-2 end columns text-center autoEntry">
                    <input autocomplete="off" type="text" name="code[]" size="2" maxlength="1" tabindex="1" required pattern="number" autofocus/>
                </div>
                <div class="small-2 end columns text-center autoEntry">
                    <input autocomplete="off" type="text" name="code[]" size="2" maxlength="1" tabindex="2"  required pattern="number"/>
                </div>
                <div class="small-2 end columns text-center autoEntry">
                    <input autocomplete="off" type="text" name="code[]" size="2" maxlength="1" tabindex="3" required pattern="number"/>
                </div>

                <div class="small-2 end columns text-center autoEntry">
                    <input autocomplete="off" type="text" name="code[]" size="2" maxlength="1" tabindex="4" required pattern="number"/>
                </div>
                <div class="small-2 end columns text-center autoEntry">
                    <input autocomplete="off" type="text" name="code[]" size="2" maxlength="1" tabindex="5" required pattern="number"/>
                </div>
                <div class="small-2 end columns text-center autoEntry">
                    <input autocomplete="off" type="text" name="code[]" size="2" maxlength="1" tabindex="6" required pattern="number"/>
                </div>
            </div>
            
            <div class="row">
                <div class="small-12 columns">
                    <hr width="100%" size="2" color="#D0E0F0" style="margin: 3px 4px 5px 4px;"/>
                </div>
            </div>
            <div class="row" >
                <div class="small-4 columns text-center" style="padding-top:7px;">
                    <input tabindex="7" type="submit" name="vCode" id="vCode" value="&nbsp;Verify Code&nbsp;" style="color:#008CBA;background:transparent;border:transparent;font-size:0.9rem;" class="button"/>
                </div>
                <div class="small-2 columns text-center" style="padding-top:12px;">
                    <span style="font-size:1rem;font-weight: bold;color:#BBBBBB;">OR</span>
                </div>
                <div class="small-6 columns text-left" style="padding-top:14px;font-weight:normal;">
                    <label><input type="checkbox" tabindex="8"  name="bkCode" id="bkCode"/>Use backup code</label>
                </div>
            </div>
        </form>			
    </div>
            
    <!-- modal content for entering 2FA backup code -->
    <div id="FA-backup-content">
        <a href="#" onclick="return false;" class="close simplemodal-close">X</a>
        <div class='modalHeader' style="font-size:1rem;" align="center">enter two factor auth backup code</div>   
        <div style="height:63px;display:none;" id="msg2FABackup">
            <?php echo $_smarty_tpl->tpl_vars['html']->value->printMessageText(false,"Provided backup code is incorrect.<br/> Please try again.");?>

        </div>
        <form data-abide name="tfaBackupForm" id="tfaBackupForm" action="/tfa/backup/code/login" method="post">
            <input type="hidden" name="userId" id="bkupUserId" value="<?php echo $_smarty_tpl->tpl_vars['userId']->value;?>
"/>
            <div class="instructions text-center" align="center" >
                <b>Remember:</b><br/>
                Using the backup code will disable two factor authentication until you re-enable it.
            </div>
            <div class="row">
                <div class="small-12 columns">
                    <hr width="100%" size="2" color="#D0E0F0" style="margin: 3px 4px 3px 4px;"/>
                </div>
            </div>
            <div class="row">
                <div align="right" class="small-2 end columns text-right">
                    &nbsp;
                </div>
                <div align="right" class="small-3 end columns text-right autoEntry">
                    <input autocomplete="off" type="text" placeholder="####" name="bkupCode[]" size="4" maxlength="4" tabindex="1" style="width:80px !important;" required autofocus/>
                </div>
                <div class="small-5 end columns text-center autoEntry">
                    <input autocomplete="off" type="text" placeholder="####" name="bkupCode[]" size="4" maxlength="4" tabindex="2" style="width:80px !important;" required/>
                </div>
            </div>
            <div class="row">
                <div class="small-12 columns">
                    <hr width="100%" size="2" color="#D0E0F0" style="margin: 3px 4px 3px 4px;"/>
                </div>
            </div>
            <div class="row" >
                <div class="small-6 columns text-left" style="padding-top:9px;">
                    <a href="#" tabindex="3" id="goBack" onclick="return false;" style="color:#AAAAAA;font-size:0.9rem;font-weight:normal;">Back</a>
                </div>
                <div class="small-6 columns text-right" style="padding-top:5px;">
                    <input tabindex="4" type="submit" name="vbCode" id="vbCode" value="&nbsp;Backup Code Login&nbsp;" style="width:auto;background:transparent;border:transparent;color:#008CBA;font-size:0.9rem;" class="button"/>
                </div>
            </div>
        </form>			
    </div>
            
    <!-- modal content for registering patient user -->
    <div id="register-modal-content">
        <a href="#" onclick="return false;" class="close simplemodal-close">X</a>
        <div class='modalHeader' align="center"><?php echo \Neptune\MessageResources::i18n("registration.form.header");?>
</div>      
        
        <form data-abide name="userRegistrationForm" id="userRegistrationForm" action="/register/user" method="post">
                        <br/>
            <div class='row'>
                <div class="small-6 end columns">
                    <label style=""><span class="required"><?php echo \Neptune\MessageResources::i18n("user.register.email");?>
<small class="error">invalid format</small></span>
                        <input tabindex="11" type="email" name="regEmail" id="regEmail" autocomplete="off" value="" required/>
                    </label>
                </div>
                <div class="small-6 end columns">
                    <label style=""><span class="required"><?php echo \Neptune\MessageResources::i18n("user.register.countryId");?>
<small class="error">required</small></span>
                        <select tabindex="12" name="regCountryId" id="regCountryId" required>
                            <?php echo smarty_function_html_options(array('options'=>$_smarty_tpl->tpl_vars['countryIds']->value),$_smarty_tpl);?>

                        </select>
                    </label>
                </div>
            </div>
            <div class='row'>
                <div class="small-6 end columns">
                    <label style=""><span class="required"><?php echo \Neptune\MessageResources::i18n("user.register.first.name");?>
<small class="error">required</small></span>
                        <input tabindex="13" type="text" name="regFirstName" id="regFirstName" autocomplete="off" value="" required/>
                    </label>
                </div>
                <div class="small-6 end columns">
                    <label style=""><span class="required"><?php echo \Neptune\MessageResources::i18n("user.register.last.name");?>
<small class="error">required</small></span>
                        <input tabindex="14" type="text" name="regLastName" id="regLastName" autocomplete="off" value="" required/>
                    </label>
                </div>
            </div>
            
            <div class='row'>
                <div class="small-6 end columns">
                    <label style=""><span class="required"><?php echo \Neptune\MessageResources::i18n("user.register.genderId");?>
<small class="error">required</small></span>
                        <select tabindex="15" name="regGenderId" id="regGenderId" required>
                            <?php echo smarty_function_html_options(array('options'=>$_smarty_tpl->tpl_vars['genderIds']->value),$_smarty_tpl);?>

                        </select>
                    </label>
                </div>
                <div class="small-6 end columns">
                    <label style=""><span class="required"><?php echo \Neptune\MessageResources::i18n("user.register.dob");?>
<small class="error">required</small></span>
                        <input tabindex="16" type="text" class="medium" name="regDob" id="regDob" autocomplete="off" value="" required placeholder="mmm dd, yyyy"/>
                    </label>
                </div>
            </div>
            <div class='row'>
                
            </div>
            <div class='row'>
                <div class="small-6 end columns" style="padding-top:8px;">
                    <img src="/utility/captcha.php" alt="CAPTCHA" class="captcha-image"/>
                    <i class="fas fa-sync refresh-captcha" style="cursor:pointer;font-size:1.4rem;color:#008cba;"></i>
                </div>
                <div class="small-6 end columns">
                    <label>
                        <span class="required"><?php echo \Neptune\MessageResources::i18n("user.registration.captcha.label");?>
<small class="error captchaError">invalid text</small></span>
                        <input type="text" id="captcha" maxlength="6" name="captcha_challenge" pattern="" required />
                    </label>
                </div>
            </div>
            <div class="row" >
                <div class="medium-6 columns end">
                    <?php echo \Neptune\HtmlElementTag::submitBtn(17,'Register');?>

                    <span class="wait_tip" style="display:none;"><img src="/images/newloader.gif" width="24px" height="24px" id="loading_img"/> Please wait...</span>
                </div>
                <div class="medium-6 columns end">
                    <div class="err"></div>
                </div>
            </div>
        </form>			
    </div>
</div>



    <?php echo '<script'; ?>
 src="/js/foundation.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="/js/foundation.abide.js"><?php echo '</script'; ?>
>
    <!-- Other JS plugins can be included here -->

    <?php echo '<script'; ?>
>
        $(document).foundation({
            
            abide: {
                validators: {
                    passwordComplexityValidator: function (el, required, parent){
                        var ok, complex; 
                        var scaleFactor = <?php echo \Neptune\PropertyService::getProperty("password.strength.scale.factor",0.7);?>
;
                        $("#"+el.id).complexify({minimumChars: 8, strengthScaleFactor:scaleFactor, bannedPasswords:['pass','word','wel','come']}, function(valid, complexity){
                            ok = valid;
                            complex = Math.round(complexity, 0);
                        });
                        if(!ok || complex < 60){
                            $("#pwdError").text("<?php echo \Neptune\MessageResources::i18n("password.complexity");?>
: "+complex+" < 60");
                            return false;
                        }
                        return true;
                    }
                },
                patterns: {
                    capcha_pattern: /^[A-Z]+$/
                }
            }
            
        });
    <?php echo '</script'; ?>
>
    
</body>
</html>
<?php }
}
