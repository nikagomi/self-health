{*Author: Randal Neptune*}
{*Project: EduRecord*}

{extends file="base/contentBody.tpl"}

{block name=styles}
    {literal}
        .viewLabel, label{
            font-size: 0.9rem !important;
        }
        
        .chosen-container .chosen-drop {
            width: 300px;
        }
        
        .canceled {
            text-decoration:line-through;
        }
    {/literal}
{/block}

{block name=scripts}
    {literal}
        function truncateText(text, val){
            var newLength = val - 3;
            return (text.length > val) ? text.substring(0, newLength) + "..." : text; 
        }
    {/literal}
{/block}


{block name=jquery}
    {literal}
        
        $(function(){
            $(".hotspot").tipTip({maxWidth: "200px", edgeOffset: 3, defaultPosition: "top", delay: 200, fadeOut: 400});
        });
        
        
        /*********************************
         DataTable configuration options
        **********************************/
        $("table#prescriptionTable").DataTable({
            responsive: true,
            "searching":false,
            "info": false,
            "paging": false,
            "fixedHeader": false,
            order: [
                [4, 'desc'],
                [2,'desc']
            ],
            'columnDefs': [
                { 'orderData':[7], 
                  'targets': [2], 
                },
                { 'orderData':[6], 
                  'targets': [4], 
                },
                {
                  'targets': [7,6],
                  'visible': false,
                  'searchable': false,
                }
            ]
        });
    {/literal}
{/block}

{block name=content}
    {nocache}
    <div>
    <div class="listTableCaption_simpleTable pageTitle" style="padding-bottom:2px;margin-bottom:2px;">
        patient prescriptions
    </div>
    <div id="" {if $prescriptions|count == 0} style="display:none;" {/if}>
      
         <table align="left" id="prescriptionTable" class="displayTable_simpleTable" style="" width="99%" cellspacing="1">
             <thead>
                <tr>
                   <th class="all">Details</th>
                   <th class="all">Repeats</th>
                   <th class="all">Visit Date/Time</th>
                   <th class="all">Clinician</th> 
                   <th class="all">Rx Date</th> 
                   <th class="all">Notes</th> 
                   <th class="">&nbsp;</th> 
                   <th class="">&nbsp;</th>
                </tr>
             </thead>
            <tbody>
                {foreach from=$prescriptions item=rx} 
                    <tr {if $rx->isCanceled()} class="canceled" {/if}> 
                        <td>{$rx->getDetails()}</td>
                        <td>{$rx->getRepeats()}</td>
                        <td>
                            {if $rx->getVisitId() != ''}
                                {if PermissionManager::userHasPermissionAtFacility("VIEW.PATIENT.VISIT", $smarty.session.userId, $rx->getVisit()->getFacilityId())}
                                    <a style="color:steelblue;font-size:0.9rem;" href="/visit/view/{$rx->getVisit()->getId()}">
                                        {$rx->getVisit()->getVisitDate()|date_format:"%b %e, %Y"} {DbMapperUtility::twelveHrAmPm($rx->getVisit()->getVisitTime())}
                                    </a>
                                {else}
                                    {$rx->getVisit()->getVisitDate()|date_format:"%b %e, %Y"} {DbMapperUtility::twelveHrAmPm($rx->getVisit()->getVisitTime())}
                                {/if}
                            {else}
                                &nbsp;
                            {/if}
                        </td>
                        <td>{$rx->getVisit()->getPrincipalClinician()->getLabel()}</td>
                        <td>{$rx->getCreatedTime()|date_format:"%b %e, %Y"}</td>
                        <td class="hotspot" title="{$rx->getNotes()}">{$html->truncateString($rx->getNotes(), 30)}</td>
                        <td>{$rx->getCreatedTime()|strtotime}</td>
                        <td>{$rx->getVisit()->getVisitDateTimeAsNumber()}</td>
                    </tr>
                {/foreach}
            </tbody>
         </table> 
     </div>    
        
    
    {if $prescriptions|count == 0}
        <div class="emptyListMessage">No prescriptions have been recorded for the patient.</div>
    {/if}
</div>

{/nocache}
{/block}
