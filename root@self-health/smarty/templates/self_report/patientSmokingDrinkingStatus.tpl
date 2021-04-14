{*Author: Randal Neptune*}
{*Project: EduRecord*}

{extends file="base/body.tpl"}

{block name=jquery}
    {literal}
   
        
        $("#stopSmokingDate, #stopDrinkingDate").datepicker({
            format:"M dd, yyyy",
            autoclose: true,
            clearBtn: true,
            endDate: '0d',
            highlightToday: true,
            todayBtn: true
        }).data("datepicker");
        
        
        $("#smokingSinceInterval, #smokingFrequency, #drinkingSinceInterval, #drinkingFrequency").chosen();
        
        $("input[type='radio'].dSmoke").click(function(){
            if ($(this).val() == 1) {
                $("div.ddSmoke").each(function(){ 
                    $(this).css("display","block");
                });
            } else {
                $("div.ddSmoke").each(function(){ 
                    $(this).css("display","none");
                    $(this).find("input[type='text'], textarea").val("");
                    $(this).find("select").val("").trigger("chosen:updated");
                });
            }
        });
        
        $("input[type='radio'].sSmoke").click(function(){
            if ($(this).val() == 1) {
                $("div.sSmoke").each(function(){ 
                    $(this).css("display","block");
                });
            } else {
                $("div.sSmoke").each(function(){ 
                    $(this).css("display","none");
                    $(this).find("input[type='text']").val("");
                });
            }
        });
        
        $("input[type='radio'].dDrink").click(function(){
            if ($(this).val() == 1) {
                $("div.ddDrink").each(function(){ 
                    $(this).css("display","block");
                });
            } else {
                $("div.ddDrink").each(function(){ 
                    $(this).css("display","none");
                    $(this).find("input[type='text'], textarea").val("");
                    $(this).find("select").val("").trigger("chosen:updated");
                });
            }
        });
        
        $("input[type='radio'].sDrink").click(function(){
            if ($(this).val() == 1) {
                $("div.sDrink").each(function(){ 
                    $(this).css("display","block");
                });
            } else {
                $("div.sDrink").each(function(){ 
                    $(this).css("display","none");
                    $(this).find("input[type='text']").val("");
                });
            }
        });
      
    {/literal}
{/block}

{block name=dataTable}
    {literal}
       
    {/literal}
{/block}

{block name=dataTable}
    {literal}
       
    {/literal}
{/block}

