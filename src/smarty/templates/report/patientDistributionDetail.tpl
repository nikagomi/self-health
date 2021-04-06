
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
                 var rptTitle  = "Patient distribution by Age, Sex & Country";
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
            
            $("div.table-toolbar").html("Patient distribution by Age, Sex & Country").css({
            "margin-left" : "26px",
            "font-family": "'Poppins', sans-serif",
            "font-size" : "1rem",
            "font-weight" : 500,
            "color": "#777777"
        });
        
        $("form#patientDistributionForm").on('valid.fndtn.abide', function() { 
            var self = $(this);
            self.find("button[type='submit']").css("display","none");
            self.find(".wait_tip").css("display","inline-block");
            $("form#patientDistributionForm")[0].submit();
           
            return false;
        });
        {/literal}
        {if $patients|count gt 0}
            {literal}
                 /*************  Column header filter  ************/
                 sarmsHeaderDataTableColumnFilterMulti(dTable, [3,4]);
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
        dom: "<'row'<'small-4 columns text-left table-toolbar'><'small-5 columns text-left'f><'small-2 columns text-right'B>r>"+
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
    {Messages::i18n("patientDistributionForm.legend")}&nbsp;
    <a href="#" class="hintanchorRow" onclick="return false;" onMouseover="showhint('Lists registered patients by country, age & sex', this, event, '180px')">&nbsp;</a>
</div>

<form data-abide="ajax" name="patientDistributionForm" id="patientDistributionForm" action="{$actionPage}" method="GET" autocomplete="off" style="width:80%;">
    <div class="row" style="margin-left:0px;">
            <div class="medium-4 end columns">
                <label><span class="required">{Messages::i18n("patientDistributionForm.countryId")}</span>
                    <select name="countryId" id="countryId" tabindex="1" required>
                        {html_options options=$countryIds selected=$countryId}
                    </select>
                </label>
            </div>
            <div class="medium-2 end columns">
                <label><span class="">{Messages::i18n("patientDistributionForm.genderId")}</span>
                    <select name="genderId" id="genderId" tabindex="2">
                        {html_options options=$genderIds selected=$genderId}
                    </select>
                </label>
            </div>
            <div class="medium-4 end columns">
                <label><span class="">{Messages::i18n("patientDistributionForm.ageRangeId")}</span>
                    <select name="ageRangeId" id="ageRangeId" tabindex="3">
                        {html_options options=$ageRangeIds selected=$ageRangeId}
                    </select>
                </label>
            </div>
        </div>
        <div class="row">
            <div class="medium-4 end columns text-left">
                <label style="padding-top:26px;"><span></span>
                    <a href="/report/patient/distribution/detail/form" tabindex="4" class="reset">Reset</a>&nbsp;
                    {ElementTag::customBtn (5, 'file-signature', 'Generate', 'submit', 'button', 'submit', true)}
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
                <th style="">{Messages::i18n("patientDistributionForm.patient")}</th>
                <th style="">{Messages::i18n("patientDistributionForm.dateOfBirth")}</th>
                <th class='' style="">{Messages::i18n("patientDistributionForm.age")}</th>
                <th class='' style="">{Messages::i18n("patientDistributionForm.countryId")}</th>
                <th class='' style="">{Messages::i18n("patientDistributionForm.genderId")}</th>
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
                </tr>
            {/foreach}
        </tbody>
    </table> 
{elseif $submit != ''}
    <div class="emptyListMessage">{Messages::i18n("patientDistributionForm.emptyListMessage")}</div>
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