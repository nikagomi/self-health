{*Author: Randal Neptune*}
{*Project: EduRecord*}

{extends file="base/body.tpl"}

{block name=scripts}
    {literal}
        var canvasDrawn = false;
        
        var smallScreen = window.matchMedia("(max-width: 40.0625em)");
        var tfaWidth = (smallScreen.matches) ? "95%" : "550px";
    {/literal}
{/block}

{block name=jquery}
    {literal}
        $("#sign-pad").on("mousemove touchmove",function(){
            canvasDrawn = true;
            
        });
        
        /*******************************
         Signature section - Start
        ********************************/
        $(function() {
            $('#signArea').signaturePad({drawOnly:true, drawBezierCurves:true,lineWidth: 0}); /*, lineTop:75*/
        });

        $("#btnSaveSign").click(function(e){
            html2canvas([document.getElementById('sign-pad')], {
                    onrendered: function (canvas) {
                        if (!canvasDrawn) {
                            $("div.signErr").css("display","inline-block");
                        } else {
                            $("div.signErr").css("display","none");
                            var canvas_img_data = canvas.toDataURL('image/png');
                            var img_data = canvas_img_data.replace(/^data:image\/(png|jpg);base64,/, "");
                            
                            //ajax call to save image inside folder
                            addOverlay("Saving Signature...", true);
                            $.ajax({
                                url: '/user/signature/save',
                                data: { img_data:img_data, userId:$("#id").val() },
                                type: 'post',
                                dataType: 'json',
                                success: function (response) {
                                    if (response['status']) {
                                        window.location.href = "/security/user/preferences";
                                    } else {
                                        $("div.overlay").remove();
                                        sweetAlert('Signature Error',response['msg'], "error");
                                    }
                                }
                            });
                        }
                    }
            });
        });
        
        $("#btnClearSign").click(function(e){
            $("#signArea").signaturePad().clearCanvas ();
            canvasDrawn = false;
        });
        
        $("#updateSign").click(function(e){
            if ($(this).text() == "Close") {
                $(this).text("Update").css("color","#008cba");
                $("#signArea").css("display","none");
                $("div.signErr").css("display","none");
            } else {
                $("#signArea").signaturePad().clearCanvas ();
                $("#signArea").css("display","inline-block");
                $(this).text("Close").css("color","#DD0000");
            }
        });
        /*******************************
         Signature section - End
        ********************************/
        
        var scaleFactor = {/literal}{nocache}{PropertyService::getProperty("password.strength.scale.factor",0.7)}{/nocache}{literal};
        $("#newPassword").keyup(function(e){
            $(this).complexify({minimumChars: 8, strengthScaleFactor:scaleFactor, bannedPasswords:['pass','word','wel','come', 'password','welcome', '1234']}, function(valid, complexity){
                var complex = Math.round(complexity, 0);
                var width = $("#complexityContainer").css("width").replace(/[^-\d\.]/g, '');
                var fillWidth = Math.round(((complex / 100)*width),0);
                
                if(complex < 30){
                    $("#complexity").css({'background-color':'#DD0000','color':'#EEEEEE','width':fillWidth+'px','text-align':'center'});
                    if(complex != 0){
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
        
        $("#userLocaleId").chosen();
        //$('#contactNumber').mask("000-0000", {clearIfNotMatch: true});
        
        $(function(){
            capsLockWarning("#currentPassword, #newPassword, #confirmPassword", "{/literal}{Messages::i18n("warning.caps.lock")}{literal}");
        });
        
        /*******************************************
         To modify grade auto save settings
        ********************************************/
        $("#autoSaveGrade").click(function(e) {
            var val = ($(this).is(':checked')) ? true : false;
            $.ajax({
                url: "/user/modify/auto/save/grade",
                method: "POST",
                dataType: 'json',
                data: {autoSaveGrade: val, id: $("#id").val()},
                success: function(result) {
                    if (result) {
                        $("#autoSaveMessage").html("<span style='color:#006432;font-size:1rem;'>Auto save setting successfully modified.</span>");
                        setTimeout(function() {
                            $("#autoSaveMessage").find("span").fadeOut(1000, function(){ $(this).remove();});
                        }, 2000);
                    } else {
                        $("#autoSaveMessage").html("<span style='color:#DD0000;font-size:1rem;'>Could not modify auto save setting.<br/>Please try the nearest update button.</span>");
                    }
                }
            });
        });
        
        /*******************************************
         To verify password for 2FA enabling
        ********************************************/
        $("body").on("click","#continue2FA",function(e) {
            var pwd = $("#pwd").val();
            var userPwdId = $("#userPwdId").val();
            
            if ($.trim(pwd) == '') {
                $("#pwd").addClass("error");
            } else {
            
                $("#pwd").removeClass("error");
                $("#pwd2FAError").text("");
                $.ajax({
                    url: "/verify/pwd",
                    method: "POST",
                    dataType: 'json',
                    data: {pwd: pwd, userPwdId: userPwdId},
                    success: function(result) {
                        if (result) {
                            $("div#FA-content").html($("div#basic-modal-content").html());
                            $("div#FA-content").find('#code').mask("999 999", {clearIfNotMatch: true});
                            $("div#FA-content").find('#code').focus();
                        } else {
                            $("#pwd").addClass("error");
                            $("#pwd2FAError").text("password is incorrect");
                        }
                    }
                });
            }
        });
        
        /**********************************************
         Interrupt form submit to check phone numbers
        ***********************************************/
        $("#preferenceForm").submit(function(e){
        
            //Format phone numbers
            var countryCode = itiPrimaryNumber.getSelectedCountryData().iso2;
            var telPrimaryNumber = phoneUtil.parseAndKeepRawInput(itiPrimaryNumber.getNumber(), countryCode.toUpperCase());
            if (localCode.toUpperCase() === countryCode.toUpperCase()) {
                $("input[name='contactNumber']").val(phoneUtil.format(telPrimaryNumber, i18n.phonenumbers.PhoneNumberFormat.NATIONAL));
            } else {
                $("input[name='contactNumber']").val(phoneUtil.format(telPrimaryNumber, i18n.phonenumbers.PhoneNumberFormat.INTERNATIONAL));
            }    
           
            
        });
        
        /*******************************************
         To enable 2 factor authentication
        ********************************************/
        $("body").on("click","#enable2FA", function(e) {
            var parDiv = $(this).closest("div#FA");
            var wcode = parDiv.find("#code").val();
            var code = wcode.replace(/\s/g, "");
            var userId = parDiv.find("#userId").val();
            
            parDiv.find("#errMsg2FA").css("display","none");
            
            if ($.trim(code) == '') {
                parDiv.find("#code").css('border-color','red');
            } else {
                parDiv.find("#code").css('border-color','#f5f5f5');
                addOverlay("Working", true);
                $.ajax({
                    url: "/enable/tfa",
                    method: "POST",
                    dataType: 'json',
                    data: {code: $.trim(code), userId: userId},
                    success: function(result) {
                        $("div.overlay").remove();
                        if (result['status']) {
                            swal("Success",result['msg'],"success");
                            $("#twoFactorAuthEnabled").prop("checked", true);//may be overkill but to be sure
                            $.modal.close();
                        } else {
                            $("#twoFactorAuthEnabled").prop("checked", false);
                            parDiv.find("#errMsg2FA").css("display","block");
                            parDiv.find("#code").val('').focus();
                        }
                    }
                });
            }
        });
        
        /************************************
         Close 2 factor authentication modal
        *************************************/
        $("body").on("click",".simplemodal-close", function(e){
            $("#twoFactorAuthEnabled").prop("checked", false);
            $.modal.close();
        });
        
        $(".simplemodal-close").click(function(e){
            $("#twoFactorAuthEnabled").prop("checked", false);
            $.modal.close();
        });
        {/literal}
        {nocache}
            {if $hasSecret}
            {literal}
            $("#twoFactorAuthEnabled").click(function(e){
                if ($(this).prop("checked")){
                    $.modal($('div#FA-content'), {
                        close:false,
                        containerCss: {'width':tfaWidth, "max-width":"500px"},
                        onOpen: function (dialog) {
                            $("div#chk").html("");
                            
                            dialog.overlay.fadeIn('slow', function () {
                                dialog.data.hide();
                                dialog.container.slideDown('slow', function () {
                                        dialog.data.fadeIn('slow');	 
                                        $("#pwd").focus();
                                        
                                        // where the magic happens
                                        dialog.container.css('height', 'auto');
                                        dialog.origHeight = '420px';
                                        //$.modal.setContainerDimensions();
                                        //$.modal.setPosition();
                                });
                            });
                        }
                    });
                } else {
                    $.ajax({
                        type: "POST",
                        url: "/disable/tfa",
                        dataType: "json",
                        data: {userId: $("#id").val()},
                        success: function (status) {
                            if (status) {
                                parTr.remove();
                                sweetAlert({
                                    title: "Disable 2FA Success",
                                    text: "Two factor authentication was successfully disabled.",
                                    type: "success"
                                });

                            } else {
                                sweetAlert({
                                    title: "Disable 2FA Error",
                                    text: "Could not disable two factor authentication .\nPlease contact the administrator.",
                                    type: "error"
                                });
                                $(this).prop("checked", true);
                            }
                        }
                    });
                }
            });
            {/literal}
            {/if}
        {/nocache}  
    
{/block}

{block name=styles}
    {literal}
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
        
        .modalHeader{
            background-color:#506070; 
            color:#fff; 
            font-size:16px; 
            font-weight:bold;
            height:30px; 
            padding-top:5px;
            font-family:"Arial";
            vertical-align: middle;
            font-variant:small-caps;
            border-radius: 0px;
        }
        
        .instructions{
            font-family:'Trebuchet MS';
            font-size:0.9rem;
            color:#999999;
            text-align:center;
           
            padding:0px 3px;
            font-weight:normal;
            margin-top:10px;
        }
        
        .inputfile + label {
             max-width: 100%;
             border: 1px solid #4682B4;
        }
        
        .inputfile + label svg {
            fill: #FFFFFF;
        }
        
        .inputfile-6 + label strong {
            background-color: #4682B4;
        }
        
        .inputfile-6 + label span {
            width: 160px;
        }
      
        #btnSaveSign {
            font-size: 1rem !important;
            margin-top:10px !important;
            width: auto !important;
            padding-left: 3px;
            padding-right: 3px;
        }
        #signArea{
            width:350px;
            margin: 5px 10px 10px 10px;
            text-align:left;
            display:none;
            
        }
        .sign-container {
            width: 60%;
            margin: auto;
        }
        .sign-preview {
            width: 150px;
            height: 50px;
            border: none; /*solid 1px #CFCFCF;*/
            margin: 10px 5px;
        }
        .tag-ingo {
            font-family: cursive;
            font-size: 1.1rem;
            text-align: left;
            font-style: oblique;
        }
        .signErr {
            display:none;
            color: #DD0000;
            font-size: 1rem;
        }
        
        .sign-pad {
            border: none;
        }
    {/literal}
{/block}


{block name=content}
{nocache}

{$msg}
  
    <div class="listTableCaption_simpleTable" style="font-variant:normal;font-weight: 500;margin-bottom:15px;color:#414042;font-family:'Poppins', sans-serif;font-size:1.3rem;">
        Update Preferences
    </div>
    
        <div class="row" style="margin-bottom: 4px;">
            <div class="medium-6 end columns">
                <label><span>Enable two-factor authentication?<a href="#" class="hintanchorRow" onMouseover="showhint('This option provides better security when compared to just a password.<br/>An external mobile device authenticator application is required.', this, event, '200px')">&nbsp;</a></span>
                    <div class="switch"> 
                        <input name="twoFactorAuthEnabled" id="twoFactorAuthEnabled" type="checkbox" value="1" {if $user->isTwoFactorAuthEnabled()} checked {/if}> 
                        <label for="twoFactorAuthEnabled"></label> 
                    </div> 
                </label>
            </div>
        </div>
        
        <div class="row" style="margin-bottom:17px;">
            <div class="small-12 columns">
              <hr width="100%" size="2" color="#D0E0F0" style="margin:1px;"/>
            </div>
        </div>
        
        
        <form data-abide name="preferenceForm" id="preferenceForm" action="{$actionPage}" method="POST" autocomplete="off">
            <input type="hidden" name="id" id="id" value="{$user->getId()}"/>
            
            <div class="row">
                <div class="medium-4 end columns">
                    <label><span class="required">Contact number</span><br/>
                        <input class="medium" tabindex="1" type="text" data-abide-validator="phoneValidator" id="contact" name="contact" value="{$user->getContactNumber()}" required autocomplete="off">
                    </label>
                </div>
            </div>
            <div class="row">
                <div class="medium-4 end columns">
                    <label><span class="required">Email<small class="error">invalid format</small></span>
                        <input tabindex="2" type="email" id="email" name="email" value="{$user->getEmail()}" required autocomplete="off">
                    </label>
                </div>
                <div class="medium-4 end columns">
                    <label style="padding-top:27px;">
                        {ElementTag::submitBtn(3, "Update Contact", "submitEmail")}
                    </label>
                </div>
            </div>
   
         </form>
                    
        <div class="row">
            <div class="small-12 columns">
              <hr width="100%" size="2" color="#D0E0F0"/>
            </div>
        </div>
                    
        <form data-abide name="preferencePasswdForm" id="preferencePasswdForm" action="{$actionPage}" method="POST" autocomplete="off">
            <input type="hidden" name="id" value="{$user->getId()}"/>
            <div class="row">
                <div class="medium-4 end columns">
                    <label><span class="required">Current Password</span>
                        <input tabindex="5" type="password" id="currentPassword" name="currentPassword" value=""  autocomplete="off" required/>
                    </label>
                </div>
            </div>
            <div class="row">
                <div class="medium-4 medium-push-4 end columns">
                    <label style="">Complexity meter
                        <div id="complexityContainer" style="background-color:#EEEEEE;">
                            <div id="complexity">&nbsp;</div>
                        </div>
                    </label>
                </div>
                <div class="medium-4 medium-pull-4 end columns">
                    <label><span class="required">New Password<a href="#" class="hintanchorRow" onMouseover="showhint('The password must be a minimum of 8 characters with a complexity value of at least 60', this, event, '200px')">&nbsp;</a><small class="error" id="pwdError"></small> </span>
                        <input tabindex="6" type="password" id="newPassword" name="newPassword" autocomplete="off" data-abide-validator="passwordComplexityValidator" value="" required/>
                    </label>
                </div>
                
            </div>
            <div class="row">
                <div class="medium-4 end columns">
                    <label><span class="required">Confirm Password  <small class="error">passwords must match</small> </span>
                        <input tabindex="7" type="password" id="confirmPassword" name="confirmPassword" autocomplete="off" data-equalto="newPassword" value="" required/>
                    </label>
                </div>
                <div class="medium-4 end columns">
                    <label style="padding-top:27px;">
                        {ElementTag::submitBtn(8, "Update Password", "submitPwd")}
                    </label>
                </div>
            </div>
        </form>
        
    

<!-- modal content for 2FA QR code read -->
 <div id="basic-modal-content">
    <div id="FA">
    <div class='modalHeader' style="font-family:'Poppins', sans-serif !important;font-variant:normal !important;" align="center">
        STEP 2: Scan to setup
    </div>      
    {$msgReset}
    
    <input type="hidden" name="userId" id="userId" value="{$user->getId()}"/>
    <div class="instructions" align="left"  style='text-align: left !important;'>
       Download an authenticator app, like Authy&REG; or Google Authenticator&REG; onto your mobile device, hit "add" then scan this barcode
       to set up your account. 
    </div>
    
    <div class="row">
        <div class="medium-3 columns end text-center">
            &nbsp;
        </div>
        <div class="medium-6 columns end text-center">
            <p>
                <img width="150px" height="150px" src="{$tfa->getQRCodeImageAsDataUri($user->getLabel(), $secret)}">
            </p>
        </div>
    </div>
    <div id="errMsg2FA" style="display:none;min-height:30px;">
        {$html->printMessageText(false,"Security code incorrect. Please scan and try again.")}
    </div>
    <div class="row">
        <div class="small-12 columns">
            <hr width="100%" size="2" color="#D0E0F0" style="margin: 2px 2px;"/>
        </div>
    </div>
    <div class="row">
        <div class="medium-6 columns end medium-text-right small-text-center" style="padding-top:5px;">
            <label>
                <span style="font-size:0.8rem;" class="required">Scanned code:</span>
            </label>
        </div>
        <div class="medium-6 columns end medium-text-left small-text-center" style="">
            <label>
                <input type="text" name="code" id="code" maxlength="7" size="" style="border-color: #F5F5F5;" autofocus/>
            </label>
        </div>
    </div>
    <div class="row">
        <div class="small-12 columns">
            <hr width="100%" size="2" color="#D0E0F0" style="margin: 2px 2px;"/>
        </div>
    </div>
    <div class="row">
        <div class="small-6 columns end text-left" >
            <a href="#"  onclick="return false;" class="simplemodal-close" style="font-size:0.9rem;color:#888;font-weight:normal;">Cancel</a>
        </div>
        <div class="small-6 columns end text-right">
            <a href="#" id="enable2FA" onclick="return false;" style="font-size:0.9rem;font-weight:normal;color:#008CBA;">Enable</a>
        </div>
    </div>
</div>
 </div> 
<!-- Step 1 of 2FA -->
<div id="FA-content">
    {*<a href="#modalClose" title="close" class="close" id="close2FA">X</a>*}
    <div class='modalHeader' style="font-family:'Poppins', sans-serif !important;font-variant:normal !important;" align="center">
        STEP 1: Authenticate with password
    </div>      
    {$msgReset}
    
    <input type="hidden" name="userPwdId" id="userPwdId" value="{$user->getId()}"/>
    <div class="row">
        <div class="small-3 columns end text-center">
            &nbsp;
        </div>
        <div class="small-6 columns end text-center" style="padding-top:15px;">
            <p>
                <img width="200px" height="200px" src="/images/2fa.png">
            </p>
        </div>
    </div>
    <div class="instructions" align="center" style="color:#000000;">
        <b>Enable two factor authentication</b>
    </div>
    <div class="instructions" align="left" style='text-align: left !important;'>
        Whenever you sign into your account, you will need to provide both your password and a security code
        from your mobile device.
    </div>
    <div class="row">
        <div class="small-12 columns">
            <hr width="100%" size="2" color="#D0E0F0" style="margin:5px 2px;"/>
        </div>
    </div>
    
    <div class="row">
        <div class="small-4 columns end text-right" style="padding-top:8px;">
            <label>
                <span style="font-size:0.8rem;color:#999999;" class="required">Password:</span>
            </label>
        </div>
        <div class="small-8 columns end text-left" style="">
            <label>
                <span><small style="color:#FF0000;font-size:0.75rem;" id="pwd2FAError"></small>
                <input type="password" name="pwd" id="pwd" size="" autocomplete="off" placeholder="Enter your password" style="background-color: #F5F5F5;font-size:1rem;"/>
                </span></label>
        </div>
    </div>
    
    <div class="row">
        <div class="small-12 columns">
            <hr width="100%" size="2" color="#D0E0F0" style="margin:5px 2px;"/>
        </div>
    </div>
    
    <div class="row">
        <div class="small-6 columns end text-left" >
            <a href="#" id="close2FA"  class="simplemodal-close" onclick="return false;" style="font-size:0.9rem;color:#999999;font-weight:normal;">Cancel</a>
        </div>
        <div class="small-6 columns end text-right">
            <a href="#" id="continue2FA" onclick="return false;" style="font-size:0.9rem;font-weight:normal;color:#008CBA;">Continue</a>
        </div>
    </div>
</div>
{/nocache}
{/block}

{block name="auxScripts"}
    {literal}
        const phoneUtil = i18n.phonenumbers.PhoneNumberUtil.getInstance();
        var primaryNumber = document.querySelector("#contact");
       
        
        var phoneErrorMap = ["Invalid number", "Invalid country code", "Too short", "Too long"];
        
        var itiPrimaryNumber = intlTelInput(primaryNumber,{
            utilsScript: "/js/utils.js",
            placeholderNumberType: "MOBILE",
            hiddenInput: "contactNumber",
            "allowDropdown": true,
            "autoPlaceholder": "polite",
            "initialCountry": "lc",
            "preferredCountries": ["lc"],
            "formatOnDisplay": true,
            autoHideDialCode: true
        });
        
        var localCode = '{/literal}{PropertyService::getProperty("country.code","lc")}{literal}';
    {/literal}
{/block}

{block name="foundation"}
    {literal}
        abide: {
            validators: {
                passwordComplexityValidator: function (el, required, parent){
                    var ok, complex;    
                    var scaleFactor = {/literal}{nocache}{PropertyService::getProperty("password.strength.scale.factor",0.7)}{/nocache}{literal};
                    $("#"+el.id).complexify({minimumChars: 8, strengthScaleFactor: scaleFactor, bannedPasswords:['pass','word','wel','come','password','welcome', '1234']}, function(valid, complexity){
                        ok = valid;
                        complex = Math.round(complexity, 0);
                    });
                    if(!ok || complex < 60){
                        $("#pwdError").text("complexity: "+complex+" < 60");
                        return false;
                    }
                    return true;
                },
                phoneValidator: function (el, required, parent) {
                    if (el.getAttribute("id") == 'contact') {
                        if (!itiPrimaryNumber.isValidNumber()) {
                            var countryCode = itiPrimaryNumber.getSelectedCountryData().iso2;

                            if (countryCode == "lc" && (itiPrimaryNumber.getNumber().indexOf("732") == 5 || itiPrimaryNumber.getNumber().indexOf("733") == 5) && phoneErrorMap[itiPrimaryNumber.getValidationError()] == "Invalid number") {
                                $("#contactNumberError").text("");
                                $("#contact").removeClass("error");
                                return true;
                            } 
                            $("#contactNumberError").text(phoneErrorMap[itiPrimaryNumber.getValidationError()]).css("display","inline-block");
                            $("#contact").addClass("error");
                            return false;
                        } else {
                            $("#contact").removeClass("error");
                            return true;
                        }
                    }
                    $("#contactNumberError").css("display","none");
                    return true;
                }
            }
        }
    {/literal}
{/block}
