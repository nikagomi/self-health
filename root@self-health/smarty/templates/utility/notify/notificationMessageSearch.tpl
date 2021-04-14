{*Author: Randal Neptune*}
{*Project: EduRecord*}

{extends file="base/body.tpl"}

{block name=scripts}
    {literal}
        var rptTitle = "{/literal}{$resultTitle}{literal}";
    {/literal}
{/block}
{block name=jquery}
    {literal}
        $(function(){
            $(".hotspot").tipTip({maxWidth: "200px", edgeOffset: 3, defaultPosition: "top", delay: 200, fadeOut: 400});
        });
        
        /*********************************
         To and from date range
        **********************************/
        $("#fromDate, #toDate").datepicker({
            format:"dd/mm/yyyy",
            autoclose: true,
            endDate: moment().format("DD/MM/YYYY"),
            clearBtn: true
        }).data("datepicker");
    {/literal}
{/block}

{block name=dataTable}
    {literal}
        colReorder: true,
        'iDisplayLength':50,
        
        dom: "<'row'<'small-3 columns'l><'small-3 columns'f><'small-6 columns text-right collapsed'B>r>"+
            "t"+
            "<'row'<'small-6 columns'i><'small-6 columns'p>>",
        buttons: [
            {
                extend: 'excelHtml5',
                text: 'Export Excel',
                title: rptTitle,
                className: 'excelbtn',
                titleAttr:'Export to Excel'
            } ,
            {
                extend: 'pdfHtml5',
                text: "Export PDF",
                title: rptTitle,
                className: 'pdfbtn',
                titleAttr:'Export to PDF'
            } ,
            {
                extend: 'print',
                title: rptTitle,
                autoPrint: true,
                className: 'printbtn',
                titleAttr:'Print Table'
            }
        ]
    {/literal}
{/block}

{block name=content}

    {nocache}
{$msg}


<form data-abide name="notificationSearchForm" id="notificationSearchForm" action="{$searchPage}" method="POST" autocomplete="off">
    <fieldset style="width:76%;">
        <legend>Notification Message Search</legend>
        <div class="row">
            <div class="medium-12 end columns" style="color:#888888;font-style: italic;font-size:0.9rem;">
                Only messages created or transcribed by you at this facility or targeted to you at this facility will be shown in the results.<br/>
                The search is based on the date that the message was created.<br/><b>LIMIT: 200 results.</b>
            </div>
        </div>
        <br/>
        <div class="row">
            <div class="medium-4 end columns">
               <label><span class="required">From Date <small class="error" id="fromDateError"></small></span>
                    <input  tabindex="1" name="fromDate" id="fromDate" type="text" value="{$fromDate}" required placeholder="dd/mm/yyyy" required data-abide-validator='dateValidator'/> 
                </label>
            </div>
            <div class="medium-4 end columns">
               <label><span class="required">To Date <small class="error" id="toDateError"></small></span>
                    <input  tabindex="2" name="toDate" id="toDate" type="text" value="{$toDate}" required placeholder="dd/mm/yyyy" required data-abide-validator='dateValidator'/> 
                </label>
            </div>
        </div>
        <div class="row">
            <div class="medium-6 end columns">
                <label class="text-left left"><span class="required">Message Type:</span>
                    <font color="#464646">
                        {if $prmManager->userHasPermissionAtFacility("NOTIFICATION.MESSAGE.SENDER", $smarty.session.userId, $smarty.session.facilityId)}
                            <input tabindex="3" type="radio" id="sentMsg" name="msgType" value="1" {if $msgType == 1} checked {/if}/> <label style="color:#464646;" for="sentMsg">Sent</label>&nbsp;
                        {/if}
                        <input tabindex="4" type="radio" id="rcvdMsg" name="msgType" value="2" {if $msgType == 2} checked {/if}/> <label style="color:#464646;" for="rcvdMsg">Received</label>
                    </font>
                </label>
            </div>
        </div>
        <div class="row">
            <div class="medium-4 end columns">
                {ElementTag::customBtn (5, 'search', 'Search', 'search', 'button', 'submit')}
            </div>
        </div>
    </fieldset>
</form> 
            

