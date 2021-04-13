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
        
        table#covid19Table th {
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
        $("table#covid19Table").DataTable({
            responsive: true,
            "searching":false,
            "info": false,
            "paging": false,
            "fixedHeader": false,
            order: [
                [0, 'asc'],
                [1,'asc']
            ]
        });
        
    {/literal}
{/block}

{block name=content}
    {nocache}
    <div>
    <div class="listTableCaption_simpleTable" style="font-variant:normal;font-weight: 500;margin-top:2px;margin-bottom:2px;color:#414042;font-family:'Poppins', sans-serif;font-size:1.3rem;">
        Covid-19 Vaccinations
    </div>
    <div id="" {if $covid19Vaccinations|count == 0} style="display:none;" {/if}>
      
        <table align="left" id="covid19Table" class="displayTable_simpleTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>{Messages::i18n("covid19VaxForm.covid19VaccineId")}</th> 
                    <th>{Messages::i18n("covid19VaxForm.doseNumber")}</th>
                    <th>{Messages::i18n("covid19VaxForm.dateReceived")}</th>
                </tr>
            </thead>
            <tbody>
                {foreach from=$covid19Vaccinations item=pvax} 
                    <tr>                           
                        <td>{$pvax->getCovid19Vaccine()->getLabel()}</td> 
                        <td>{$pvax->getDoseNumber()}</td>
                        <td>{$pvax->displayDateReceived()}</td>
                    </tr>
                {/foreach}
            </tbody>
        </table>  
     </div>    
        
    
    {if $covid19Vaccinations|count == 0}
        <div class="emptyListMessage">{Messages::i18n("covid19VaccineForm.empty.list.message")}</div>
    {/if}
</div>

{/nocache}
{/block}



