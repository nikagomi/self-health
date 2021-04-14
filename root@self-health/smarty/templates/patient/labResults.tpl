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
            //$(".demo").tipTip({maxWidth: "200px", edgeOffset: 3, defaultPosition: "top", delay: 100, fadeOut: 200});
        });
        
        $(".demo").click(function(e) {
            var self = $(this);
            var content = $(this).attr("data-content");
            var date = $(this).attr("data-date");
            self.qtip({
                content:{
                    title: "<b>Lab Test Results for " + date +"</b>",
                    button: true,
                    text: content
                },
                show:{
                    event: 'click',
                    ready: true,
                    solo: true,
                    modal: true
                },
                style: {
                    classes: 'qtip-bootstrap',
                    width: '300px'
                },
                position: {
                    my: "bottom center",
                    at: "top center",
                    viewport: $(window),
                    adjust: {
                        method: 'shift shift',
                    }
                },
                hide:false
            });
        });
        
        /*********************************
         DataTable configuration options
        **********************************/
        $("table#labResultsTable").DataTable({
            responsive: true,
            "searching":false,
            "info": false,
            "paging": false,
            "fixedHeader": false,
            order: [
                [0, 'desc']
            ]
        });
    {/literal}
{/block}

{block name=content}
    {nocache}
    <div>
    <div class="listTableCaption_simpleTable" style="font-variant:normal;font-weight: 500;margin-top:2px;margin-bottom:2px;color:#414042;font-family:'Poppins', sans-serif;font-size:1.3rem;">
        Lab Test Results
    </div>
    <div id="" {if $results|count == 0} style="display:none;" {/if}>
      
         <table align="left" id="labResultsTable" class="displayTable_simpleTable" style="" width="99%" cellspacing="1">
             <thead>
                <tr>
                    <th>{Messages::i18n("patientLabRecordForm.testDate")}</th>
                    <th>Lab Results</th>
                   {*<th class="never">&nbsp;</th> 
                   <th class="never">&nbsp;</th>*}
                </tr>
             </thead>
            <tbody>
                {foreach from=$results item=result} 
                    <tr> 
                       <td>{$result->displayTestDate()}</td>
                        <td>
                            {$result->getResultListingArray()|count} results recorded
                            {if $result->getResultListingArray()|count gt 0} 
                                &ensp;
                                <span class="demo" data-date="{$result->displayTestDate()}" data-content="{'<br/>'|join:$result->getResultListingArray()}">
                                    <i title="Click/Touch for more information" class="fas fa-info-circle" style="font-size:1rem;color:#008cba;"></i>
                                </span>
                            {/if}
                        </td>
                        {*<td>{$meal->getDateConsumed()|strtotime}</td>
                        <td>{$meal->getTimeConsumed|strtotime}</td>*}
                    </tr>
                {/foreach}
            </tbody>
         </table> 
     </div>    
        
    
    {if $results|count == 0}
        <div class="emptyListMessage">{Messages::i18n("patientLabRecordForm.empty.list.message")}</div>
    {/if}
</div>

{/nocache}
{/block}
