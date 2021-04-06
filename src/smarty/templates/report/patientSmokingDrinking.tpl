
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
    {/literal}
{/block}
    

{block name=scripts}
    {nocache}
        {if $patients|count gt 0}
            {literal}
                 var rptTitle  = "Patient Smokers/Drinkers by Age, Sex & Country on or before {/literal}{$asOfDate}{literal}";
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
                        data = (newData.indexOf('DRINKS ALCOHOL') > -1)  ? 'Drinks Alcohol?' : data;
                        data = (newData.indexOf('SMOKES') > -1)  ? 'Smokes?' : data;
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
            
            $("div.table-toolbar").html("Patient smokers/drinkers by Age, Sex & Country on or before {/literal}{$asOfDate}{literal}").css({
                "margin-left" : "26px",
                "font-family": "'Poppins', sans-serif",
                "font-size" : "1rem",
                "font-weight" : 500,
                "color": "#777777"
            });
            
            $("#asOfDate").datepicker({
                format:"M dd, yyyy",
                autoclose: true,
                clearBtn: true,
                endDate: '0d',
                highlightToday: true,
                todayBtn: true
            }).data("datepicker");
        
            $("form#patientSmokingDrinkingForm").on('valid.fndtn.abide', function() { 
                var self = $(this);
                self.find("button[type='submit']").css("display","none");
                self.find(".wait_tip").css("display","inline-block");
                $("form#patientSmokingDrinkingForm")[0].submit();

                return false;
            });
        {/literal}
        {if $patients|count gt 0}
            {literal}
                 /*************  Column header filter  ************/
                 sarmsHeaderDataTableColumnFilterMulti(dTable, [3,4,5,6]);
            {/literal}
        {/if}
        
    {/nocache}
{/block}

{block name=dataTable}
    {literal}
        colReorder: true,
        paging: false,
        info: false,
        order: [[ 0, 'asc' ],[ 2, 'asc' ],[ 3, 'asc' ]],
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
    {Messages::i18n("patientSmokingDrinkingForm.legend")}&nbsp;
    <a href="#" class="hintanchorRow" onclick="return false;" onMouseover="showhint('Lists registered patients by country, age & sex who are either smokers or drinkers on or before threshold date specified', this, event, '180px')">&nbsp;</a>
</div>

<form data-abide="ajax" name="patientSmokingDrinkingForm" id="patientSmokingDrinkingForm" action="{$actionPage}" method="POST" autocomplete="off" style="width:80%;">
    <div class="row" style="margin-left:0px;">
        <div class="medium-4 end columns">
            <label><span class="required">{Messages::i18n("patientSmokingDrinkingForm.countryId")}</span>
                <select name="countryId" id="countryId" tabindex="1" required>
                    {html_options options=$countryIds selected=$countryId}
                </select>
            </label>
        </div>
        <div class="medium-2 end columns">
            <label><span class="">{Messages::i18n("patientSmokingDrinkingForm.genderId")}</span>
                <select name="genderId" id="genderId" tabindex="2">
                    {html_options options=$genderIds selected=$genderId}
                </select>
            </label>
        </div>
        <div class="medium-4 end columns">
            <label><span class="">{Messages::i18n("patientSmokingDrinkingForm.ageRangeId")}</span>
                <select name="ageRangeId" id="ageRangeId" tabindex="3">
                    {html_options options=$ageRangeIds selected=$ageRangeId}
                </select>
            </label>
        </div>
    </div>
    <div class="row" style="margin-left:0px;">
        <div class="medium-4 end columns">
            <label><span class="required">{Messages::i18n("patientSmokingDrinkingForm.asOfDate")}&nbsp;
                    <a href="#" class="hintanchorRow" onclick="return false;" onMouseover="showhint('Whether the patient was a smoker/drinker at this point in time (date) ', this, event, '180px')">&nbsp;</a>
                </span>
                <input tabindex="4" type="text" class="medium" placeholder="MMM ddd, yyyy" name="asOfDate" id="asOfDate" required value="{$asOfDate}"/>
            </label>
        </div>
    </div>
    <div class="row">
        <div class="medium-4 end columns text-left">
            <label style="padding-top:26px;"><span></span>
                <a href="/report/patient/smoking/drinking/form" tabindex="5" class="reset">Reset</a>&nbsp;
                {ElementTag::customBtn (6, 'file-signature', 'Generate', 'submit', 'button', 'submit', true)}
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
{if $patients|count gt 0}
    
    <br/>
    <table align="left" id="listTable" class="displayTable" width="95%" cellspacing="0">
        <thead>
            <tr>
                <th style="">{Messages::i18n("patientSmokingDrinkingForm.patient")}</th>
                <th style="">{Messages::i18n("patientSmokingDrinkingForm.dateOfBirth")}</th>
                <th class='' style="">{Messages::i18n("patientSmokingDrinkingForm.age")}</th>
                <th class='' style="">{Messages::i18n("patientSmokingDrinkingForm.countryId")}</th>
                <th class='' style="">{Messages::i18n("patientSmokingDrinkingForm.genderId")}</th>
                <th class='' style="">{Messages::i18n("patientSmokingDrinkingForm.smoker")}</th>
                <th class='' style="">{Messages::i18n("patientSmokingDrinkingForm.drinker")}</th>
            </tr>
        </thead>
        <tbody>
            {foreach from=$patients item=patient}
                <tr>
                    <td>{$patient->getLabel()}</td>
                    <td>{$patient->showBirthDate()}</td>
                    <td>{$patient->displayAge()}</td>
                    <td>{$patient->getCountry()->getLabel()}</td>
                    <td>{$patient->getGender()->getLabel()}</td>
                    <td style="font-size:1.3rem;">{if $patient->isSmokerAtDate($compareDate)}&check;{/if}</td><!-- comment -->
                    <td style="font-size:1.3rem;">{if $patient->isDrinkerAtDate($compareDate)}&check;{/if}</td>
                </tr>
            {/foreach}
        </tbody>
    </table> 
{elseif $submit != ''}
    <div class="emptyListMessage">{Messages::i18n("patientSmokingDrinkingForm.emptyListMessage")}</div>
{/if}

{/nocache}
{/block}

{block name="auxScripts"}
    {literal}
        
    {/literal}
{/block}

{block name="foundation"}
    {literal}
        
    {/literal}
{/block}
