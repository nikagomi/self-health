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
        
        th {
            font-variant:normal !important;
            font-weight:500 !important;
            color:#FFFFFF !important;
            font-size:0.9rem !important;
            text-align:left !important;
            font-family: "Poppins", sans-serif !important;
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
        $("table#vitalSignsTable").DataTable({
            responsive: true,
            "searching":false,
            "info": false,
            "paging": false,
            "fixedHeader": false,
            order: [
                [0, 'desc'],
                [1,'desc'],
                [2, 'asc']
            ]
        });
    {/literal}
{/block}

{block name=content}
    {nocache}
    <div>
    <div class="listTableCaption_simpleTable" style="font-variant:normal;font-weight: 500;margin-top:2px;margin-bottom:2px;color:#414042;font-family:'Poppins', sans-serif;font-size:1.3rem;">
        Vital Signs
    </div>
    <div id="" {if $vitals|count == 0} style="display:none;" {/if}>
      
         <table align="left" id="vitalSignsTable" class="displayTable_simpleTable" style="" width="99%" cellspacing="1">
             <thead>
                <tr>
                    <th>{Messages::i18n("patientVitalForm.recordDate")}</th>
                    <th>{Messages::i18n("patientVitalForm.recordTime")}</th>
                    <th>{Messages::i18n("patientVitalForm.patientPosition")}</th>
                    {if $bpTests|count eq 2}
                        <th>BP<br/><span style="font-size:0.9rem;font-weight:normal;">[{$bpTests[0]->getUnit()}]</span></th>
                    {/if}
                    {foreach from=$nonBPTests item=nbpt}
                        <th>{$nbpt->getAbbreviation()}<br/><span style="font-size:0.9rem;font-weight:normal;">[{$nbpt->getUnit()}]</span></th>
                    {/foreach}
                    <th>{Messages::i18n("patientVitalForm.BMI")}</th>
                   {*<th class="never">&nbsp;</th> 
                   <th class="never">&nbsp;</th>*}
                </tr>
             </thead>
            <tbody>
                {foreach from=$vitals item=vital} 
                    <tr> 
                        <td>{$vital->displayRecordDate()}</td>
                        <td>{$vital->displayRecordTime()}</td>
                        <td>{$vital->getPatientPosition()}</td>
                        {if $bpTests|count eq 2}
                            <td>{$item->getByRecordAndVitalTestId($vital->getId(), $bpTests[0]->getId())->getTestResult()} / {$item->getByRecordAndVitalTestId($vital->getId(), $bpTests[1]->getId())->getTestResult()}</td>
                        {/if}
                        {foreach from=$nonBPTests item=nbpt}
                            <td>{$item->getByRecordAndVitalTestId($vital->getId(), $nbpt->getId())->getTestResult()}</td>
                        {/foreach}
                        <td>{$vital->calculateBMI()}</td>
                        {*<td>{$meal->getDateConsumed()|strtotime}</td>
                        <td>{$meal->getTimeConsumed|strtotime}</td>*}
                    </tr>
                {/foreach}
            </tbody>
         </table> 
     </div>    
        
    
    {if $vitals|count == 0}
        <div class="emptyListMessage">{Messages::i18n("patientVitalForm.empty.list.message")}</div>
    {/if}
</div>

{/nocache}
{/block}
