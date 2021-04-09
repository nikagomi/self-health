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
        $("table#physicalActivityTable").DataTable({
            responsive: true,
            "searching":false,
            "info": false,
            "paging": false,
            "fixedHeader": false,
            order: [
                [2, 'desc'],
                [3,'desc'],
                [0, 'asc']
            ],
            'columnDefs': [
                { 'orderData':[5], 
                  'targets': [2], 
                },
                { 'orderData':[6], 
                  'targets': [3], 
                },
                {
                  'targets': [5,6],
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
    <div class="listTableCaption_simpleTable" style="font-variant:normal;font-weight: 500;margin-top:2px;margin-bottom:2px;color:#414042;font-family:'Poppins', sans-serif;font-size:1.3rem;">
        Physical Activity Records
    </div>
    <div id="" {if $activities|count == 0} style="display:none;" {/if}>
      
         <table align="left" id="physicalActivityTable" class="displayTable_simpleTable" style="" width="99%" cellspacing="1">
             <thead>
                <tr>
                   <th>{Messages::i18n("patientPhysicalActivityForm.physicalActivityId")}</th> 
                   <th>{Messages::i18n("patientPhysicalActivityForm.durationInMinutes")}</th>
                    <th>{Messages::i18n("patientPhysicalActivityForm.datePerformed")}</th>
                    <th>{Messages::i18n("patientPhysicalActivityForm.timeStarted")}</th>
                    <th>{Messages::i18n("patientPhysicalActivityForm.notes")}</th>
                   <th class="never">&nbsp;</th> 
                   <th class="never">&nbsp;</th>
                </tr>
             </thead>
            <tbody>
                {foreach from=$activities item=act} 
                    <tr> 
                        <td>{$act->getPhysicalActivity()->getLabel()} </td>
                        <td>{$act->getDurationInMinutes()}</td>
                        <td>{$act->displayDatePerformed()}</td>
                        <td>{$act->displayTimeStarted()}</td>
                        
                        <td>{$act->getNotes()}</td>
                        <td>{$act->getDatePerformed()|strtotime}</td>
                        <td>{$act->getTimeStarted|strtotime}</td>
                    </tr>
                {/foreach}
            </tbody>
         </table> 
     </div>    
        
    
    {if $activities|count == 0}
        <div class="emptyListMessage">{Messages::i18n("patientPhysicalActivityForm.empty.list.message")}</div>
    {/if}
</div>

{/nocache}
{/block}