{if $results|count gt 0}
    <div class="listTableCaption">{$resultTitle}</div> 
    <table align="left" id="listTable" class="displayTable" width="98%" cellspacing="0">
        <thead>
            <tr>
                <th>Sender</th>
                <th>Created By</th>
                <th>Target Facility</th>
                <th width="15%">Subject</th>
                <th width="25%">Message</th>
                {if $msgType == 1}
                    <th>RCPTs</th>
                    <th>ACKs</th>
                    <th>Expires</th>
                    <th width="5%">&nbsp;</th>
                {elseif $msgType == 2}
                    <th>Acknowledged</th>
                    <th>Time Acknowledged</th>
                {/if}
                
            </tr>
        </thead>
        <tbody>
            {foreach from=$results item=notify} 
                {if $msgType == 1}
                    <tr>                           
                        <td>{$notify->getOwner()->getLabel()}</td> 
                        <td>{$notify->getCreatedBy()->getLabel()}</td> 
                        <td>{$notify->getTargetFacility()->getLabel()}</td> 
                        <td>{$notify->getSubject()}</td> 
                        <td>{$notify->getContent()|html_entity_decode}</td> 
                        <td>
                            <a href="/utility/notification/recipients/{$notify->getId()}/{$fromDateUnix}/{$toDateUnix}/{$msgType}">
                                {$notify->getNumberOfRecipients()}
                            </a>
                        </td> 
                        <td>
                            <a href="/utility/notification/recipients/{$notify->getId()}/{$fromDateUnix}/{$toDateUnix}/{$msgType}">
                                {$notify->countNotificationAcknowledgements()}
                            </a>
                        </td> 
                        <td>{if $notify->isExpired()} <font color="#ff000">Expired</font> {else} {$notify->getExpiryDate()|date_format:"%b %e, %Y"} {/if}</td> 
                        <td>
                            {if !$notify->isExpired() && $prmManager->userHasPermissionAtFacility("NOTIFICATION.MESSAGE.SENDER", $smarty.session.userId, $smarty.session.facilityId)} 
                                <a class="editRow" title="{Messages::i18n("link.edit")}" href="/utility/notification/message/edit/{$notify->getId()}"></a>
                            {/if}
                        </td>
                    </tr>
                {elseif $msgType == 2}
                    <tr>                           
                        <td>{$notify->getNotificationMessage()->getOwner()->getLabel()}</td> 
                        <td>{$notify->getNotificationMessage()->getCreatedBy()->getLabel()}</td> 
                        <td>{$notify->getNotificationMessage()->getTargetFacility()->getLabel()}</td> 
                        <td>{$notify->getNotificationMessage()->getSubject()}</td> 
                        <td>{$notify->getNotificationMessage()->getContent()|html_entity_decode}</td> 
                        <td>{DbMapperUtility::booleanYesNo($notify->isAcknowledged())}</td> 
                        <td>{$notify->getAcknowledgedTime()|date_format:"%b %e, %Y %l:%M %p"}</td> 
                    </tr>
                {/if}
            {/foreach}
        </tbody>
    </table> 
{else}
    <div class="emptyListMessage">
        no results to show
    </div>
{/if}
<br/><br/>


{/nocache}
{/block}

{block name="foundation"}
    {literal}  
    abide: {
            validators: {
                dateValidator: function (el, required, parent) {
                    try{
                        var sd = ($('#fromDate').val() != "") ? $.datepicker.parseDate('dd/mm/yy', $('#fromDate').val()) : null;
                        var ed = ($('#toDate').val() != "") ? $.datepicker.parseDate('dd/mm/yy', $('#toDate').val()) : null;
                        if (el.getAttribute("id") == 'fromDate' && ed !== null) {
                            if(sd >= ed){
                                $("#fromDateError").text("Must be on or after to date");
                                return false;
                            }
                        }
                        
                        if (el.getAttribute("id") == 'toDate' && sd !== null) {
                            if(ed <= sd){
                                $("#toDateError").text("Must be on or after from date");
                                return false;
                            }
                        }
                        
                    }catch(e){
                        if(el.getAttribute("id")  == 'fromDate'){
                            $("#fromDateError").text("Invalid date");
                        }else if(el.getAttribute("id") == 'toDate'){
                            $("#toDateError").text("Invalid date");
                        }
                        return false;
                    }    

                    //other rules can go here
                    return true;
                }
            }
        } 
    {/literal}    
{/block}