{block name=content}
    {nocache}
    {$msg}
    <div class="listTableCaption_simpleTable" style="font-variant:normal;font-weight:500;margin-top:2px;margin-bottom:2px;color:#414042;font-family:'Poppins',sans-serif;font-size:1.3rem;">
        {Messages::i18n("patientSmokingDrinkingStatusForm.legend")}
    </div>
    {if $smarty.session.patientId|trim != ''}
        <div style="margin-left:15px;margin-top:2px;width:85%;">
            <form data-abide name="patientSmokingDrinkingStatusForm" id="patientSmokingDrinkingStatusForm" action="{$actionPage}" method="POST" autocomplete="off">
                <input type="hidden" name="id" value="{$patientSmokingDrinkingStatus->getId()}"/>
                <input type="hidden" name="patientId" value="{$smarty.session.patientId}"/>
            <div class="row">
                <div class="medium-12 end columns">
                    <ul class="medium-block-grid-2 small-block-grid-1">
                        <li>
                            <div class="row">
                                <div class="medium-12 end columns">
                                    <label><span class="">{Messages::i18n("patientSmokingDrinkingStatusForm.smoker")}</span><br/>
                                        <input name="smoker" id="smoker" tabindex="1" class="dSmoke" type="radio" value="1" {if $patientSmokingDrinkingStatus->isSmoker()} checked {/if}> 
                                        <label for="smoker">Yes</label> 
                                        <input name="smoker" id="notSmoker" tabindex="2" class="dSmoke" type="radio" value="0" {if !$patientSmokingDrinkingStatus->isIdEmpty() && !$patientSmokingDrinkingStatus->isSmoker()} checked {/if}> 
                                        <label for="notSmoker">No</label>
                                    </label>
                                </div>
                            </div>
                            <div class="row" style="margin-bottom:8px;">
                                <div class="medium-12 end columns ddSmoke" style="{if $patientSmokingDrinkingStatus->isSmoker()} display:inline-block; {else} display:none; {/if}">
                                    <label>
                                        <span class="">{Messages::i18n("patientSmokingDrinkingStatusForm.smokingSince")}</span>
                                    </label><br/>
                                    <input tabindex="3" type="text" class="short" maxlength="2"id="smokingSinceQuantity" name="smokingSinceQuantity" value="{$patientSmokingDrinkingStatus->getSmokingSinceQuantity()}" style="float:left;display:inline-block;margin-right:5px;"/>
                                    <select tabindex="4" name="smokingSinceInterval" id="smokingSinceInterval" class="" style="float:left;display:inline-block;width:170px;">
                                        {html_options options=$intervals selected=$patientSmokingDrinkingStatus->getSmokingSinceInterval()}
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="medium-12 end columns ddSmoke"  style="{if $patientSmokingDrinkingStatus->isSmoker()} display:inline-block; {else} display:none; {/if}">
                                    <label><span class="">{Messages::i18n("patientSmokingDrinkingStatusForm.smokingFrequency")}</span>
                                        <select tabindex="5"  name="smokingFrequency" id="smokingFrequency" style="width:120px;">
                                            {html_options options=$frequencies selected=$patientSmokingDrinkingStatus->getSmokingFrequency()}
                                        </select>
                                    </label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="medium-12 end columns ddSmoke" style="{if $patientSmokingDrinkingStatus->isSmoker()} display:inline-block; {else} display:none; {/if}">
                                    <label><span class="">{Messages::i18n("patientSmokingDrinkingStatusForm.stoppedSmoking")}</span><br/>
                                        <input name="stoppedSmoking" id="stoppedSmoking" class="sSmoke" tabindex="6" type="radio" value="1" {if $patientSmokingDrinkingStatus->hasStoppedSmoking()} checked {/if}> 
                                        <label for="stoppedSmoking">Yes</label> 
                                        <input name="stoppedSmoking" id="notStoppedSmoking" class="sSmoke" tabindex="7" type="radio" value="0" {if !$patientSmokingDrinkingStatus->isIdEmpty() && !$patientSmokingDrinkingStatus->hasStoppedSmoking()} checked {/if}> 
                                        <label for="notStoppedSmoking">No</label>
                                    </label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="medium-12 end columns sSmoke" style="{if $patientSmokingDrinkingStatus->hasStoppedSmoking()} display:inline-block; {else} display:none; {/if}">
                                    <label><span class="">{Messages::i18n("patientSmokingDrinkingStatusForm.stopSmokingDate")}</span>
                                        <input tabindex="8" type="text" class="medium sSmoke" placeholder="MMM d, yyyy" id="stopSmokingDate" name="stopSmokingDate" value="{$patientSmokingDrinkingStatus->displayStopSmokingDate()}"/>
                                    </label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="medium-12 end columns ddSmoke" style="{if $patientSmokingDrinkingStatus->isSmoker()} display:inline-block; {else} display:none; {/if}">
                                    <label><span class="">{Messages::i18n("patientSmokingDrinkingStatusForm.smokingComments")}</span>
                                        <textarea cols="20" rows="3" style="resize:none;" tabindex="9" name="smokingComments" id="smokingComments" placeholder="What do you smoke? More details on frequency, etc.">{$patientSmokingDrinkingStatus->getSmokingComments()}</textarea>
                                    </label>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="row">
                                <div class="medium-12 end columns">
                                    <label><span class="">{Messages::i18n("patientSmokingDrinkingStatusForm.drinker")}</span><br/>
                                        <input name="drinker" id="isDrinker" tabindex="10" class="dDrink" type="radio" value="1" {if $patientSmokingDrinkingStatus->isDrinker()} checked {/if}/> 
                                        <label for="isDrinker">Yes</label> 
                                        <input name="drinker" id="notDrinker" tabindex="11" class="dDrink" type="radio" value="0" {if !$patientSmokingDrinkingStatus->isIdEmpty() && !$patientSmokingDrinkingStatus->isDrinker()} checked {/if}/> 
                                        <label for="notDrinker">No</label> 
                                    </label>
                                </div>
                            </div>
                            <div class="row"  style="margin-bottom:8px;">
                                <div class="medium-12 end columns ddDrink" style="{if $patientSmokingDrinkingStatus->isDrinker()} display:inline-block; {else} display:none; {/if}">
                                    <label>
                                        <span class="">{Messages::i18n("patientSmokingDrinkingStatusForm.drinkingSince")}</span>
                                    </label><br/>
                                    <input tabindex="12" type="text" class="short dDrink" maxlength="2" pattern="number" id="drinkingSinceQuantity" name="drinkingSinceQuantity" value="{$patientSmokingDrinkingStatus->getDrinkingSinceQuantity()}" style="float:left;display:inline-block;margin-right:5px;"/>
                                    <select tabindex="13" class="dDrink" name="drinkingSinceInterval" id="drinkingSinceInterval" style="float:left;display:inline-block;width:170px;">
                                        {html_options options=$intervals selected=$patientSmokingDrinkingStatus->getDrinkingSinceInterval()}
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="medium-12 end columns ddDrink" style="{if $patientSmokingDrinkingStatus->isDrinker()} display:inline-block; {else} display:none; {/if}">
                                    <label><span class="">{Messages::i18n("patientSmokingDrinkingStatusForm.drinkingFrequency")}</span>
                                        <select tabindex="14" class="dDrink" name="drinkingFrequency" id="drinkingFrequency" style="">
                                            {html_options options=$frequencies selected=$patientSmokingDrinkingStatus->getDrinkingFrequency()}
                                        </select>
                                    </label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="medium-12 end columns ddDrink" style="{if $patientSmokingDrinkingStatus->isDrinker()} display:inline-block; {else} display:none; {/if}">
                                    <label><span class="">{Messages::i18n("patientSmokingDrinkingStatusForm.stoppedDrinking")}</span><br/>
                                        <input name="stoppedDrinking" id="stoppedDrinking" class="sDrink" tabindex="15" type="radio" value="1" {if $patientSmokingDrinkingStatus->hasStoppedDrinking()} checked {/if}> 
                                        <label for="stoppedDrinking">Yes</label> 
                                        <input name="stoppedDrinking" id="notStoppedDrinking" class="sDrink" tabindex="16" type="radio" value="0" {if !$patientSmokingDrinkingStatus->isIdEmpty() && !$patientSmokingDrinkingStatus->hasStoppedDrinking()} checked {/if}> 
                                        <label for="notStoppedDrinking">No</label>
                                    </label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="medium-12 end columns sDrink" style="{if $patientSmokingDrinkingStatus->hasStoppedDrinking()} display:inline-block; {else} display:none; {/if}">
                                    <label><span class="">{Messages::i18n("patientSmokingDrinkingStatusForm.stopDrinkingDate")}</span>
                                        <input tabindex="17" type="text" class="medium sDrink" placeholder="MMM d, yyyy" id="stopDrinkingDate" name="stopDrinkingDate" value="{$patientSmokingDrinkingStatus->displayStopDrinkingDate()}"/>
                                    </label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="medium-12 end columns ddDrink" style="{if $patientSmokingDrinkingStatus->isDrinker()} display:inline-block; {else} display:none; {/if}">
                                    <label><span class="">{Messages::i18n("patientSmokingDrinkingStatusForm.drinkingComments")}</span>
                                        <textarea cols="20" rows="3" style="resize:none;" tabindex="18" name="drinkingComments" id="drinkingComments" placeholder="What do you drink? More details on frequency, etc.">{$patientSmokingDrinkingStatus->getDrinkingComments()}</textarea>
                                    </label>
                                </div>
                            </div>
                        </li>    
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="medium-4 end columns" style="padding-top:2px;">
                    {ElementTag::submitBtn(19)}
                    <a href="/patient/smoking/drinking/status/view/{$patientSmokingDrinkingStatus->getId()}" tabindex="6" class="reset">{Messages::i18n("link.cancel")}</a>&nbsp;
                </div>
            </div>

            </form> 
        </div> 
    
    {/if}                    
    
    <br/><br/>


{/nocache}
{/block}

