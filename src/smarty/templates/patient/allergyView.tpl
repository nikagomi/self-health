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
        
        table#allergyTable th {
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
        
    {/literal}
{/block}

{block name=content}
    {nocache}
    <div>
    <div class="listTableCaption_simpleTable" style="font-variant:normal;font-weight: 500;margin-top:2px;margin-bottom:2px;color:#414042;font-family:'Poppins', sans-serif;font-size:1.3rem;">
        Allergy Record
    </div>
    <div id="" {if $allergies|count == 0} style="display:none;" {/if}>
      
        <table align="left" id="medTable" class="displayTable_simpleTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>{Messages::i18n("patientAllergyForm.allergyTypeId")}</th> 
                    <th>{Messages::i18n("patientAllergyForm.allergen")}</th>
                    <th>{Messages::i18n("patientAllergyForm.notes")}</th>
                </tr>
            </thead>
            <tbody>
                {foreach from=$allergies item=allergy} 
                    <tr>                           
                        <td>{$allergy->getAllergyType()->getLabel()}</td> 
                        <td>{$allergy->getAllergen()}</td>
                        <td>{$allergy->getNotes()}</td>
                    </tr>
                {/foreach}
            </tbody>
        </table>  
     </div>    
        
    
    {if $allergies|count == 0}
        <div class="emptyListMessage">{Messages::i18n("patientAllergyForm.empty.list.message")}</div>
    {/if}
</div>

{/nocache}
{/block}


