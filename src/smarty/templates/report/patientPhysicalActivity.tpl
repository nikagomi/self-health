
{*Author: Randal Neptune*}
{*Project: EduRecord*}

{extends file="base/body.tpl"}

{block name=styles}
    {literal}
        span.despliega {
            color:#008CBA;
        }
        
        table.displayTable {
            layout:fixed;
        }
        
        table.displayTable tbody td{
            word-wrap: break-word;
        }
        
        .shorter {
          width: 70px !important;
        }
        
        .shortest {
          width: 50px !important;
        }
    {/literal}
{/block}
    

{block name=scripts}
    {nocache}
        {if $phyActs|count gt 0}
            {literal}
                 var rptTitle  = "Patient Physical Activity Report";
            {/literal}
        {else}
            {literal}
                var rptTitle  = '';
            {/literal}
        {/if}
    {/nocache}
    {literal}
        var buttonCommon = {
            exportOptions: {
                columns: 'th',
                format: {
                    header: function ( data, column) {
                        var newData = data.toUpperCase();
                        data = (newData.indexOf('SEX') > -1)  ? 'Sex' : data;
                        data = (newData.indexOf('COUNTRY') > -1)  ? 'Country' : data;
                        data = (newData.indexOf('PHYSICAL ACTIVITY') > -1)  ? 'Physical Activity' : data;
                        return data;
                    },
                    body: function ( data, column, row) {
                        var bData = (parseInt(data.indexOf("</span>")) !== -1 || parseInt(data.indexOf("</a>")) !== -1) ? $.trim(jQuery(data).text()) : data;
                        return bData;
                    }
                }
            }
        };
    {/literal}
{/block}

{block name=jquery}
    {nocache}
        {literal}
            $("form").find("select").chosen();
            
            $("div.table-toolbar").html("Patient Physical Activity Report").css({
                "margin-left" : "26px",
                "font-family": "'Poppins', sans-serif",
                "font-size" : "1rem",
                "font-weight" : 500,
                "color": "#777777"
            });
            
            $("form#patientPhysicalActivityReportForm").on('valid.fndtn.abide', function() { 
                var self = $(this);
                self.find("button[type='submit']").css("display","none");
                self.find(".wait_tip").css("display","inline-block");
                $("form#patientPhysicalActivityReportForm")[0].submit();

                return false;
            });
        {/literal}
        {if $phyActs|count gt 0}
            {literal}
                 /*************  Column header filter  ************/
                 sarmsHeaderDataTableColumnFilterMulti(dTable, [3,4,5]);
            {/literal}
        {/if}
        
    {/nocache}
{/block}

{block name=dataTable}
    {literal}
        colReorder: true,
        paging: false,
        info: false,
        order: [[ 0, 'asc' ], [ 2, 'asc' ],[ 3, 'asc' ]],
        dom: "<'row'<'medium-4 columns text-left table-toolbar'><'medium-5 columns text-left'f><'medium-2 columns text-right'B>r>"+
            "t"+
            "<'row'<'small-6 columns'i><'small-6 columns'p>>",
        buttons: [
            $.extend( true, {}, buttonCommon, {
                extend: 'excelHtml5',
                text: 'Export Excel',
                title: rptTitle,
                className: 'excelbtn',
                titleAttr:'Export to Excel'
            } )
        ]
        
    {/literal}
{/block}

{block name=content}
{nocache}

{* Now for the form *}
<div class="listTableCaption_simpleTable" style="margin-left:10px !important;font-variant:normal;font-weight: 500;margin-top:2px;margin-bottom:2px;color:#414042;font-family:'Poppins', sans-serif;font-size:1.3rem;">
    {Messages::i18n("patientPhysicalActivityReportForm.legend")}&nbsp;
    <a href="#" class="hintanchorRow" onclick="return false;" onMouseover="showhint('Lists physical activity record of registered patients filtered by country, age & sex', this, event, '180px')">&nbsp;</a>
</div>

