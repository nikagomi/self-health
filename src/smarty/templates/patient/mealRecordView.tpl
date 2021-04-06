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
        
        var foodGroupsQty = {/literal}{$foodGroups|count}{literal};
        var col1 = foodGroupsQty + 1;
        var col2 = foodGroupsQty + 2;
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
        $("table#mealRecordTable").DataTable({
            responsive: true,
            "searching":false,
            "info": false,
            "paging": false,
            "fixedHeader": false,
            order: [
                [1, 'desc'],
                [2,'desc'],
                [0, 'asc']
            ]
        });
    {/literal}
{/block}

{block name=content}
    {nocache}
    <div>
    <div class="listTableCaption_simpleTable" style="font-variant:normal;font-weight: 500;margin-top:2px;margin-bottom:2px;color:#414042;font-family:'Poppins', sans-serif;font-size:1.3rem;">
        Meal Records
    </div>
    <div id="" {if $meals|count == 0} style="display:none;" {/if}>
      
         <table align="left" id="mealRecordTable" class="displayTable_simpleTable" style="" width="99%" cellspacing="1">
             <thead>
                <tr>
                    <th class='all'>{Messages::i18n("patientMealForm.mealTypeId")}</th>
                    <th style="width:15px;" class='all'>{Messages::i18n("patientMealForm.dateConsumed")}</th>
                    <th style="width:20%;"  class='all'>{Messages::i18n("patientMealForm.timeConsumed")}</th>
                    {foreach from=$foodGroups item=fg}
                        <th class=''>{$fg->getLabel()}</th>
                    {/foreach}
                   {*<th class="never">&nbsp;</th> 
                   <th class="never">&nbsp;</th>*}
                </tr>
             </thead>
            <tbody>
                {foreach from=$meals item=meal} 
                    <tr> 
                        <td>{$meal->getMealType()->getLabel()} </td>
                        <td>{$meal->displayDateConsumed()}</td>
                        <td>{$meal->displayTimeConsumed()}</td>
                        {foreach from=$foodGroups item=fg}
                            <td>{$mealFoodGroup->getByMealRecordAndFoodGroupId($meal->getId(), $fg->getId())->getDetails()}</td>
                        {/foreach}
                        {*<td>{$meal->getDateConsumed()|strtotime}</td>
                        <td>{$meal->getTimeConsumed|strtotime}</td>*}
                    </tr>
                {/foreach}
            </tbody>
         </table> 
     </div>    
        
    
    {if $meals|count == 0}
        <div class="emptyListMessage">{Messages::i18n("patientMealForm.empty.list.message")}</div>
    {/if}
</div>

{/nocache}
{/block}
