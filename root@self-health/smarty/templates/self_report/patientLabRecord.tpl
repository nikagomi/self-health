{*Author: Randal Neptune*}
{*Project: EduRecord*}

{extends file="base/body.tpl"}

{block name=jquery}
    {literal}
        
        $(function(){
            $(".hotspot").tipTip({maxWidth: "200px", edgeOffset: 3, defaultPosition: "top", delay: 200, fadeOut: 400});
        });
        
        $("div.table-toolbar").html("{/literal}{Messages::i18n("patientLabRecordForm.recorded.list")}{literal}").css({
            "margin-left" : "17px",
            "font-family": "'Poppins', sans-serif",
            "font-size" : "1.2rem",
            "font-weight" : 500,
            "color": "#464646"
        });
        
        $("#testDate").datepicker({
            format:"M dd, yyyy",
            autoclose: true,
            clearBtn: true,
            endDate: '0d'
        }).data("datepicker");
        
       
        
        $("input.lt").click(function() {
            var parLi = $(this).closest("li");
            if ($(this).prop("checked")) {
                parLi.find("input.labResult").prop("disabled", false);
            } else {
                parLi.find("input.labResult").prop("disabled", true).val("");
            }
        });
        
        /*****************************************
         Interrupt form submit to make sure that 
         at least one food group is selected
        ******************************************/
        $("#patientLabRecordForm").submit(function(e){
            if( $('input[name="labTestId[]"]:checked').length == 0){
                e.preventDefault();
                $("div#err").html("At least one lab test must be selected");
            }else{
                $("div#err").html("");
                var errorCnt = 0;
                $('input[name="labTestId[]"]:checked').each(function() {
                    var parLi = $(this).closest("li");
                    if ($.trim(parLi.find("input.labResult").val()) == '') {
                        errorCnt++;
                        parLi.find("input.labResult").addClass("error");
                    } else{
                        parLi.find("input.labResult").removeClass("error");
                    }
                });
                if (errorCnt > 0) {
                    e.preventDefault();
                    return false;
                }
            }
        });
   
    {/literal}
{/block}

{block name=styles}
    {literal}
        .shorter {
          width: 70px !important;
        }
        .shortest {
          width: 50px !important;
        }
        
    {/literal}
{/block}

{block name=dataTable}
    {literal}
        paging: true,
        "dom": "<'row'<'large-4 medium-4 columns collapsed table-toolbar'><'large-7 medium-7 columns end small-text-left medium-text-right collapsed 'f>>"+
            "t"+
            "<'row'<'small-12 medium-5 end columns'><'small-12 medium-6 end columns'p>>"
    {/literal}
{/block}

{block name=content}
    {nocache}
    {$msg}
    
    <div class="listTableCaption_simpleTable" style="font-variant:normal;font-weight: 500;margin-top:2px;margin-bottom:2px;color:#414042;font-family:'Poppins', sans-serif;font-size:1.3rem;">
        {Messages::i18n("patientLabRecordForm.legend")}
    </div>
    <div style="margin-left:15px;margin-top:2px;">
        <form data-abide name="patientLabRecordForm" id="patientLabRecordForm" action="{$actionPage}" method="POST" autocomplete="off">

                <input type="hidden" name="id" value="{$patientLabRecord->getId()}"/>
                <input type="hidden" name="patientId" value="{$smarty.session.patientId}"/>
                <div class="row">
                    <div class="medium-3 end columns">
                        <label><span class="required">{Messages::i18n("patientLabRecordForm.testDate")}</span>
                            <input tabindex="1" class="medium" type="text" id="testDate" name="testDate" value="{$patientLabRecord->displayTestDate()}" placeholder="MMM dd, yyyy" required>
                        </label>
                    </div>
                </div>
                <div class="row" style="margin-top:15px;margin-bottom:15px;">
                    <div class="medium-12 end columns">
                        <strong>Please enter relevant lab results (and optional details) of the tests done on the date you indicated above.</strong>
                    </div>
                </div>
                {*assign var="tabIndex" value="4"*}
                <div class="row">
                    <div class="medium-12 end columns">
                        <ul class="medium-block-grid-3 small-block-grid-1">
                            {foreach from=$labTests item=lbt}
                                <li>
                                    <label for="{$lbt->getId()}" style="display:inline-block;padding-top:8px;font-weight:600;color:#464646;float:left;"><input class="lt" {if DbMapperUtility::isObjectInArray($lbt, $associatedLabTests)} checked {/if} type="checkbox" id="{$lbt->getId()}" name="labTestId[]" value="{$lbt->getId()}" style=""/>{$lbt->getLabel()}</label>
                                    <input class="shorter labResult" {if $lbt->isNumeric()} maxlength="5" pattern="positive_number"{/if}type="text" value="{$labTestResult->getResultByRecordAndLabTest($patientLabRecord->getId(), $lbt->getId())->getTestResult()}" name="result_{$lbt->getId()}" {if !DbMapperUtility::isObjectInArray($lbt, $associatedLabTests)} disabled {/if}  style="border-radius:5px;margin-left:6px;float:left;padding-top:4px;color:#000000;font-size:0.9rem;display:inline-block;"/>
                                    <span style="margin-left:6px;float:left;padding-top:8px;color:#444444;font-size:0.85rem;display:inline-block;">{$lbt->getUnit()}</span>
                                </li>
                            {/foreach}
                        </ul>
                    </div>
                </div>
                            
                            
                <div class="row">
                    <div class="medium-3 end columns" style="padding-top:8px;">
                        <a href="/patient/lab/record/form" tabindex="5" class="reset">{Messages::i18n("link.reset")}</a>&nbsp;
                        {ElementTag::submitBtn(4)}
                    </div>
                    {if $patientLabRecord->getId() != ''}
                        <div class="medium-3 end columns" style="padding-top:8px;">
                            {Messages::i18n("checkbox.confirm")}&nbsp;<input tabindex="6" id="confirmDelete" type="checkbox"/>
                            {ElementTag::deleteBtn(7, "/patient/lab/record/delete/`$patientLabRecord->getId()`")}
                        </div>
                    {/if}
                </div>
                <div class="row">
                    <div class="medium-9 end columns">
                        <div id="err" class="error"></div>
                    </div>
                </div>
        </form> 
    </div>       

{if $list|count gt 0}
    <br/>
    <table align="left" id="listTable" class="displayTable" width="90%" cellspacing="0">
        <thead>
            <tr>
                <th>{Messages::i18n("patientLabRecordForm.testDate")}</th>
                <th>Lab Results</th>
                <th width="10%">&nbsp;</th>
            </tr>
        </thead>
        <tbody>
            {foreach from=$list item=labr} 
                <tr>  
                    <td>{$labr->displayTestDate()}</td>
                    <td>
                        <span {if $labr->getResultListingArray()|count gt 0} class="hotspot" title="{'<br/>'|join:$labr->getResultListingArray()}" {/if}>
                            {$labr->getResultListingArray()|count} results recorded
                        </span>
                    </td>
                    <td>
                        <a class="editRow" title="{Messages::i18n("link.edit")}" href="/patient/lab/record/edit/{$labr->getId()}">
                            <i class='fas fa-edit' style='font-size:1.5rem;color:#008cba;'></i>
                        </a>
                    </td>
                </tr>
            {/foreach}
        </tbody>
    </table> 
{else}
    <div class="emptyListMessage">
        {Messages::i18n("patientLabRecordForm.empty.list.message")}
    </div>
{/if}
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

