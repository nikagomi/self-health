{*Author: Randal Neptune*}
{*Project: EduRecord*}

{extends file="base/body.tpl"}

{block name=jquery}
    {literal}
        var smallScreen = window.matchMedia("(max-width: 40.0625em)");
        var chgPwdWidth = (smallScreen.matches) ? "100%" : "440px";
    
        $("div.table-toolbar").html("{/literal}{Messages::i18n("patientVitalForm.recorded.list")}{literal}").css({
            "margin-left" : "26px",
            "font-family": "'Poppins', sans-serif",
            "font-size" : "1.2rem",
            "font-weight" : 500,
            "color": "#464646"
        });
        
        $("#recordDate").datepicker({
            format:"M dd, yyyy",
            autoclose: true,
            clearBtn: true,
            endDate: '0d',
            todayBtn: 'linked',
            todayHighlight: true
        }).data("datepicker");
        
        var timePickiOptions = {
            tincrease_direction: 'up',
            disable_keyboard_mobile: true
        };
        
        //Clock time picker on game details page
        $("#recordTime").mdtimepicker({
            hourPadding: false, 
            format: 'h:mm tt',
            timeFormat: 'hh:mm tt',
            theme: 'green'
        });
        //$("#recordTime").timepicki(timePickiOptions);
        $("#patientPosition").chosen();
        
        $("#calc").click(function(e){
            $.modal($('div#register-modal-content'), {
            close:true,
            containerCss: {'width':chgPwdWidth, 'height':'350px'},
                onOpen: function (dialog) {
                    dialog.overlay.fadeIn('slow', function () {
                        dialog.data.hide();
                        dialog.container.fadeIn('slow', function () {
                                dialog.data.slideDown('slow');	 
                        });
                    });
                }
            });
        });
        
        //Unit conversion calculator
        //Temperature conversion
        $("#calcT").click(function(){
            temperatureConverter();
        });
        $("#farenheit").blur(function(){
            temperatureConverter();
        });
        //Weight conversion
        $("#calcW").click(function(){
            weightConverter();
        });
        $("#pond").blur(function(){
            weightConverter();
        });
        
        //Height conversion
        $("#calcH").click(function(){
            var feet = $.trim($("#feet").val());
            var inches = $.trim($("#inches").val());
            if (feet!= '' && $.isNumeric(parseFloat(feet)) && inches!= '' && $.isNumeric(parseFloat(inches))) {
                $("#feet").removeClass("error");
                $("#inches").removeClass("error");
                var conv = ((parseFloat(feet) * 12) + parseFloat(inches)) * 2.54;
                $("#centimeter").val(round(conv,1));
            } else if (feet == '' || !$.isNumeric(parseFloat(feet)) ) {
                $("#feet").addClass("error");
                $("#centimeter").val("");
            } else if (inches == '' || !$.isNumeric(parseFloat(inches)) ) {
                $("#inches").addClass("error");
                $("#centimeter").val("");
            }
        });
    {/literal}
{/block}

