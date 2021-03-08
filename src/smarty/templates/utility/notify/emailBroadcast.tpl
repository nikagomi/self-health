{*Author: Randal Neptune*}
{*Project: EduRecord*}

{extends file="base/body.tpl"}

{block name=scripts}
    {literal}
        var msgContent = {value:''};
        var contentLength = 500;
        
        var getRecipients = function(subject, message, selectedGroups, selectedLevels, academicYearId, divisionId) {
            $("div.infoMessage").html('').css("display","none")
            $("div.errorMessage").html('').css("display","none")
            addOverlay ("Working...", true);
            $("div.overlay").append("<div style='font-size:1.4rem;font-family:courier;font-weight:bold;color:#FFF;'>Calculating number of recipients...</div>");
            return $.ajax({
                url: "/ajax/email/broadcast/recipients",
                type: "POST",
                dataType: "json",
                data: {subject: subject, message:message, selectedGroups:selectedGroups, selectedLevels:selectedLevels, divisionId:divisionId, academicYearId:academicYearId}
            });
        }
        
        var sendEmails = function (recipients) {
            $("div.overlay").append("<div style='font-size:1.4rem;font-family:courier;font-weight:bold;color:#FFF;'>"+recipients['recipients'].length+" recipents found...</div>");
            if (recipients['recipients'].length > 0 ) {
                $("div.overlay").append("<div style='font-size:1.4rem;font-family:courier;font-weight:bold;color:#FFF;'>Sending emails...</div>");
                
                $.ajax({
                    url: "/ajax/send/broadcast/email",
                    type:"POST",
                    data: {recipients: JSON.stringify(recipients)},
                    beforeSend: function(x) {
                        if (x && x.overrideMimeType) {
                          x.overrideMimeType("application/j-son;charset=UTF-8");
                        }
                    }, 
                    success: function (data) {
                        if (data > 0) {
                        $("div.overlay").append("<div style='font-size:1.4rem;font-family:courier;font-weight:bold;color:#FFF;'>Emails successfully sent to "+data+" recipients <i style='font-size:0.9rem;'>(Delivery not)</i></div>");
                        } else {
                            $("div.overlay").append("<div style='font-size:1.4rem;font-family:courier;font-weight:bold;color:#FFF;'>An error occurred. Could not send any emails.</div>");
                        }
                        $("div.overlay").append("<div style='font-size:1.4rem;font-family:courier;font-weight:bold;color:#FFF;'>Done.</div>");
                        $("div.infoMessage").html("Emails successfully sent to "+data+" recipients <i style='font-size:0.9rem;'>(Delivery not guaranteed)</i>");
                        setTimeout(function() {
                            $("div.overlay").remove();
                        }, 2500);
                    }
                });
            } else {
                $("div.overlay").append("<div style='font-size:1.4rem;font-family:courier;font-weight:bold;color:#FFF;'> No recipients found. Aborting operation...</div>");
                $("div.infoMessage").html("No recipients found. Broadcast aborted.");
                setTimeout(function() {
                    $("div.overlay").remove();
                }, 2500);
            }
            $("div.infoMessage").css("display","inline-block");
        }
        
        var errorHandler = function(jqXHR, exception) {
            $("div.overlay").remove();
            if (jqXHR.status === 0) {
                $("div.errorMessage").html('Not connect.\n Verify Network.');
            } else if (jqXHR.status == 404) {
                $("div.errorMessage").html('Requested page not found. [404]');
            } else if (jqXHR.status == 500) {
                $("div.erroMessage").html('Internal Server Error [500].');
            } else if (exception === 'parsererror') {
                $("div.errorMessage").html('Requested JSON parse failed.');
            } else if (exception === 'timeout') {
                $("div.errorMessage").html('Time out error.');
            } else if (exception === 'abort') {
                $("div.errorMessage").html('Ajax request aborted.');
            } else {
                $("div.errorMessage").html('Uncaught Error.\n' + jqXHR.responseText);
            }
            $("div.errorMessage").css("display","inline-block");
        }
    {/literal}
{/block}

