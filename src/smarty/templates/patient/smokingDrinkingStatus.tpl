{*Author: Randal Neptune*}
{*Project: EduRecord*}

{extends file="base/contentBody.tpl"}

{block name=styles}
    {literal}
        .infoLabel {
            font-family: 'Poppins', sans-serif !important;
            font-size: 1rem  !important;
            font-weight: normal  !important;
        }
        
        .viewLabel {
            font-family: 'Poppins', sans-serif !important;
            font-size: 0.9rem  !important;
            color: #999999 !important;;
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
        Smoking / Drinking Status
    </div>
    {if $patientSmokingDrinkingStatus->isIdEmpty()}
        <div class="emptyListMessage">Patient has not indicated smoking and/or drinking status</div>
    {else}
        <div style="margin-left:15px;margin-top:2px;width:98%;">
           <br/>
            <div class="row">
                <div class="medium-12 end columns">
                    <ul class="medium-block-grid-2 small-block-grid-1">
                        <li>
                            <div class="row">
                                <div class="medium-7 end columns small-text-left medium-text-right viewLabel" style='background-color:#fafafa;'>
                                    <label><span  class="viewLabel">{Messages::i18n("patientSmokingDrinkingStatusForm.smoker")}</span>
                                    </label>
                                </div>
                                <div class="medium-5 end columns infoLabel" style='background-color:#fafafa;'>
                                    {DbMapperUtility::booleanYesNo($patientSmokingDrinkingStatus->isSmoker())}
                                </div>
                            </div>
                            <div class="row">
                                <div class="medium-7 end columns small-text-left medium-text-right">
                                    <label>
                                        <span class="viewLabel">{Messages::i18n("patientSmokingDrinkingStatusForm.smokingSince")}</span>
                                    </label>
                                </div>
                                <div class="medium-5 end columns infoLabel">
                                    {$patientSmokingDrinkingStatus->getSmokingSinceQuantity()} {$patientSmokingDrinkingStatus->getSmokingSinceInterval()}
                                </div>
                            </div>
                            <div class="row">
                                <div class="medium-7 end columns small-text-left medium-text-right" style='background-color:#fafafa;'>
                                    <label>
                                        <span class="viewLabel">{Messages::i18n("patientSmokingDrinkingStatusForm.smokingFrequency")}</span>
                                    </label>
                                </div>
                                <div class="medium-5 end columns infoLabel" style='background-color:#fafafa;'>
                                    {$patientSmokingDrinkingStatus->getSmokingFrequency()}
                                </div>
                            </div>
                            <div class="row">
                                <div class="medium-7 end columns small-text-left medium-text-right">
                                    <label><span class=" viewLabel">{Messages::i18n("patientSmokingDrinkingStatusForm.stoppedSmoking")}</span>
                                    </label>
                                </div>
                                <div class="medium-5 end columns infoLabel">
                                    {DbMapperUtility::booleanYesNo($patientSmokingDrinkingStatus->hasStoppedSmoking())}
                                </div>
                            </div>
                            <div class="row">
                                <div class="medium-7 end columns small-text-left medium-text-right" style='background-color:#fafafa;'>
                                    <label>
                                        <span class="viewLabel">{Messages::i18n("patientSmokingDrinkingStatusForm.stopSmokingDate")}</span>
                                    </label>
                                </div>
                                <div class="medium-5 end columns infoLabel" style='background-color:#fafafa;'>
                                    {$patientSmokingDrinkingStatus->displayStopSmokingDate()}
                                </div>
                            </div>
                            <div class="row">
                                <div class="medium-7 end columns small-text-left medium-text-right">
                                    <label>
                                        <span class="viewLabel">{Messages::i18n("patientSmokingDrinkingStatusForm.smokingComments")}</span>
                                    </label>
                                </div>
                                 <div class="medium-5 end columns infoLabel">
                                    {$patientSmokingDrinkingStatus->getSmokingComments()}
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="row">
                                <div class="medium-7 end columns small-text-left medium-text-right viewLabel" style='background-color:#fAfafa;'>
                                    <label>
                                        <span class="viewLabel">{Messages::i18n("patientSmokingDrinkingStatusForm.drinker")}</span><br/>
                                    </label>
                                </div>
                                <div class="medium-5 end columns infoLabel" style='background-color:#fafafa;'>
                                    {DbMapperUtility::booleanYesNo($patientSmokingDrinkingStatus->isDrinker())}
                                </div>
                            </div>
                            <div class="row">
                                <div class="medium-7 end columns small-text-left medium-text-right ">
                                    <label>
                                        <span class="viewLabel">{Messages::i18n("patientSmokingDrinkingStatusForm.drinkingSince")}</span>
                                    </label>
                                </div>
                                <div class="medium-5 end columns infoLabel">
                                    {$patientSmokingDrinkingStatus->getDrinkingSinceQuantity()}&nbsp;{$patientSmokingDrinkingStatus->getDrinkingSinceInterval()}
                                </div>
                            </div>
                            <div class="row">
                                <div class="medium-7 end columns small-text-left medium-text-right" style='background-color:#fafafa;'>
                                    <label>
                                        <span class="viewLabel">{Messages::i18n("patientSmokingDrinkingStatusForm.drinkingFrequency")}</span>
                                    </label>
                                </div>
                                <div class="medium-5 end columns infoLabel" style='background-color:#fafafa;'>
                                    {$patientSmokingDrinkingStatus->getDrinkingFrequency()}
                                </div>
                            </div>
                            <div class="row">
                                <div class="medium-7 end columns small-text-left medium-text-right">
                                    <label><span class="viewLabel">{Messages::i18n("patientSmokingDrinkingStatusForm.stoppedDrinking")}</span>
                                    </label>
                                </div>
                                <div class="medium-5 end columns infoLabel">
                                    {DbMapperUtility::booleanYesNo($patientSmokingDrinkingStatus->hasStoppedDrinking())}
                                </div>
                            </div>
                            <div class="row">
                                <div class="medium-7 end columns small-text-left medium-text-right" style='background-color:#fafafa;'>
                                    <label>
                                        <span class="viewLabel">{Messages::i18n("patientSmokingDrinkingStatusForm.stopDrinkingDate")}</span>
                                    </label>
                                </div>
                                <div class="medium-5 end columns infoLabel infoLabel" style='background-color:#fafafa;'>
                                    {$patientSmokingDrinkingStatus->displayStopDrinkingDate()}
                                </div>
                            </div>
                            <div class="row">
                                <div class="medium-7 end columns small-text-left medium-text-right">
                                    <label>
                                        <span class="viewLabel">{Messages::i18n("patientSmokingDrinkingStatusForm.drinkingComments")}</span>
                                    </label>
                                </div>
                                <div class="medium-5 end columns infoLabel">
                                    {$patientSmokingDrinkingStatus->getDrinkingComments()}
                                </div>
                            </div>
                        </li>    
                    </ul>
                </div>
            </div>
        </div> 
    {/if}
</div>

{/nocache}
{/block}