{block name=scripts}
    {literal}
        function temperatureConverter() {
            var farenheit = $.trim($("#farenheit").val());
            if (farenheit != '' && $.isNumeric(parseFloat(farenheit)) ) {
                $("#farenheit").removeClass("error");
                var conv = (parseFloat(farenheit) - 32) * 0.556;
                $("#celsius").val(round(conv,1));
            } else {
                $("#farenheit").addClass("error");
                 $("#celsius").val("");
            }
        }
        
        function weightConverter () {
            var lbs = $.trim($("#pound").val());
            if (lbs != '' && $.isNumeric(parseFloat(lbs)) ) {
                $("#pound").removeClass("error");
                var conv = parseFloat(lbs) / 2.205;
                $("#kilogram").val(round(conv,1));
            } else {
                $("#pound").addClass("error");
                $("#kilogram").val("");
            }
        }
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
        
        .modalHeader{
            background-color:#ffc42c; 
            color:#464646; 
            font-size:1.2rem; 
            line-height:1.4rem;
            font-weight:500;
            height:40px; 
            padding-top:3px;
            font-family:'Poppins', sans-serif;;
            vertical-align: middle;
            font-variant:normal;
            border-radius: 0px;
            padding-bottom:3px;
            padding-top:8px;
        }
        
        .close {
            background: #444444;
            color: #FFFFFF;
            line-height: 25px;
            position: absolute;
            right: -12px;
            text-align: center;
            top: -10px;
            width: 24px;
            text-decoration: none;
            font-weight: bold;
            border-radius: 12px;
            -webkit-border-radius: 12px;
            -moz-border-radius: 12px;
            box-shadow: 1px 1px 3px #000000;
            -webkit-box-shadow: 1px 1px 3px #000000;
            -moz-box-shadow: 1px 1px 3px #000000;
            font-family: sans-serif arial helvetica;
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
        {Messages::i18n("patientVitalForm.legend")}&ensp;<a href="#" style="font-size:0.9rem;" onclick="return false;" id="calc">(unit conversion calculator:&ensp;<i class="fas fa-calculator" style="font-size:1.2rem;color:#008cba;cursor:pointer;"></i>)</a>
    </div>
    <div style="margin-left:15px;margin-top:2px;">
        <form data-abide name="patientVitalForm" id="patientVitalForm" action="{$actionPage}" method="POST" autocomplete="off">

                <input type="hidden" name="id" value="{$patientVital->getId()}"/>
                <input type="hidden" name="patientId" value="{$smarty.session.patientId}"/>
                <div class="row">
                    <div class="medium-3 end columns">
                        <label><span class="required">{Messages::i18n("patientVitalForm.recordDate")}</span>
                            <input tabindex="1" class="medium" type="text" id="recordDate" name="recordDate" value="{$patientVital->displayRecordDate()}" placeholder="MMM dd, yyyy" required>
                        </label>
                    </div>
                    <div class="medium-3 end columns">
                        <label><span class="required">{Messages::i18n("patientVitalForm.recordTime")}</span>
                            <input tabindex="2" class="short" type="text" id="recordTime" name="recordTime" value="{$patientVital->displayRecordTime()}" required>
                        </label>
                    </div>
                    <div class="medium-3 end columns">
                        <label><span class="required">{Messages::i18n("patientVitalForm.patientPosition")}</span><br/>
                            <select name="patientPosition" id="patientPosition" tabindex="3" style="width:120px !important;" required>
                                {html_options options=$patientPositions selected=$patientVital->getPatientPosition()}
                            </select>
                        </label>
                    </div>
                </div>
                <div class="row">
                    <div class="medium-9 end columns">
                        <ul class="medium-block-grid-3 small-block-grid-1">
                            {if $bpTests|count eq 2}
                                <li>
                                    <label><span>Blood Pressure</span><br/>
                                        <input class="shorter vTest" type="text" id="" pattern="positive_integer" maxlength="3" name="vt_{$bpTests[0]->getId()}" value="{$item->getByRecordAndVitalTestId($patientVital->getId(), $bpTests[0]->getId())->getTestResult()}" style="float:left;"/>
                                        <span style="float:left;padding-top:8px;">&nbsp;/&nbsp;</span>
                                        <input class="shorter vTest" type="text" id="" pattern="positive_integer" maxlength="3" name="vt_{$bpTests[1]->getId()}" value="{$item->getByRecordAndVitalTestId($patientVital->getId(), $bpTests[1]->getId())->getTestResult()}" style="float:left;"/>
                                        <span style="float:left;padding-top:8px;color:#000000;font-size:0.95rem;">&nbsp;{$bpTests[0]->getUnit()}</span>
                                    </label>
                                </li>
                            {/if}
                            {foreach from=$nonBPTests item=nbt}
                                <li>
                                    <label><span>{$nbt->getLabel()}</span><br/>
                                        <input class="shorter vTest" type="text" id="" pattern="positive_number" maxlength="5" name="vt_{$nbt->getId()}" 
                                               value="{if $item->getByRecordAndVitalTestId($patientVital->getId(), $nbt->getId())->getTestResult() == '' && $nbt->isBmiHeightComponent()}{$patient->getLastRecordedHeight()}{else}{$item->getByRecordAndVitalTestId($patientVital->getId(), $nbt->getId())->getTestResult()}{/if}" style="float:left;"/>
                                        <span style="float:left;padding-top:8px;color:#000000;font-size:0.95rem;">&nbsp;{$nbt->getUnit()}</span>
                                    </label>
                                </li>
                            {/foreach}
                        </ul>
                    </div>
                </div>
                            
                            
                <div class="row">
                    <div class="medium-3 end columns" style="padding-top:8px;">
                        <a href="/patient/vitals/form" tabindex="8" class="reset">{Messages::i18n("link.reset")}</a>&nbsp;
                        {ElementTag::submitBtn(7)}
                    </div>
                    {if $patientVital->getId() != ''}
                        <div class="medium-3 end columns" style="padding-top:8px;">
                            {Messages::i18n("checkbox.confirm")}&nbsp;<input tabindex="9" id="confirmDelete" type="checkbox"/>
                            {ElementTag::deleteBtn(10, "/patient/vitals/delete/`$patientVital->getId()`")}
                        </div>
                    {/if}
                </div>

        </form> 
    </div>       

{if $list|count gt 0}
    <br/>
    <table align="left" id="listTable" class="displayTable" width="95%" cellspacing="0">
        <thead>
            <tr>
                <th>{Messages::i18n("patientVitalForm.recordDate")}</th>
                <th>{Messages::i18n("patientVitalForm.recordTime")}</th>
                <th>{Messages::i18n("patientVitalForm.patientPosition")}</th>
                {if $bpTests|count eq 2}
                    <th>BP<br/><span style="font-size:0.9rem;font-weight:normal;">[{$bpTests[0]->getUnit()}]</span></th>
                {/if}
                {foreach from=$nonBPTests item=nbpt}
                <th>{$nbpt->getLabel()}<br/><span style="font-size:0.9rem;font-weight:normal;">[{$nbpt->getUnit()}]</span></th>
                {/foreach}
                <th>{Messages::i18n("patientVitalForm.BMI")}</th>
                <th width="10%">&nbsp;</th>
            </tr>
        </thead>
        <tbody>
            {foreach from=$list item=pvr} 
                <tr>  
                    <td>{$pvr->displayRecordDate()}</td>
                    <td>{$pvr->displayRecordTime()}</td>
                    <td>{$pvr->getPatientPosition()}</td>
                    {if $bpTests|count eq 2}
                        <td>{$item->getByRecordAndVitalTestId($pvr->getId(), $bpTests[0]->getId())->getTestResult()} / {$item->getByRecordAndVitalTestId($pvr->getId(), $bpTests[1]->getId())->getTestResult()}</td>
                    {/if}
                    {foreach from=$nonBPTests item=nbpt}
                        <td>{$item->getByRecordAndVitalTestId($pvr->getId(), $nbpt->getId())->getTestResult()}</td>
                    {/foreach}
                    <td>{$pvr->calculateBMI()}</td>
                    <td>
                        <a class="editRow" title="{Messages::i18n("link.edit")}" href="/patient/vitals/edit/{$pvr->getId()}">
                            <i class='fas fa-edit' style='font-size:1.5rem;color:#008cba;'></i>
                        </a>
                    </td>
                </tr>
            {/foreach}
        </tbody>
    </table> 
{else}
    <div class="emptyListMessage">
        {Messages::i18n("patientVitalForm.empty.list.message")}
    </div>
{/if}

<!-- modal content for conversion calculator -->
    <div id="register-modal-content">
        <a href="#" onclick="return false;" class="close simplemodal-close" style="font-family:'Poppins', sans-serif;">x</a>
        <div class='modalHeader' align="center">Unit Conversion Calculator</div>      
            <br/>
            <div class='row' style="margin: 0px 0px;">
                <div class="small-12 end columns">
                    <label style="font-weight:500;font-family:'Poppins', sans-serif;font-size:1.2rem;"><span class="">&nbsp;Temperature</span></label>
                </div>
            </div>
            <div class='row' style="margin:0px 0px;padding-bottom:8px;">
                <div class="small-6 end columns ">
                    <span style="float:right;padding-top:8px;display:inline-block;">&nbsp;&deg;F</span>
                    <input tabindex="1" type="text" class="shorter" id="farenheit" autocomplete="off" value="" style="float:right;display:inline-block;"/>
                    
                </div>
                <div class="small-2 end columns text-center">
                    <button type="button" style="font-size:1.4rem;font-weight:bold;width:90%;padding-top:3px;" class="button" id="calcT"> <i class="fas fa-play" style="font-size:0.9rem;"></i> </button>
                </div>
                <div class="small-4 end columns text-left">
                    <input tabindex="2" type="text" class="shorter" id="celsius" autocomplete="off" value="" style="float:left;display:inline-block;"/>
                    <span style="float:left;padding-top:8px;display:inline-block;">&nbsp;&deg;C</span>
                </div>
            </div>
            {* Weight converter *}
            
            <div class='row' style="background-color:#EEEEEE;margin: 0px 0px;">
                <div class="small-12 end columns">
                    <label style="font-weight:500;font-family:'Poppins', sans-serif;font-size:1.2rem;"><span class="">&nbsp;Weight</span></label>
                </div>
            </div>
            <div class='row' style="background-color:#EEEEEE;margin:0px 0px;padding-bottom:8px;">
                <div class="small-6 end columns ">
                    <span style="float:right;padding-top:8px;display:inline-block;">&nbsp;lbs</span>
                    <input tabindex="3" type="text" class="shorter" id="pound" autocomplete="off" value="" style="float:right;display:inline-block;"/>
                    
                </div>
                <div class="small-2 end columns text-center">
                    <button type="button" style="font-size:1.4rem;font-weight:bold;width:90%;padding-top:3px;" class="button" id="calcW"> <i class="fas fa-play" style="font-size:0.9rem;"></i> </button>
                </div>
                <div class="small-4 end columns text-left">
                    <input tabindex="4" type="text" class="shorter" id="kilogram" autocomplete="off" value="" style="float:left;display:inline-block;"/>
                    <span style="float:left;padding-top:8px;display:inline-block;">&nbsp;kg</span>
                </div>
            </div>
            {* height converter *}
            
            <div class='row'>
                <div class="small-12 end columns" style="margin: 0px 0px;">
                    <label style="font-weight:500;font-family:'Poppins', sans-serif;font-size:1.2rem;"><span class="">&ensp;&ensp;Height</span></label>
                </div>
            </div>
            <div class='row' style="margin:0px 0px;padding-bottom:8px;">
                <div class="small-3 end columns ">
                    <input tabindex="5" type="number" class="shortest" id="feet" min="0" max="8" autocomplete="off" value="" style="float:left;display:inline-block;"/>
                    <span style="float:left;padding-top:8px;display:inline-block;">&nbsp;ft.</span>
                </div>
                <div class="small-3 end columns ">
                    <input tabindex="6" type="number" class="shortest" id="inches" min="0" max="11" autocomplete="off" value="0" style="float:left;display:inline-block;"/>
                    <span style="float:left;padding-top:8px;display:inline-block;">&nbsp;in.</span>
                </div>
                <div class="small-2 end columns text-center">
                    <button type="button" style="font-size:1.4rem;font-weight:bold;width:90%;padding-top:3px;" class="button" id="calcH"> <i class="fas fa-play" style="font-size:0.9rem;"></i> </button>
                </div>
                <div class="small-4 end columns text-left">
                    <input tabindex="7" type="text" class="shorter" id="centimeter" autocomplete="off" value="" style="float:left;display:inline-block;"/>
                    <span style="float:left;padding-top:8px;display:inline-block;">&nbsp;cm</span>
                </div>
            </div>
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

