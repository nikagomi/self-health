{*Author: Randal Neptune*}
{*Project: EduRecord*}

{extends file="base/body.tpl"}

{block name=jquery}
    {literal}
        var smallScreen = window.matchMedia("(max-width: 40.0625em)");
        var chgPwdWidth = (smallScreen.matches) ? "100%" : "440px";
    
        $("form").find("select").chosen();
        
        $("input.cd").click(function() {
            var parLi = $(this).closest("li");
            if ($(this).prop("checked")) {
                parLi.find("select").prop("disabled", false).trigger("chosen:updated");
                parLi.find("input[type='text']").prop("disabled", false);
            } else {
                parLi.find("select").prop("disabled", true).val("").trigger("chosen:updated");
                parLi.find("input[type='text']").prop("disabled", true);
            }
        });
        
        /*****************************************
         Interrupt form submit to make sure that 
         at least one chronic disease is selected
        ******************************************/
        $("#patientChronicDiseaseForm").submit(function(e){
            if( $('input[name="chronicDiseaseId[]"]:checked').length == 0){
                e.preventDefault();
                $("div#err").html("At least one chronic disease must be selected to proceed");
            }
        });
   
    {/literal}
{/block}

{block name=styles}
    {literal}
        .shorter {
          width: 90px !important;
        }
        .shortest {
          width: 50px !important;
        }
        
        div#err {
            color #DD0000;
            font-size: 1rem;
            font-family: 'Poppins', sans-serif;
            font-weight:500;
            padding-top:5px;
        }
        
    {/literal}
{/block}

{block name=dataTable}
    {literal}
        paging: true,
        "dom": "<'row'<'large-4 medium-4 columns collapsed table-toolbar'><'large-7 medium-7 columns end small-text-left medium-text-right collapsed 'f>>"+
            "t"+
            "<'row'<'small-12 medium-6 columns'><'small-12 medium-6 columns'p>>"
    {/literal}
{/block}

{block name=content}
    {nocache}
    {$msg}
    
    <div class="listTableCaption_simpleTable" style="font-variant:normal;font-weight:500;margin-top:2px;margin-bottom:2px;color:#414042;font-family:'Poppins', sans-serif;font-size:1.3rem;">
        {Messages::i18n("patientChronicDiseaseForm.legend")}
    </div><br/>
    <div style="margin-left:15px;margin-top:2px;">
        <form data-abide name="patientChronicDiseaseForm" id="patientChronicDiseaseForm" action="{$actionPage}" method="POST" autocomplete="off">

                <input type="hidden" name="patientId" value="{$smarty.session.patientId}"/>
                {assign var="tabIndex" value="1"}
                <div class="row">
                    <div class="medium-9 end columns">
                        <ul class="medium-block-grid-3 small-block-grid-2">
                            {foreach from=$chronicDiseases item=cd}
                                <li>
                                    <div>
                                        <label for="{$cd->getId()}" style="{if $cd->getLabel()|strtolower eq "other"} display:inline-block;float:left;margin-right:2px;width:30%;{/if} font-size:1.1rem;font-family:'Poppins',sans-serif;font-weight:600;color:#464646;margin-bottom:0px !important;padding-bottom:1px !important;"> 
                                        <input class="cd" {if DbMapperUtility::isObjectInArray($cd, $associatedChronicDiseases)} checked {/if} type="checkbox" id="{$cd->getId()}" name="chronicDiseaseId[]" value="{$cd->getId()}" style=""/>
                                        {$cd->getLabel()} 
                                        </label>
                                        {if $cd->getLabel()|strtolower eq "other"}
                                           <input type='text' name='od_{$cd->getId()}' value="{$pcd->getByPatientAndDisease($smarty.session.patientId, $cd->getId())->getOtherDisease()}" maxlength='199' style='display:inline-block;float:left;width:60%;margin-bottom:0px !important;padding-bottom:1px !important;' {if !DbMapperUtility::isObjectInArray($cd, $associatedChronicDiseases)}disabled{/if}>
                                           <br/>
                                        {/if}
                                        <br/>
                                        <span style="display:inline-block;float:left;font-size:0.85rem;color:#777777;">
                                            Diagnosed since? &ensp;
                                        </span>
                                        <select class="shorter" name="year_{$cd->getId()}" {if !DbMapperUtility::isObjectInArray($cd, $associatedChronicDiseases)} disabled {/if} style="display:inline-block;float:left;">
                                            {html_options options=$yearIds selected=$pcd->getByPatientAndDisease($smarty.session.patientId, $cd->getId())->getDiagnosedSinceYear()}
                                        </select>
                                    </div>
                                </li>
                            {/foreach}
                        </ul>
                    </div>
                </div>
                <div class="row">
                    <div class="medium-3 end columns" style="padding-top:8px;">
                        {ElementTag::submitBtn(4)}
                    </div>
                </div>
                <div class="row">
                    <div class="medium-9 end columns">
                        <div id="err" class="error"></div>
                    </div>
                </div>
        </form> 
    </div>       
<br/><br/>


{/nocache}
{/block}

{block name="foundation"}
    {literal}
        abide : {
            patterns: {
              positive_integer: /^\d+$/,
              positive_number: /^\d*\.{0,1}\d+$/
            }
        }
    {/literal}
{/block}