{block name=jquery}
    {literal}
        
        $(function(){
            $(".hotspot").tipTip({maxWidth: "200px", edgeOffset: 3, defaultPosition: "top", delay: 200, fadeOut: 400});
        });
        
        $("textarea#content").trumbowyg({
            btns: [
                'btnGrp-design',
                ['superscript', 'subscript'],
                ['link'],
                ['removeformat'],
                ['foreColor'] 
            ],
            removeformatPasted: true,
            semantic: false
        }).on ('tbwchange', function() {
            var charCounter = $("span.numChar");
            checkCharacterCount($("#content"), contentLength, charCounter, msgContent);
        });
        
       
        var remainder = ($(".trumbowyg-editor").text().length > parseInt(contentLength)) ? 0 : (parseInt(contentLength) - parseInt($(".trumbowyg-editor").text().length)); 
        $("span.numChar").html(remainder);
        
        $("#academicYearId").chosen().change(function(){
            if ($(this).val() !== '') {
                $("input[name='gl[]']").prop("disabled", false);
                $("input[name='gl[]']").next("label").attr("class", "enabled");
            } else {
                $("input[name='gl[]']").prop("disabled", true);
                $("input[name='gl[]']").prop("checked", false);
                $("input[name='gl[]']").next("label").attr("class", "disabled");
            }
        });
        
        $("#divisionId").chosen();
        
        $("#broadcast").click(function(e){
            $("div#err").html("");
            var missingFields = 0;
            if ($("input[name='gl[]']:checked").length > 0 || $("input[name='ugrp[]']:checked").length > 0) {
                $("body").find("input[type='text'], textarea").each(function(){
                    var attr = $(this).attr("required");
                    if (typeof attr !== typeof undefined && attr !== false && $.trim($(this).val()) == '') {
                      
                        if ($(this).is("textarea")) {
                            $(".trumbowyg-box").css("border","1px solid #F00");
                        } else {
                            $(this).addClass("error");
                        }
                        missingFields++;
                    } else {
                        if ($(this).is("textarea")) {
                            $(".trumbowyg-box").css("border","1px solid #DDD");
                        } else {
                            $(this).removeClass("error");
                        }
                    }
                });
                if (missingFields > 0) { return false;}
                
                var subject = $.trim($("#subject").val());
                var content = $.trim($("#content").val());
                var academicYearId = $("#academicYearId").val();
                var divisionId = ($("#divisionId").length > 0) ? $("#divisionId").val() : ''; 
                
                var selectedGroups = "";
                var selectedLevels = "";
                
                $("input[name='ugrp[]']").each(function(e) {
                    if ($(this).is(":checked")) {
                        selectedGroups = selectedGroups + $(this).val() + ",";
                    }
                });
                $("input[name='gl[]']").each(function(e) {
                    if ($(this).is(":checked")) {
                        selectedLevels = selectedLevels + $(this).val() + ",";
                    }
                });
                
                //now do the ajax - chained
                getRecipients($("#subject").val(), $("#content").val(), selectedGroups, selectedLevels, $("#academicYearId").val(), $("#divisionId").val()).then(sendEmails, errorHandler);
                    
                    
               
            } else {
                $("div#err").html("Please select at least one user group or grade level to proceed");
            }
        });
    {/literal}
{/block}

