{*Author: Randal Neptune*}
{*Project: EduRecord*}

{extends file="base/body.tpl"}

{block name=jquery}
    {literal}
        var smallScreen = window.matchMedia("(max-width: 40.0625em)");
        var chgPwdWidth = (smallScreen.matches) ? "100%" : "440px";
    
        $("div.table-toolbar").html("{/literal}{Messages::i18n("patientMealForm.recorded.list")}{literal}").css({
            "margin-left" : "26px",
            "font-family": "'Poppins', sans-serif",
            "font-size" : "1.2rem",
            "font-weight" : 500,
            "color": "#464646"
        });
        
        $("#dateConsumed").datepicker({
            format:"M dd, yyyy",
            autoclose: true,
            clearBtn: true,
            endDate: '0d',
            todayHighlight: true,
            todayBtn: 'linked'
        }).data("datepicker");
        
        var timePickiOptions = {
            tincrease_direction: 'up',
            disable_keyboard_mobile: true
        };
        
        //Clock time picker on game details page
        $("#timeConsumed").mdtimepicker({
            hourPadding: false, 
            format: 'h:mm tt',
            timeFormat: 'hh:mm tt',
            theme: 'green'
        });
        
        //$("#timeConsumed").timepicki(timePickiOptions);
        $("#mealTypeId").chosen();
        
        $("input.fg").click(function() {
            var parLi = $(this).closest("li");
            if ($(this).prop("checked")) {
                parLi.find("textarea").prop("disabled", false);
            } else {
                parLi.find("textarea").prop("disabled", true).val("");
            }
        });
        
        /*****************************************
         Interrupt form submit to make sure that 
         at least one food group is selected
        ******************************************/
        $("#patientMealForm").submit(function(e){
            if( $('input[name="foodGroupId[]"]:checked').length == 0){
                e.preventDefault();
                $("div#err").html("At least one food group must be selected");
            }else{
                $("div#err").html("");
                var errorCnt = 0;
                $('input[name="foodGroupId[]"]:checked').each(function() {
                    var parLi = $(this).closest("li");
                    if ($.trim(parLi.find("textarea").val()) == '') {
                        errorCnt++;
                        parLi.find("textarea").addClass("error");
                    } else{
                        parLi.find("textarea").removeClass("error");
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
            "<'row'<'small-12 medium-6 columns'><'small-12 medium-6 columns'p>>"
    {/literal}
{/block}

{block name=content}
    {nocache}
    {$msg}
    
    <div class="listTableCaption_simpleTable" style="font-variant:normal;font-weight: 500;margin-top:2px;margin-bottom:2px;color:#414042;font-family:'Poppins', sans-serif;font-size:1.3rem;">
        {Messages::i18n("patientMealForm.legend")}
    </div>
    <div style="margin-left:15px;margin-top:2px;">
        <form data-abide name="patientMealForm" id="patientMealForm" action="{$actionPage}" method="POST" autocomplete="off">

                <input type="hidden" name="id" value="{$patientMeal->getId()}"/>
                <input type="hidden" name="patientId" value="{$smarty.session.patientId}"/>
                <div class="row">
                    <div class="medium-3 end columns">
                        <label><span class="required">{Messages::i18n("patientMealForm.mealTypeId")}</span><br/>
                            <select name="mealTypeId" id="mealTypeId" tabindex="1"  required>
                                {html_options options=$mealTypeIds selected=$patientMeal->getMealTypeId()}
                            </select>
                        </label>
                    </div>
                    <div class="medium-3 end columns">
                        <label><span class="required">{Messages::i18n("patientMealForm.dateConsumed")}</span>
                            <input tabindex="2" class="medium" type="text" id="dateConsumed" name="dateConsumed" value="{$patientMeal->displayDateConsumed()}" placeholder="MMM dd, yyyy" required>
                        </label>
                    </div>
                    <div class="medium-3 end columns">
                        <label><span class="required">{Messages::i18n("patientMealForm.timeConsumed")}</span>
                            <input tabindex="3" class="short" type="text" id="timeConsumed" name="timeConsumed" value="{$patientMeal->displayTimeConsumed()}" required>
                        </label>
                    </div>
                </div>
                <div class="row" style="margin-top:25px;">
                    <div class="medium-9 end columns">
                        <b>Please specify the food groups (and optional details) that were consumed during this meal below.</b>
                    </div>
                </div>
                {*assign var="tabIndex" value="4"*}
                <div class="row">
                    <div class="medium-9 end columns">
                        <ul class="medium-block-grid-2 small-block-grid-1">
                            {foreach from=$foodGroups item=fg}
                                <li>
                                    <div>
                                        <label for="{$fg->getId()}" style="font-weight:500;color:#464646;"><input class="fg" {if DbMapperUtility::isObjectInArray($fg, $associatedFoodGroups)} checked {/if} type="checkbox" id="{$fg->getId()}" name="foodGroupId[]" value="{$fg->getId()}" style="float:left;"/>{$fg->getLabel()}</label>
                                    </div>
                                    <div>
                                        {if $fg->getImageName()|trim != ''}
                                            <div style="width:135px;float:left;">
                                                <img src="/food_group_images/{$fg->getImageName()}" alt=""/>
                                            </div>
                                        {/if}
                                        <div style="width:50%;float:left;">
                                            <textarea name="detail_{$fg->getId()}" cols="5" {if !DbMapperUtility::isObjectInArray($fg, $associatedFoodGroups)} disabled {/if} rows="6" placeholder="Put details of {$fg->getLabel()} consumed here" style="resize:none;padding-top:8px;color:#000000;font-size:0.85rem;display:inline-block;">{$mealFoodGroup->getByMealRecordAndFoodGroupId($patientMeal->getId(), $fg->getId())->getDetails()}</textarea>
                                        </div>
                                    </div>
                                </li>
                            {/foreach}
                        </ul>
                    </div>
                </div>
                            
                            
                <div class="row">
                    <div class="medium-3 end columns" style="padding-top:8px;">
                        <a href="/patient/meal/record/form" tabindex="5" class="reset">{Messages::i18n("link.reset")}</a>&nbsp;
                        {ElementTag::submitBtn(4)}
                    </div>
                    {if $patientMeal->getId() != ''}
                        <div class="medium-3 end columns" style="padding-top:8px;">
                            {Messages::i18n("checkbox.confirm")}&nbsp;<input tabindex="6" id="confirmDelete" type="checkbox"/>
                            {ElementTag::deleteBtn(7, "/patient/meal/record/delete/`$patientMeal->getId()`")}
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
    <table align="left" id="listTable" class="displayTable" width="95%" cellspacing="0">
        <thead>
            <tr>
                <th>{Messages::i18n("patientMealForm.mealTypeId")}</th>
                <th>{Messages::i18n("patientMealForm.dateConsumed")}</th>
                <th>{Messages::i18n("patientMealForm.timeConsumed")}</th>
                {foreach from=$foodGroups item=mfg}
                    <th>{$mfg->getLabel()}</th>
                {/foreach}
                <th width="10%">&nbsp;</th>
            </tr>
        </thead>
        <tbody>
            {foreach from=$list item=pmr} 
                <tr>  
                    <td>{$pmr->getMealType()->getLabel()}</td>
                    <td>{$pmr->displayDateConsumed()}</td>
                    <td>{$pmr->displayTimeConsumed()}</td>
                    
                    {foreach from=$foodGroups item=mfg}
                        <td>{$mealFoodGroup->getByMealRecordAndFoodGroupId($pmr->getId(), $mfg->getId())->getDetails()}</td>
                    {/foreach}
                   
                    <td>
                        <a class="editRow" title="{Messages::i18n("link.edit")}" href="/patient/meal/record/edit/{$pmr->getId()}">
                            <i class='fas fa-edit' style='font-size:1.5rem;color:#008cba;'></i>
                        </a>
                    </td>
                </tr>
            {/foreach}
        </tbody>
    </table> 
{else}
    <div class="emptyListMessage">
        {Messages::i18n("patientMealForm.empty.list.message")}
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

