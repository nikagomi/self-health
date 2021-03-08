{*Author: Randal Neptune*}
{*Project: EduRecord*}

{extends file="base/body.tpl"}

{block name=scripts}
    {literal}
    
    {/literal}
{/block}

{block name=jquery}
    {literal}
        $(function(){
            $(".hotspot").tipTip({maxWidth: "200px", edgeOffset: 3, defaultPosition: "top", delay: 200, fadeOut: 400});
        });
    {/literal}
{/block}

{block name=styles}
    {literal}
        
    {/literal}
{/block}

{block name=dataTable}
    {literal}
        "info": true,
        "paging": true,
        "searching": true,
        "iDisplayLength":100,
        dom: "<'row'<'small-6 columns'l><'small-3 columns'f><'small-3 columns text-right collapsed'>r>"+
            "t"+
            "<'row'<'small-6 columns'i><'small-3 columns end'p>>",
    {/literal}
{/block}

{block name=content}

    {nocache}
{$msg}
<fieldset style="width:85%;">
        <legend>Notification Message Details</legend>
            
            <div class="row">
                <div class="medium-3 large-2 columns">
                    <label class="medium-text-right small-text-left">Sender:</label>
                </div>
                <div class="medium-3 large-3 end columns">
                    <label class="infoLabel text-left">
                        {$notify->getOwner()->getLabel()}
                    </label>
                </div>
            
                 <div class="medium-3 large-2 columns">
                     <label class="medium-text-right small-text-left">Created By:</label>
                </div>
                <div class="medium-3 large-2 end columns">
                    <label class="text-left infoLabel">
                       {$notify->getCreatedBy()->getLabel()}
                    </label>
                </div>
            </div>
            <div class="row">
                <div class="medium-3 large-2 columns">
                     <label class="medium-text-right small-text-left">Target Facility:</label>
                </div>
                <div class="medium-3 large-3 end columns">
                    <label class="text-left infoLabel">
                       {$notify->getTargetFacility()->getName()}
                    </label>
                </div>
            
                <div class="medium-3 large-2 columns">
                     <label class="medium-text-right small-text-left">Expiry Date:</label>
                </div>
                <div class="medium-3 large-3 end columns">
                    <label class="text-left infoLabel">
                       {if $notify->isExpired()}
                           <font color="#ff0000">{$notify->getExpiryDate()|date_format:"%b %e, %Y"}</font>
                       {else}
                           {$notify->getExpiryDate()|date_format:"%b %e, %Y"}
                       {/if}
                    </label>
                </div>
            </div>
            <div class="row">
                <div class="medium-3 large-2 columns">
                     <label class="medium-text-right small-text-left">Subject:</label>
                </div>
                <div class="medium-9 large-8 end columns">
                    <label class="text-left infoLabel">
                       {$notify->getSubject()}
                    </label>
                </div>
            </div>
            <div class="row">
                <div class="medium-3 large-2 columns">
                     <label class="medium-text-right small-text-left">Message:</label>
                </div>
                <div class="medium-9 large-8 end columns">
                    <label class="text-left">
                       {$notify->getContent()|html_entity_decode}
                    </label>
                </div>
            </div>
            <div class="row">
                <div class="medium-3 large-2 columns">
                    {if $fromDate == ''}
                        <a title="Back to notification message screen" href='/utility/notification/message'>
                            Back
                        </a>
                    {else}
                        <form action="/utility/notification/message/search/results" method="POST">
                            <input type="hidden" name="fromDate" value="{$fromDate}"/>
                            <input type="hidden" name="toDate" value="{$toDate}"/>
                            <input type="hidden" name="msgType" value="{$msgType}"/>  
                            <input type="submit" title="Back to notification message search screen" name="submit" value="Back to Search" style="width: auto;" class="button"/>  
                        </form>
                    {/if}
                </div>
            </div>
    </fieldset>
 
            

{if $notify->getRecipients()|count gt 0}
    {$respuestas=$notify->getNotificationAcknowledgements()}
    
    <div class="listTableCaption">Message Acknowledgements</div> 
    <table align="left" id="listTable" class="displayTable" width="85%" cellspacing="0">
        <thead>
            <tr>
                <th>Recipient</th>
                <th>Acknowledged</th>
                <th>Time Acknowledged</th>
                <th>Acknowledgement Message</th>
                <th width="5%">&nbsp;</th>
            </tr>
        </thead>
        <tbody>
            {foreach from=$notify->getRecipients() item=recipient} 
                {$ans=$answer}
                <tr>                           
                    
                    {foreach from=$respuestas item=ack}
                        {if $recipient->getId() == $ack->getRecipientId()}
                            {$ans=$ack}
                            {break}
                        {/if}
                    {/foreach}
                    <td>{$recipient->getLabel()}</td> 
                    {if !$ans->isIdEmpty()}
                        <td style="font-family:verdana;font-size:1.0rem;color:#006432;">
                            Yes
                        </td> 
                        <td>{$ans->getAcknowledgedTime()|date_format:"%b %e, %Y %l:%M %p"}</td> 
                        <td>{$ans->getAcknowledgementMessage()}</td>
                    {else}
                        <td style="font-family:verdana;font-size:1.0rem;color:#FF0000;">
                           No
                        </td> 
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    {/if}
                    <td>&nbsp;</td>
                </tr>
            {/foreach}
        </tbody>
    </table> 
{else}
    <div class="emptyListMessage">
        there are no recipients attached to this message.
    </div>
{/if}
<br/><br/>


{/nocache}
{/block}