<form data-abide="ajax" name="patientPhysicalActivityReportForm" id="patientPhysicalActivityReportForm" action="{$actionPage}" method="POST" autocomplete="off" style="width:80%;">
    <div class="row" style="margin-left:0px;">
        <div class="medium-4 end columns">
            <label><span class="required">{Messages::i18n("patientPhysicalActivityReportForm.countryId")}</span>
                <select name="countryId" id="countryId" tabindex="1" required>
                    {html_options options=$countryIds selected=$countryId}
                </select>
            </label>
        </div>
        <div class="medium-2 end columns">
            <label><span class="">{Messages::i18n("patientPhysicalActivityReportForm.genderId")}</span>
                <select name="genderId" id="genderId" tabindex="2">
                    {html_options options=$genderIds selected=$genderId}
                </select>
            </label>
        </div>
        <div class="medium-4 end columns">
            <label><span class="">{Messages::i18n("patientPhysicalActivityReportForm.ageRangeId")}</span>
                <select name="ageRangeId" id="ageRangeId" tabindex="3">
                    {html_options options=$ageRangeIds selected=$ageRangeId}
                </select>
            </label>
        </div>
    </div>
    <div class="row" style="margin-left:0px;">
        <div class="medium-4 end columns">
            <label><span class="">{Messages::i18n("patientPhysicalActivityReportForm.physicalActivityId")}</span>
                <select name="physicalActivityId" id="physicalActivityId" tabindex="4">
                    {html_options options=$physicalActivityIds selected=$physicalActivityId}
                </select>
            </label>
        </div>
        <div class="medium-6 end columns">
            <label>
                <span style="color:#777;">Duration range: <small class="error" id="durationError"></small></span>&ensp;<br>
                <input style="display:inline-block;float:left;margin-right:16px;" tabindex="5" data-abide-validator="durationValidator" type="text" class="shorter" maxlength="3" pattern="number" id="dStart" name="dStart" value="{$dStart}" placeholder=""/> 
                
                <span style="display:inline-block;float:left;margin-right:16px;"> to </span>
                <input style="display:inline-block;float:left;" tabindex="6" data-abide-validator="durationValidator" type="text" class="shorter" maxlength="3" pattern="number" id="dEnd" name="dEnd" value="{$dEnd}" placeholder=""/> 
                <span style="display:inline-block;float:left;margin-left:9px;"> minutes</span>
            </label>
        </div>
    </div>
    
    <div class="row">
        <div class="medium-4 end columns text-left">
            <label style="padding-top:26px;"><span></span>
                <a href="/report/patient/physical/activity/form" tabindex="7" class="reset">Reset</a>&nbsp;
                {ElementTag::customBtn (8, 'file-signature', 'Generate', 'submit', 'button', 'submit', true)}
            </label>
        </div>
    </div>
</form> 
<div class="row">
    <div class="medium-12 columns">
      <hr width="99%" size="4" color="#D0E0F0" style="margin:0px;"/>
    </div>
</div>
                            
{* Data table *}
{if $phyActs|count gt 0}
    
    <br/>
    <table align="left" id="listTable" class="displayTable" width="95%" cellspacing="0">
        <thead>
            <tr>
                <th style="">{Messages::i18n("patientPhysicalActivityReportForm.patient")}</th>
                <th style="">{Messages::i18n("patientPhysicalActivityReportForm.dateOfBirth")}</th>
                <th class='' style="">{Messages::i18n("patientPhysicalActivityReportForm.age")}</th>
                <th class='' style="">{Messages::i18n("patientPhysicalActivityReportForm.countryId")}</th>
                <th class='' style="">{Messages::i18n("patientPhysicalActivityReportForm.genderId")}</th>
                <th class='' style="">{Messages::i18n("patientPhysicalActivityReportForm.physicalActivityId")}</th>
                <th class='' style="">{Messages::i18n("patientPhysicalActivityReportForm.duration")}</th>
                <th class='' style="">{Messages::i18n("patientPhysicalActivityReportForm.datePerformed")}</th>
            </tr>
        </thead>
        <tbody>
            {foreach from=$phyActs item=phyAct}
                <tr>
                    <td>{$phyAct->getPatient()->getLabel()}</td>
                    <td>{$phyAct->getPatient()->showBirthDate()}</td>
                    <td>{$phyAct->getPatient()->displayAge()}</td>
                    <td>{$phyAct->getPatient()->getCountry()->getLabel()}</td>
                    <td>{$phyAct->getPatient()->getGender()->getLabel()}</td>
                    <td>{$phyAct->getPhysicalActivity()->getLabel()}</td>
                    <td>{$phyAct->getDurationInMinutes()}</td>
                    <td>{$phyAct->displayDatePerformed()}</td>
                    
                </tr>
            {/foreach}
        </tbody>
    </table> 
{elseif $submit != ''}
    <div class="emptyListMessage">{Messages::i18n("patientPhysicalActivityReportForm.emptyListMessage")}</div>
{/if}

{/nocache}
{/block}

{block name="auxScripts"}
    {literal}
        
    {/literal}
{/block}

{block name="foundation"}
    {literal}
        abide: {
            validators: {
                durationValidator: function (el, required, parent) {
                    var min = 1;
                    var max = 360;
                    var maxDiff = 360;
                    var dStart = $.trim($("#dStart").val());
                    var dEnd = $.trim($("#dEnd").val());
                    
                    try {
                    
                        if (dStart != '' && dEnd == '' || dStart == '' && dEnd != '') {
                            $("#durationError").text("use both values or none");
                            return false;
                        } else {
                            if ((dStart != '' || dEnd != '') && (!isPositiveInteger(dStart) || !isPositiveInteger(dEnd))) {
                                $("#durationError").text("use positive values");
                                return false;
                            } else {
                                if (dStart != '' && dEnd != '' && (parseInt(dStart) < min || parseInt(dEnd) > max)) {
                                    $("#durationError").text("range limits: "+min+" - "+max);
                                    return false;
                                } else {
                                    if (dStart != '' && dEnd != '' && parseInt(dStart) > parseInt(dEnd)) {
                                        $("#durationError").text("range end > start");
                                        return false;
                                    } else {
                                        if (dStart != '' && dEnd != '' && (parseInt(dEnd) - parseInt(dStart) > maxDiff)) {
                                            $("#durationError").text("range diff <= "+maxDiff);
                                            return false;
                                        }
                                    }
                                }
                            }
                        }
                    } catch (e) {
                        //alert(e.message);
                        return false;
                    }
                    return true;
                }
            }
        } 
    {/literal}
{/block}

