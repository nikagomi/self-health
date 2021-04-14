{*Author: Randal Neptune*}
{*Project: EduRecord*}

{extends file="base/body.tpl"}

{block name=scripts}
    {literal}
        var msgContent = {value:''};
        var contentLength = 200;
    {/literal}
{/block}

{block name=jquery}
    {literal}
        $("#ownerId").chosen();
        
        $(function(){
            $(".hotspot").tipTip({maxWidth: "200px", edgeOffset: 3, defaultPosition: "top", delay: 200, fadeOut: 400});
        });
        
        /**************************************************
         Populate user groups based on the chosen facility
        ***************************************************/
        $("#targetFacilityId").chosen().change(function(){
            $("div.selectAll").remove();
            $("ul.receipts").html("");
            if ($(this).val() != "") {
                $.ajax({
                    type: "GET",
                    url: "/ajax/facility/user/groups/"+$(this).val(),
                    dataType: "json",
                    success: function (groups) {
                        if (groups.length > 0) {
                        
                            var listItems = "<option value=''></option>";
                            for (var i = 0; i < groups.length; i++) {
                                listItems += "<option value='"+groups[i].id+"'>"+groups[i].label+"</option>";
                            }
                            $("#userGroupId").html(listItems).trigger("chosen:updated");
                        } else {
                            $("#userGroupId").html("<option value=''>No groups available</option>").trigger("chosen:updated");
                            $("ul.receipts").html("");
                            $("div.selectAll").remove();
                        }
                    }
                });
            } else {
                $("#userGroupId").html("<option value=''></option>").trigger("chosen:updated");
                $("ul.receipts").html("");
                $("div.selectAll").remove();
            }
        });
        
        /********************************************
         Show users of the group at chosen facility
        *********************************************/
        $("#userGroupId").chosen().change(function(){
            if ($(this).val() != "" && $("#facilityId").val() != "") {
                $("div.selectAll").remove();
                $.ajax({
                    type: "GET",
                    url: "/ajax/facility/group/users/"+$(this).val()+"/"+$("#targetFacilityId").val(),
                    dataType: "json",
                    success: function (users) {
                        if (users.length > 0) {
                            var listItems = "";
                            for (var i = 0; i < users.length; i++) {
                                listItems += "<li><input type='checkbox' name='usr[]' value='"+users[i].id+"' id='usr_"+users[i].id+"'>&nbsp;<label style='color:#333;' for='usr_"+users[i].id+"'>"+users[i].label+"</label></li>";
                            }
                            $("ul.receipts").html(listItems);
                            $("ul.receipts").after('<div class="selectAll"><input type="checkbox" id="selectAll"/><span class="selectAll">Select All</span></div>');
                        } else {
                            $("ul.receipts").html("<div style='color:#dd0000;font-size:1.1rem;'>There are no recipients to show for the selected group</div>");
                            $("div.selectAll").remove();
                        }
                    }
                });
            } else {
                $("ul.receipts").html("<div style='color:#dd0000;font-size:1.1rem;'>There are no recipients to show for the selected group</div>");
                $("div.selectAll").remove();
            }
        });
        
        /*********************************
         Start today; expire in 3 month(s)
        **********************************/
        $("#expiryDate").datepicker({
            format:"dd/mm/yyyy",
            endDate: "+3m",
            startDate: "0d",
            autoclose: true,
            clearBtn: true,
        }).data("datepicker");
        
        {/literal}
        {if $message->isIdEmpty()}
            {literal} 
                $("#expiryDate").val("");
            {/literal}
        {/if}
        {literal}
        
        /*****************************************
         Trigger change event on facility dropdown
        ******************************************/
        $("#targetFacilityId").trigger("change");
        
        /************************************
         To select / deselect all recipients
        *************************************/
        $("body").on("click","#selectAll",function(){
            if($(this).is(":checked")){
                $("input[name='usr[]']").each(function(e){
                    $(this).prop('checked',true);
                });
                if( $('input[name="usr[]"]:checked').length > 0){
                    $("div#err").html("");
                }
            }else{
                $("input[name='usr[]']").each(function(e){
                    $(this).prop('checked',false);
                });
                if( $('input[name="usr[]"]:checked').length == 0){
                    $("div#err").html("At least one recipient must be selected");
                }
            }
        });
        
        /*********************************************
         Make sure at least one recipient is selected
        **********************************************/
        $("#notificationMessageForm").submit(function(e){
            if( $('input[name="usr[]"]:checked').length == 0 && $("#id").val() == ''){
                e.preventDefault();
                $("div#err").html("At least one recipient must be selected");
            }else{
                $("div#err").html("");
            }
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
        
       
        
    {/literal}
    {if !$message->isIdEmpty()}
        {literal} 
            var remainder = ($(".trumbowyg-editor").text().length > parseInt(contentLength)) ? 0 : (parseInt(contentLength) - parseInt($(".trumbowyg-editor").text().length)); 
            $("span.numChar").html(remainder);
        {/literal}
    {/if}
    
    /***************************
        Column header filter  
    ****************************/
    sarmsHeaderDataTableColumnFilterMulti(dTable, [0,1,2]);
    
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
            min-height: 120px !important;
        }
    {/literal}
{/block}

{block name=dataTable}
    {literal}
        fixedHeader: false
    {/literal}
{/block}

{block name=content}

    {nocache}
{$msg}


<form data-abide name="notificationMessageForm" id="notificationMessageForm" action="{$actionPage}" method="POST" autocomplete="off">
    <fieldset style="width:86%;">
        <legend>Create / Edit Notification Message</legend>
        <input type="hidden" id="id" name="id" value="{$message->getId()}"/>
        <div class="row">
            <div class="medium-4 end columns">
                <label><span class="required">Sender</span>
                    <select tabindex="1" name="ownerId" id="ownerId" tabindex="1" required>
                        {html_options options=$senders selected=$ownerId}
                    </select>
                </label>
                <input type="hidden" name="createdById" id="createdById" value="{$smarty.session.userId}"/>
                <input type="hidden" name="createdAtFacilityId" id="createdById" value="{$smarty.session.facilityId}"/>
            </div>
            <div class="medium-4 end columns">
               <label><span class="required">Expiry Date</span>
                    <input  tabindex="4" name="expiryDate" id="expiryDate" type="text" value="{$message->displayExpiryDate()}" required/> 
                </label>
            </div>
        </div>
        <div class="row">
            <div class="medium-4 end columns">
                <label><span class="required">Subject </span>
                    <input maxlength="40" tabindex="2" type="text" name="subject" id="subject" size="60" value="{$message->getSubject()}" required/>
                </label>
            </div>
            
            <div class="medium-4 end columns">
                <label><span class="required">Target Facility</span>
                    {if $message->isIdEmpty()}
                        <select tabindex="5" name="targetFacilityId" id="targetFacilityId" required>
                            {html_options options=$facilities selected=$smarty.session.facilityId}
                        </select>
                    {else}
                        <label style="padding-top:7px;">
                            <font color="#000000">{$message->getTargetFacility()->getName()}</font>
                        </label>
                    {/if}
                </label>
            </div>
        </div>
        <div class="row">
            <div class="medium-8 end columns">
                <label><span class="required">Message</span>
                    <textarea tabindex="3" name="content" id="content" cols="15" rows="2" wrap="physical" required>{$message->getContent()|html_entity_decode}</textarea>
                    <div id="word-counter" contenteditable="true" align="right"><i><span class="numChar">200</span> characters left</i></div>
                </label>
            </div>
        </div>
        <div class="row" >
            <div class="medium-4 end columns">
                <label><span class="">Enable Response</span>
                    <div class="switch"> 
                        <input name="enableReply" id="enableReply" type="checkbox" value="1" {if $message->isReplyEnabled()} checked {/if}> 
                        <label for="enableReply"></label> 
                    </div> 
                </label>
            </div>
        </div>
        {if $message->isIdEmpty()}
            <div class="row">
                <div class="medium-4 end columns">
                    <label><span class="required">Recipient Group</span>
                        <select tabindex="6" name="userGroupId" id="userGroupId" required>
                            <option value=""></option>
                        </select>
                    </label>
                </div>
            </div>
        {/if}
        {if $message->isIdEmpty()}
            <div class="row">
                <div class="medium-12 end columns">
                    <label><span class="required">Recipients</span>
                        <div>
                            <ul class="receipts medium-block-grid-3 small-block-grid-1 large-block-grid-4" style="color:#222222;">

                            </ul>
                        </div>
                    </label>
                </div>
            </div>
        {/if}
        <div class="row">
            <div class="medium-8 end columns">
               <div id="err" class="error"></div>
           </div>
        </div>
        <div class="row">
            <div class="medium-12 columns">
              <hr width="99%" size="4" color="#D0E0F0" style="margin:10px;"/>
            </div>
        </div>
        
        <div class="row">
            <div class="medium-4 end columns">
                <a href="/utility/notification/message" tabindex="8" class="reset">{Messages::i18n("link.reset")}</a>&nbsp;
                {ElementTag::customBtn (7, 'share-square', 'Publish', 'submit', 'button', 'submit')}
            </div>
            {if !$message->isIdEmpty()}
                <div class="medium-4 end columns">
                    {Messages::i18n("checkbox.confirm")}&nbsp;<input tabindex="9" id="confirmDelete" type="checkbox"/></span>
                    {ElementTag::deleteBtn(10, "/utility/notification/message/delete/`$message->getId()`")}
                </div>
            {/if}
        </div>
    </fieldset>
</form> 
            

{if $notifications|count gt 0}
    <div class="listTableCaption">your most recent notifications created at this facility</div> 
    <table align="left" id="listTable" class="displayTable" width="98%" cellspacing="0">
        <thead>
            <tr>
                <th>Sender</th>
                <th>Transcribed By</th>
                <th>Target Facility</th>
                <th>Subject</th>
                <th>Message</th>
                <th class="hotspot" title="Recipients">RCPTs</th>
                <th class="hotspot" title="Acknowledgements">ACKs</th>
                <th width='10%'>Expires</th>
                <th width="7%">&nbsp;</th>
            </tr>
        </thead>
        <tbody>
            {foreach from=$notifications item=notify} 
                <tr>                           
                    <td>{$notify->getOwner()->getLabel()}</td> 
                    <td>{$notify->getCreatedBy()->getLabel()}</td> 
                    <td>{$notify->getTargetFacility()->getLabel()}</td> 
                    <td>{$notify->getSubject()}</td> 
                    <td>{$notify->getContent()|html_entity_decode}</td> 
                    <td>
                        <a title="Recipient response details" href="/utility/notification/recipients/no/search/{$notify->getId()}">
                            {$notify->getNumberOfRecipients()}
                        </a>
                    </td> 
                    <td>
                        <a title="Recipient response details" href="/utility/notification/recipients/no/search/{$notify->getId()}">
                            {$notify->countNotificationAcknowledgements()}
                        </a>
                    </td> 
                    <td>
                        {if $notify->isExpired()}  
                            <span class="hotspot" style="color:#FF0000;" title="{$notify->getExpiryDate()|date_format:"%b %e, %Y"}">
                                Expired
                            </span> 
                        {else} 
                            {$notify->getExpiryDate()|date_format:"%b %e, %Y"} 
                        {/if}
                    </td> 
                    <td style="text-align:center;">
                        {if !$notify->isExpired()}
                            <a class="editRow" title="{Messages::i18n("link.edit")}" href="/utility/notification/message/edit/{$notify->getId()}"></a>
                        {/if}
                    </td>
                </tr>
            {/foreach}
        </tbody>
    </table> 
{else}
    <div class="emptyListMessage">
        you have not created any previous notifications at this facility.
    </div>
{/if}
<br/><br/>


{/nocache}
{/block}