{block name=styles}
    {literal}
        #tiptip_content {
            font-size: 14px;
            color: #000000;
            text-shadow: 0 0 2px #fff;
            padding: 4px 8px;
            border: 1px solid rgba(255,255,255,0.25);
            background-color: rgb(255,255,255);
            background-color: rgba(255,255,255,0.92);
            background-image: -webkit-gradient(linear, 0% 0%, 0% 100%, from(transparent), to(#000));
            border-radius: 3px;
            -webkit-border-radius: 3px;
            -moz-border-radius: 3px;
            box-shadow: 0 0 3px #555;
            -webkit-box-shadow: 0 0 3px #555;
            -moz-box-shadow: 0 0 3px #555;
        }
        
        ul > li{
            padding: 0px;
        }
        
        .trumbowyg-editor, .trunbowyg-textarea {
            min-height: 190px !important;
            font-size: 1rem;
            color: #555555;
        }
        
        .trumbowyg-box .error {
            border: 1px solid #FF0000 !important;
        }
        
        .users, .pgs {
            margin-left: 25px;
        }
        .users li, .pgs li{
            padding: 0px;
        }
        
        label.disabled {
            color:#888888;
        }
        
        label.enabled {
            color:#222222;
        }
        
        div.paper {
            text-align: left !important;
        }
    {/literal}
{/block}

{block name=dataTable}
    {literal}
        
    {/literal}
{/block}

{block name=content}

    {nocache}

   
       
    <div class="paper"> 
        <div class="listTableCaption_simpleTable" style="text-transform:lowercase;color:#BBBBBB;margin-top:2px;margin-bottom:10px;font-size:22px;">
            Create Email Broadcast Message
        </div>
        <div class="row">
            <div class="medium-4 end columns">
                <label><span class="required">Subject </span>
                    <input maxlength="40" tabindex="1" type="text" name="subject" id="subject" size="60"  required/>
                </label>
            </div>
            
            
        </div>
        <div class="row">
            <div class="medium-8 end columns">
                <label><span class="required">Message</span>
                    <textarea tabindex="2" name="content" id="content" maxlength="500" cols="15" rows="5" wrap="physical" required></textarea>
                    <div id="word-counter" contenteditable="true" align="right"><i><span style="font-size:0.85rem;" class="numChar">500</span> characters left</i></div>
                </label>
            </div>
        </div>
        
        <div class="row">
            <div class="medium-12 end columns">
                <label>
                    <span class="infoLabel">Select Recipients:</span>
                </label>
            </div>
        </div>
         <div class="row">
            <div class="medium-12 end columns">
              
                    <span class="">User Groups{*&nbsp;<input type="checkbox" class="users_all"/>*}</span>
                    <ul class="users medium-block-grid-3 small-block-grid-1">
                        {foreach from=$userGroups item=ugrp}
                            <li>
                                <input type="checkbox" name="ugrp[]" id="grp_{$ugrp->getId()}" value="{$ugrp->getId()}" />
                                &nbsp;<label class="enabled" for="grp_{$ugrp->getId()}">{$ugrp->getName()}</label>
                            </li>
                        {/foreach}
                        {if PropertyService::getBoolean("allow.external.user.access")}
                            <li>
                                <input type="checkbox" name="ugrp[]" id="grp_ext" value="ext" />
                                &nbsp;<label class="enabled" for="grp_ext"><sup>**</sup>External Users
                                <a href="#" class="hintanchorRow" onMouseover="showhint('Parent(s) / Guardian(s) who can log into the application with a username and password.', this, event, '200px')">&nbsp;</a></span>
                                </label>
                            </li>
                        {/if}
                    </ul>
               
            </div>
        </div>
        {if $smarty.session.isEducational}
            <div class="row">
                <hr width="100%" />
            </div>
            <div class="row">
                <div class="small-12 end columns text-left">
                    <span class="" style="color:#666666;">Parents(s)/Guardian(s) </span>
                </div>
            </div>
            <div class="row" style="margin-bottom:8px;">
                <div class="medium-3 large-2 end columns text-right" style="padding-top:5px;">
                    Academic Year:
                </div>
                <div class="medium-3 large-2 end columns">
                    <select id="academicYearId">
                        {html_options options=$academicYearIds selected=$currentYear->getId()}
                    </select>
                </div>
                {if PropertyService::getBoolean("has.facility.divisions")}
                    <div class="medium-3 large-2 end columns text-right"  style="padding-top:5px;">
                        Division:
                    </div>
                    <div class="medium-3 large-2 end columns">
                        <select id="divisionId">
                            {html_options options=$divisionIds}
                        </select>
                    </div>
                {/if}
            </div>
            <div class="row">
                <div class="medium-12 end columns">
                        <ul class="pgs medium-block-grid-3 small-block-grid-1">
                            {foreach from=$gradeLevels item=gl}
                                <li>
                                    <input type="checkbox" {if $currentYear->isIDEmpty()} disabled {/if} name="gl[]" id="gl_{$gl->getId()}" value="{$gl->getId()}" />
                                    &nbsp;<label class="{if $currentYear->isIDEmpty()}disabled{else}enabled{/if}" for="gl_{$gl->getId()}">{$gl->getName()}</label>
                                </li>
                            {/foreach}
                        </ul>
                    </label>
                </div>
            </div>
        {/if}
        <div class="row">
            <div class="medium-12 columns">
              <hr width="99%" size="4" color="#D0E0F0" style="margin:10px;"/>
            </div>
        </div>
        <div class="row">
           
        </div>
        <div class="row">
            <div class="medium-4 end columns">
                <a href="/utility/email/broadcast" tabindex="8" class="reset">{Messages::i18n("link.reset")}</a>&nbsp;
                <button type='button' id='broadcast' style='width:auto;padding:0px 6px;'>
                    <i class='fas fa-envelope' style='font-size:1rem;'></i>&nbsp;Broadcast Email
                </button>
            </div>
             <div class="medium-8 end columns">
                <div id="err" class="error"></div>
            </div>
        </div>
        <br>
        <div class='infoMessage' style='display:none;width:98%;'></div>      
        <div class='errorMessage' style='display:none;width:98%;'></div>
   </div>
   
    

{/nocache}
{/block}